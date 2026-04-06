<?php

namespace App\Livewire\Application;

use App\Http\Requests\CreateRegisterLearnerApplicationRequest;
use App\Http\Requests\UpdateRegisterLearnerApplicationRequest;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\CourseAdministration\Models\LearnerTrainingApplication;
use Modules\CourseAdministration\Models\TrainingBatch;
use Modules\CourseAdministration\Models\TrainingCourse;
use Modules\CourseAdministration\Models\TrainingScheduleItem;
use Modules\CourseAdministration\Repositories\TrainingBatchStudentRepository;
use Modules\Institution\Models\Center;
use Modules\PerformanceAdministration\Models\StudentBatchAttendance;

class RegisterExistingLearnerApplicationLivewire extends Component
{
    use WithFileUploads;

    public $userId;
    public $user = null;

    public $centerId;
    public $centers = [];

    public $courseId;
    public $courses = [];

    public $batchId;
    public $batches = [];

    // Personal Information
    public $firstName;
    public $middleName;
    public $lastName;

    public array $tardiness = [];
    public array $absences  = [];

    private function checkLearnerCurrentApplicationStatus($userId)
    {
        $existingApplication = LearnerTrainingApplication::where('user_id', $userId)
            ->whereIn('status', ['approved'])
            ->orderBy('application_date', 'desc')
            ->first();

        // Set batchId if there's an existing approved application to prevent batch assignment in the form
        $trainingBatchId = $existingApplication ? $existingApplication->training_batch_id : null;
        $trainingCenterId = $existingApplication ? $existingApplication->center_id : null;

        $trainingBatch = TrainingBatch::where(['id' => $trainingBatchId, 'center_id' => $trainingCenterId])->first();
        if ($trainingBatch) {
            if (in_array($trainingBatch->status, ['full', 'open', 'ongoing'])) {
                session()->flash('error', 'This learner already has an active training batch. Please check the learner\'s current application status.');
                return redirect()->route('learner-applications-list.index');
            }
        }
    }

    public function mount($userId = null)
    {
        // $this->checkLearnerCurrentApplicationStatus($userId);

        $this->userId = $userId;
        $this->user = User::findOrFail($this->userId);

        // Personal Info
        $this->firstName                = $this->user->name;
        $this->middleName               = $this->user->middle_name;
        $this->lastName                 = $this->user->last_name;

        // Compute tardiness stats for display only
        $this->tardiness = $this->computeUserTardiness($this->userId);
        // Computer absences for display only
        $this->absences  = $this->computeUserAbsences($this->userId);
    }

    private function computeUserTardiness($userId): array
    {
        $trainingBatches = DB::table('training_batch_students')
            ->join('training_batches', 'training_batch_students.training_batch_id', '=', 'training_batches.id')
            ->where('training_batch_students.user_id', $userId)
            ->select(
                'training_batches.id as training_batch_id',
                'training_batches.start_date',
                'training_batches.end_date',
                'training_batches.training_schedule_item_id',
                'training_batch_students.id as training_batch_student_id'
            )
            ->get();

        $totalBatches  = $trainingBatches->count();
        $totalLate     = 0;
        $minor         = 0;
        $moderate      = 0;
        $severe        = 0;
        $totalMinutes  = 0;

        foreach ($trainingBatches as $batch) {
            $scheduleItem = TrainingScheduleItem::find($batch->training_schedule_item_id);
            if (!$scheduleItem) continue;

            $batchStartTime = Carbon::parse($scheduleItem->start_time);
            $tempStartDate  = Carbon::parse($batch->start_date);
            $tempEndDate    = Carbon::parse($batch->end_date);

            while ($tempStartDate <= $tempEndDate) {
                $attendance = StudentBatchAttendance::where('training_batch_student_id', $batch->training_batch_student_id)
                    ->where('training_batch_schedule_item_id', $batch->training_schedule_item_id)
                    ->whereDate('attendance_date', $tempStartDate->toDateString())
                    ->first();

                if ($attendance && $attendance->first_check_in_time) {
                    $checkIn = Carbon::parse($attendance->first_check_in_time);
                    if ($checkIn > $batchStartTime) {
                        $minutes = $batchStartTime->diffInMinutes($checkIn);
                        $totalLate++;
                        $totalMinutes += $minutes;
                        $severity = $this->getSeverity($minutes);
                        if ($severity === 'minor')    $minor++;
                        if ($severity === 'moderate') $moderate++;
                        if ($severity === 'severe')   $severe++;
                    }
                }

                $tempStartDate->addDay();
            }
        }

        $avgMinutes = $totalLate > 0 ? round($totalMinutes / $totalLate) : 0;

        return [
            'total_batches'  => $totalBatches,
            'total_late'     => $totalLate,
            'minor'          => $minor,
            'moderate'       => $moderate,
            'severe'         => $severe,
            'avg_minutes'    => $avgMinutes,
            'minor_pct'      => $totalLate > 0 ? round(($minor / $totalLate) * 100) : 0,
            'moderate_pct'   => $totalLate > 0 ? round(($moderate / $totalLate) * 100) : 0,
            'severe_pct'     => $totalLate > 0 ? round(($severe / $totalLate) * 100) : 0,
        ];
    }

