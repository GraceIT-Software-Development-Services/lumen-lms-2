<?php

namespace App\Livewire\PerformanceAdministration\Report;

use Livewire\Component;
use Modules\CourseAdministration\Models\TrainingBatch;
use Modules\CourseAdministration\Models\TrainingBatchStudent;
use Modules\CourseAdministration\Models\TrainingScheduleItem;
use Modules\PerformanceAdministration\Models\StudentBatchAttendance;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Locked;

class StudentIndividualAttendanceReport extends Component
{
    #[Locked]
    public $userId = null; // pass via mount() or route param

    public $trainingBatches     = [];
    public $trainingBatchUuid   = null;

    public array $students      = [];
    public array $dateRange     = [];
    public array $attendanceMap = [];

    // Keyed by training_batch_id
    public array $batchReports = [];

    public function mount(): void
    {
        $this->userId = auth()->user()->id;

        $this->trainingBatches = DB::table('training_batch_students')
            ->join('training_batches', 'training_batch_students.training_batch_id', '=', 'training_batches.id')
            ->where('training_batch_students.user_id', $this->userId)
            ->select(
                'training_batches.id as training_batch_id',
                'training_batches.batch_name',   // ← add
                'training_batches.batch_code',   // ← add
                'training_batches.start_date',
                'training_batches.end_date',
                'training_batches.training_schedule_item_id',
                'training_batch_students.id as training_batch_student_id'
            )
            ->get();

        foreach ($this->trainingBatches as $batch) {
            $scheduleItem = TrainingScheduleItem::find($batch->training_schedule_item_id);
            $this->batchReports[$batch->training_batch_id] = $this->loadReport($batch, $scheduleItem);
        }
    }

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    private function getScheduledDayNames(?TrainingScheduleItem $scheduleItem): array
    {
        if (! $scheduleItem) return [];

        $days = $scheduleItem->schedule_days;
        if (is_string($days)) {
            $days = json_decode($days, true);
        }

        return array_map('strtolower', $days ?? []);
    }

    private function getExpectedCheckIn(?TrainingScheduleItem $scheduleItem): ?Carbon
    {
        if (! $scheduleItem?->start_time) return null;
        return Carbon::parse($scheduleItem->start_time);
    }

    private function buildDateRange(object $batch, array $scheduledDays): array
    {
        $period = CarbonPeriod::create(
            Carbon::parse($batch->start_date),
            Carbon::parse($batch->end_date)
        );

        return collect($period)
            ->filter(function (Carbon $date) use ($scheduledDays) {
                if (empty($scheduledDays)) return true;
                return in_array(strtolower($date->format('l')), $scheduledDays);
            })
            ->map(fn(Carbon $date) => $date->toDateString())
            ->values()
            ->toArray();
    }

    private function loadStudents(int $batchId): array
    {
        return TrainingBatchStudent::query()
            ->join('users', 'training_batch_students.user_id', '=', 'users.id')
            ->where('training_batch_students.training_batch_id', $batchId)
            ->where('training_batch_students.user_id', $this->userId) // ← add this
            ->select(
                'training_batch_students.id   as batch_student_id',
                'training_batch_students.user_id',
                'users.full_name_searchable    as student_name',
            )
            ->get()
            ->toArray();
    }

    private function loadAttendances(array $batchStudentIds): Collection
    {
        return StudentBatchAttendance::whereIn('training_batch_student_id', $batchStudentIds)
            ->orderBy('attendance_date')
            ->orderBy('id')
            ->get()
            ->groupBy(function (StudentBatchAttendance $att) {
                $date = Carbon::parse($att->attendance_date)->toDateString();
                return "{$att->training_batch_student_id}_{$date}";
            })
            ->map(function (Collection $rows) {
                return $rows->reduce(function (?StudentBatchAttendance $merged, StudentBatchAttendance $row) {
                    if (! $merged) return clone $row;

                    $merged->first_check_in_time   = $merged->first_check_in_time   ?: $row->first_check_in_time;
                    $merged->first_check_out_time  = $merged->first_check_out_time  ?: $row->first_check_out_time;
                    $merged->second_check_in_time  = $merged->second_check_in_time  ?: $row->second_check_in_time;
                    $merged->second_check_out_time = $merged->second_check_out_time ?: $row->second_check_out_time;

                    return $merged;
                });
            });
    }

