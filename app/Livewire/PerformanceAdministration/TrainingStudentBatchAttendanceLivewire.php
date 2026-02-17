<?php

namespace App\Livewire\PerformanceAdministration;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Modules\CourseAdministration\Models\TrainingBatch;
use Modules\CourseAdministration\Models\TrainingBatchScheduleItem;
use Modules\PerformanceAdministration\Models\StudentBatchAttendance;

class TrainingStudentBatchAttendanceLivewire extends Component
{
    public $search = '';
    public $perPage = 13;

    public function render()
    {
        // Fetch training batches with the count of registered students, filtered by the authenticated trainer and search term
        $trainingBatches = TrainingBatch::query()
            ->select(
                'training_batches.id',
                'training_batches.uuid',
                'training_batches.batch_name',
                'training_batches.batch_code',
                'training_courses.course_name',
                'training_courses.course_code',
                'training_batches.start_date',
                'training_batches.end_date',
                'training_batches.status',
                'training_schedule_items.start_time as training_schedule_item_start_time',
                'training_schedule_items.end_time as training_schedule_item_end_time',
                'training_batches.max_participants',
                DB::raw('COUNT(training_batch_students.id) as registered_students_count')
            )
            ->join('training_courses', 'training_batches.training_course_id', '=', 'training_courses.id')
            ->join('training_schedule_items', 'training_batches.training_schedule_item_id', '=', 'training_schedule_items.id')
            ->leftJoin('training_batch_students', 'training_batches.id', '=', 'training_batch_students.training_batch_id')

            ->where('training_batches.trainer_id', auth()->user()->id)

            ->where(function ($query) {
                $query->where('training_batches.batch_code', 'like', '%' . $this->search . '%')
                    ->orWhere('training_courses.course_name', 'like', '%' . $this->search . '%')
                    ->orWhere('training_courses.course_code', 'like', '%' . $this->search . '%');
            })
            ->groupBy(
                'training_batches.id',
                'training_batches.uuid',
                'training_batches.batch_name',
                'training_batches.batch_code',
                'training_courses.course_name',
                'training_courses.course_code',
                'training_batches.start_date',
                'training_batches.end_date',
                'training_batches.status',
                'training_batches.max_participants'
            )
            ->orderBy('training_batches.created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.performance-administration.training-student-batch-attendance-livewire', [
            'trainingBatches' => $trainingBatches,
        ]);
    }
}