    private function getSeverity($lateMinutes)
    {
        if ($lateMinutes >= 1 && $lateMinutes <= 10) {
            return 'minor';
        } elseif ($lateMinutes >= 11 && $lateMinutes <= 30) {
            return 'moderate';
        } elseif ($lateMinutes > 30) {
            return 'severe';
        }
    }

    public function save()
    {
        $this->validate(
            [
                'courseId' => 'required',
                'batchId' => 'nullable',
                'centerId' => 'required',
            ],
            [
                'courseId.required' => 'The :attribute field is required.',
                'centerId.required' => 'The :attribute field is required.',
            ]
        );

        // Registration Data
        LearnerTrainingApplication::create([
            'user_id' => $this->userId,
            'center_id' => $this->centerId,
            'training_course_id' => $this->courseId,
            'training_batch_id' => $this->batchId ?? null,
            'status' => $this->batchId ? 'approved' : 'pending',
            'application_number' => 'APP-' . date('Y') . '-' . Str::random(16),
            'application_date' => date('Y-m-d'),
            'reviewed_by' => auth()->user()->id,
            'reviewed_at' => now(),
            'registration_type' => 'onsite'
        ]);

        if (isset($this->batchId)) {
            // Register in traing batch student
            $trainingBatchStudentRepository = new TrainingBatchStudentRepository();
            $trainingBatchStudentRepository->create([
                'training_batch_id' => $this->batchId,
                'user_id' => $this->userId,
                'enrollment_date' => date('Y-m-d'),
                'enrollment_status' => 'enrolled',
            ]);
        }

        // update batch status if max participants reached
        $this->updateBatchStatusIfFull($this->batchId);

        // Redirect to index
        if (isset($this->batchId)) {
            return redirect()->route('learner-applications-list.index')
                ->with('success', 'Learner application registered successfully');
        } else {
            return redirect()->route('learner-applications-list.index')
                ->with('success', 'Learner application submitted successfully and waiting for training batch assignment');
        }
    }

    private function updateBatchStatusIfFull($batchId)
    {
        $batch = TrainingBatch::query()
            ->select(
                'training_batches.id',
                'training_batches.max_participants',
                DB::raw('COUNT(training_batch_students.id) as registered_students_count')
            )
            ->join('training_courses', 'training_batches.training_course_id', '=', 'training_courses.id')
            ->leftJoin('training_batch_students', 'training_batches.id', '=', 'training_batch_students.training_batch_id')
            ->where('training_batches.id', $batchId)
            ->groupBy(
                'training_batches.id',
                'training_batches.max_participants'
            )
            ->first();

        if ($batch) {
            if ($batch->registered_students_count >= $batch->max_participants && $batch->status !== 'full') {
                $batch->update(['status' => 'full']);
            }
        }
    }

    public function updatedCourseId()
    {
        $this->centerId = null;
        $this->batchId = null;
        $this->batches = [];
        $this->centers = [];
    }

    public function updatedCenterId()
    {
        $this->batchId = null;
        $this->batches = [];
    }

