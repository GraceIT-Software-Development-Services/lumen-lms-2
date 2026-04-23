<?php

namespace App\Livewire\Dashboard\Learner;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CardLivewire extends Component
{
    private $userId;

    public function mount()
    {
        $this->userId = auth()->user()->id;
    }

    public function render()
    {
        $activeBatch    = $this->getActiveBatch();
        $activeCourse   = $this->getActiveCourse();
        $batchHistory   = $this->getBatchHistory();
        $completedCount = $this->getCompletedCount();
        $upcomingBatch  = $this->getUpcomingBatch();
        $attendanceStat = $this->getAttendanceStat();

        return view('livewire.dashboard.learner.card-livewire', compact(
            'activeBatch',
            'activeCourse',
            'batchHistory',
            'completedCount',
            'upcomingBatch',
            'attendanceStat',
        ));
    }

    // ── Active batch count (open / full / ongoing) ────────────────────────────
    private function getActiveBatch(): int
    {
        return DB::table('training_batch_students')
            ->join('training_batches', 'training_batch_students.training_batch_id', '=', 'training_batches.id')
            ->where('training_batch_students.user_id', $this->userId)
            ->whereIn('training_batches.status', ['open', 'full', 'ongoing'])
            ->count();
    }

    // ── Current active course details ─────────────────────────────────────────
    private function getActiveCourse(): ?object
    {
        return DB::table('training_batch_students')
            ->join('training_batches', 'training_batch_students.training_batch_id', '=', 'training_batches.id')
            ->join('training_courses', 'training_batches.training_course_id', '=', 'training_courses.id')
            ->where('training_batch_students.user_id', $this->userId)
            ->whereIn('training_batches.status', ['open', 'full', 'ongoing'])
            ->select(
                'training_courses.course_name',
                'training_courses.course_code',
                'training_batches.batch_name',
                'training_batches.start_date',
                'training_batches.end_date',
                'training_batches.status as batch_status',
            )
            ->orderByDesc('training_batches.start_date')
            ->first();
    }

    // ── All batches the learner has ever joined ───────────────────────────────
    private function getBatchHistory(): int
    {
        return DB::table('training_batch_students')
            ->join('training_batches', 'training_batch_students.training_batch_id', '=', 'training_batches.id')
            ->where('training_batch_students.user_id', $this->userId)
            ->count();
    }

    // ── Completed / closed batches ────────────────────────────────────────────
    private function getCompletedCount(): int
    {
        return DB::table('training_batch_students')
            ->join('training_batches', 'training_batch_students.training_batch_id', '=', 'training_batches.id')
            ->where('training_batch_students.user_id', $this->userId)
            ->whereIn('training_batches.status', ['completed', 'closed'])
            ->count();
    }

    // ── Next upcoming / scheduled batch ──────────────────────────────────────
    private function getUpcomingBatch(): ?object
    {
        return DB::table('training_batch_students')
            ->join('training_batches', 'training_batch_students.training_batch_id', '=', 'training_batches.id')
            ->join('training_courses', 'training_batches.training_course_id', '=', 'training_courses.id')
            ->where('training_batch_students.user_id', $this->userId)
            ->where('training_batches.status', 'pending')
            ->select(
                'training_courses.course_name',
                'training_batches.batch_name',
                'training_batches.start_date',
            )
            ->orderBy('training_batches.start_date')
            ->first();
    }

    // ── Attendance summary for the active batch ───────────────────────────────
    private function getAttendanceStat(): array
    {
        // Adjust table/column names to match your actual attendance schema
        $rows = null;

        $total   =  0;
        $present =  0;
        $absent  =  0;
        $late    =  0;
        $rate    =  0;

        return compact('total', 'present', 'absent', 'late', 'rate');
    }
}