    private function resolveTardiness(?Carbon $actualCheckIn, ?Carbon $expectedCheckIn, string $date): array
    {
        if (! $actualCheckIn || ! $expectedCheckIn) {
            return ['is_late' => false, 'minutes_late' => 0, 'severity' => null];
        }

        $expectedOnDate = Carbon::parse($date)->setTimeFrom($expectedCheckIn);

        if (! $actualCheckIn->gt($expectedOnDate)) {
            return ['is_late' => false, 'minutes_late' => 0, 'severity' => null];
        }

        $minutesLate = (int) $actualCheckIn->diffInMinutes($expectedOnDate);

        $severity = match (true) {
            $minutesLate >= 31 => 'severe',
            $minutesLate >= 11 => 'moderate',
            default            => 'minor',
        };

        return ['is_late' => true, 'minutes_late' => $minutesLate, 'severity' => $severity];
    }

    private function resolveSessionStatus(?Carbon $checkIn, ?Carbon $checkOut): string
    {
        return match (true) {
            $checkIn && $checkOut => 'present',
            $checkIn || $checkOut => 'partial',
            default               => 'absent',
        };
    }

    private function resolveOverallStatus(?Carbon $amIn, ?Carbon $amOut, ?Carbon $pmIn, ?Carbon $pmOut): string
    {
        return match (true) {
            $amIn && $pmOut                    => 'present',
            $amIn || $amOut || $pmIn || $pmOut => 'partial',
            default                            => 'absent',
        };
    }

    private function buildAbsentEntry(string $expectedInFormatted): array
    {
        return [
            'status'       => 'absent',
            'is_late'      => false,
            'minutes_late' => 0,
            'severity'     => null,
            'expected_in'  => $expectedInFormatted,
            'am'           => ['status' => 'absent', 'check_in' => null, 'check_out' => null],
            'pm'           => ['status' => 'absent', 'check_in' => null, 'check_out' => null],
        ];
    }

    private function buildAttendanceEntry(
        StudentBatchAttendance $att,
        string $date,
        ?Carbon $expectedCheckIn,
        string $expectedInFormatted
    ): array {
        $amIn  = $att->first_check_in_time   ? Carbon::parse($att->first_check_in_time)  : null;
        $amOut = $att->first_check_out_time  ? Carbon::parse($att->first_check_out_time) : null;
        $pmIn  = $att->second_check_in_time  ? Carbon::parse($att->second_check_in_time) : null;
        $pmOut = $att->second_check_out_time ? Carbon::parse($att->second_check_out_time) : null;

        $tardiness     = $this->resolveTardiness($amIn, $expectedCheckIn, $date);
        $overallStatus = $this->resolveOverallStatus($amIn, $amOut, $pmIn, $pmOut);

        return [
            'status'       => $overallStatus,
            'is_late'      => $tardiness['is_late'],
            'minutes_late' => $tardiness['minutes_late'],
            'severity'     => $tardiness['severity'],
            'expected_in'  => $expectedInFormatted,
            'am'           => [
                'status'    => $this->resolveSessionStatus($amIn, $amOut),
                'check_in'  => $amIn?->format('g:i A'),
                'check_out' => $amOut?->format('g:i A'),
            ],
            'pm'           => [
                'status'    => $this->resolveSessionStatus($pmIn, $pmOut),
                'check_in'  => $pmIn?->format('g:i A'),
                'check_out' => $pmOut?->format('g:i A'),
            ],
        ];
    }

    // -------------------------------------------------------------------------
    // Core report builder — one batch at a time
    // -------------------------------------------------------------------------

    private function loadReport(object $batch, ?TrainingScheduleItem $scheduleItem): array
    {
        $scheduledDays       = $this->getScheduledDayNames($scheduleItem);
        $expectedCheckIn     = $this->getExpectedCheckIn($scheduleItem);
        $expectedInFormatted = $expectedCheckIn?->format('g:i A') ?? '';

        $dateRange = $this->buildDateRange($batch, $scheduledDays);
        $students  = $this->loadStudents($batch->training_batch_id);

        $batchStudentIds = collect($students)->pluck('batch_student_id')->toArray();
        $attendances     = $this->loadAttendances($batchStudentIds);

        $attendanceMap = [];
        $today         = Carbon::today()->toDateString();

        foreach ($students as $student) {
            foreach ($dateRange as $date) {
                if ($date > $today) continue;

                $lookupKey = "{$student['batch_student_id']}_{$date}";
                $att       = $attendances->get($lookupKey);

                $attendanceMap[$student['batch_student_id']][$date] = $att
                    ? $this->buildAttendanceEntry($att, $date, $expectedCheckIn, $expectedInFormatted)
                    : $this->buildAbsentEntry($expectedInFormatted);
            }
        }

        return [
            'batch'         => $batch,
            'scheduleItem'  => $scheduleItem,   // ← add this
            'dateRange'     => $dateRange,
            'students'      => $students,
            'attendanceMap' => $attendanceMap,
        ];
    }

    public function render()
    {
        return view('livewire.performance-administration.report.student-individual-attendance-report');
    }
}