    public function render()
    {
        // Always load courses
        $this->courses = TrainingCourse::all();

        // Load centers that offer the selected course
        if ($this->courseId) {
            $this->centers = Center::query()
                ->join('training_center_courses', 'centers.id', '=', 'training_center_courses.center_id')
                ->where('training_center_courses.training_course_id', $this->courseId)
                ->where('training_center_courses.is_active', true)
                ->select('centers.*')
                ->get();
        }

        // Load batches for the selected course + center
        if ($this->courseId && $this->centerId) {
            $this->batches = TrainingBatch::query()
                ->where('training_course_id', $this->courseId)
                ->where('center_id', $this->centerId)
                ->whereIn('status', ['open', 'ongoing'])
                ->get();
        }

        return view('livewire.application.register-existing-learner-application-livewire');
    }

    private function computeUserAbsences($userId): array
    {
        $trainingBatches = DB::table('training_batch_students')
            ->join('training_batches', 'training_batch_students.training_batch_id', '=', 'training_batches.id')
            ->where('training_batch_students.user_id', $userId)
            ->select(
                'training_batches.id                as training_batch_id',
                'training_batches.start_date',
                'training_batches.end_date',
                'training_batches.training_schedule_item_id',
                'training_batch_students.id         as training_batch_student_id'
            )
            ->get();

        $totalAbsent  = 0;
        $totalPartial = 0;
        $totalDays    = 0;
        $today        = Carbon::today()->toDateString();

        foreach ($trainingBatches as $batch) {
            $scheduleItem  = TrainingScheduleItem::find($batch->training_schedule_item_id);
            $scheduledDays = $this->resolveScheduledDays($scheduleItem);
            $dateRange     = $this->buildScheduledDateRange(
                $batch->start_date,
                $batch->end_date,
                $scheduledDays,
                $today
            );

            // Fetch all attendance records for this student+batch, keyed by date
            $attendances = StudentBatchAttendance::where('training_batch_student_id', $batch->training_batch_student_id)
                ->where('training_batch_schedule_item_id', $batch->training_schedule_item_id)
                ->get()
                ->keyBy(fn($att) => Carbon::parse($att->attendance_date)->toDateString());

            foreach ($dateRange as $date) {
                $totalDays++;
                $att = $attendances->get($date);

                if (! $att) {
                    $totalAbsent++;
                    continue;
                }

                $amIn  = $att->first_check_in_time   ? Carbon::parse($att->first_check_in_time)  : null;
                $amOut = $att->first_check_out_time   ? Carbon::parse($att->first_check_out_time) : null;
                $pmIn  = $att->second_check_in_time   ? Carbon::parse($att->second_check_in_time) : null;
                $pmOut = $att->second_check_out_time  ? Carbon::parse($att->second_check_out_time) : null;

                // Mirror StudentAttendanceReport::resolveOverallStatus()
                $status = match (true) {
                    $amIn && $pmOut                    => 'present',
                    $amIn || $amOut || $pmIn || $pmOut => 'partial',
                    default                            => 'absent',
                };

                if ($status === 'absent')  $totalAbsent++;
                if ($status === 'partial') $totalPartial++;
            }
        }

        return [
            'total_days'    => $totalDays,
            'total_absent'  => $totalAbsent,
            'total_partial' => $totalPartial,
            'absent_pct'    => $totalDays > 0 ? round(($totalAbsent  / $totalDays) * 100) : 0,
            'partial_pct'   => $totalDays > 0 ? round(($totalPartial / $totalDays) * 100) : 0,
        ];
    }

    // Used only by computeUserAbsences()
    private function resolveScheduledDays(?TrainingScheduleItem $scheduleItem): array
    {
        if (! $scheduleItem) return [];

        $days = $scheduleItem->schedule_days;
        if (is_string($days)) {
            $days = json_decode($days, true);
        }

        return array_map('strtolower', $days ?? []);
    }

    // Used only by computeUserAbsences()
    private function buildScheduledDateRange(
        string $startDate,
        string $endDate,
        array  $scheduledDays,
        string $today
    ): array {
        $period = CarbonPeriod::create(
            Carbon::parse($startDate),
            Carbon::parse($endDate)
        );

        return collect($period)
            ->filter(function (Carbon $date) use ($scheduledDays, $today) {
                if ($date->toDateString() > $today) return false;
                if (empty($scheduledDays))          return true;

                return in_array(strtolower($date->format('l')), $scheduledDays);
            })
            ->map(fn(Carbon $date) => $date->toDateString())
            ->values()
            ->toArray();
    }
}
