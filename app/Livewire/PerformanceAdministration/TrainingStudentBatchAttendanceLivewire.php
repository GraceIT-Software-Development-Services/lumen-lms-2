<?php

namespace App\Livewire\PerformanceAdministration;

use Livewire\Component;
use Modules\CourseAdministration\Models\TrainingBatchScheduleItem;
use Modules\PerformanceAdministration\Models\StudentBatchAttendance;

class TrainingStudentBatchAttendanceLivewire extends Component
{
    public $search = '';
    public $perPage = 13;

    public function render()
    {
        $schedule = TrainingBatchScheduleItem::query()
            ->select(
                // Fields
                'training_batches.batch_name',
                'training_batches.batch_code',
                'training_batches.start_date',
                'training_batches.end_date',
                // Schedule Item Fields
                'training_schedule_items.name as training_schedule_item_name',
                'training_schedule_items.description as training_schedule_item_description',
                'training_schedule_items.start_time as training_schedule_item_start_time',
                'training_schedule_items.end_time as training_schedule_item_end_time',
                // Batch Schedule Item Fields
                'training_batch_schedule_items.session_title',
                'training_batch_schedule_items.description',
                'training_batch_schedule_items.session_type',
                'training_batch_schedule_items.uuid',
                'training_batch_schedule_items.notes',
            )
            // Joins
            ->join('training_batches', 'training_batch_schedule_items.training_batch_id', '=', 'training_batches.id')
            ->join('training_schedule_items', 'training_batch_schedule_items.training_schedule_item_id', '=', 'training_schedule_items.id')

            // Filter by Trainer (Logged-in User)
            ->where('training_batches.trainer_id', auth()->id())
            // Search Filter
            ->where('training_batch_schedule_items.session_title', 'like', '%' . $this->search . '%')
            ->orWhere('training_batch_schedule_items.description', 'like', '%' . $this->search . '%')

            ->paginate($this->perPage);

        return view('livewire.performance-administration.training-student-batch-attendance-livewire', [
            'studentBatchAttendances' => $schedule,
        ]);
    }
}
