<?php

namespace App\Livewire\CourseAdministration;

use App\Models\User;
use Livewire\Component;
use Modules\CourseAdministration\Models\TrainingBatch;
use Modules\CourseAdministration\Models\TrainingCourse;
use Modules\CourseAdministration\Models\TrainingScheduleItem;
use Modules\Institution\Models\Center;

class CreateTrainingBatchLivewire extends Component
{
    // ─── Trainer Batch List ─────────────────────────────────────
    public $trainerBatchList    = [];
    public $conflictingBatchIds = [];

    // ─── Form Fields ────────────────────────────────────────────
    public $trainingBatchCourseId;
    public $batchCode;
    public $batchName;
    public $startDate;
    public $endDate;
    public $maxParticipants;
    public $batchStatus;

    public $trainingBatchScheduleId = null;
    public $trainingBatchTrainerId  = null;

    public $notes;

    // ─── Edit Mode (null = creating new batch) ──────────────────
    public $editingBatchId = null;

    // ─────────────────────────────────────────────────────────────
    // Watchers
    // ─────────────────────────────────────────────────────────────

    public function updatedTrainingBatchTrainerId()
    {
        $this->loadTrainerBatches();
        $this->detectConflicts();
    }

    public function updatedStartDate()
    {
        $this->detectConflicts();
    }

    public function updatedEndDate()
    {
        $this->detectConflicts();
    }

    public function updatedTrainingBatchScheduleId()
    {
        $this->detectConflicts();
    }

    // ─────────────────────────────────────────────────────────────
    // Load existing open batches for selected trainer
    // ─────────────────────────────────────────────────────────────

    private function loadTrainerBatches()
    {
        if (!$this->trainingBatchTrainerId) {
            $this->trainerBatchList = [];
            return;
        }

        $this->trainerBatchList = TrainingBatch::where('training_batches.trainer_id', $this->trainingBatchTrainerId)
            ->select([
                'training_courses.course_name',
                'training_batches.id',
                'training_batches.batch_code',
                'training_batches.batch_name',
                'training_batches.start_date',
                'training_batches.end_date',
                'training_batches.status',
                'training_schedule_items.schedule_days',
                'training_schedule_items.start_time',
                'training_schedule_items.end_time',
            ])
            ->join('training_courses', 'training_batches.training_course_id', '=', 'training_courses.id')
            ->join('training_schedule_items', 'training_batches.training_schedule_item_id', '=', 'training_schedule_items.id')
            ->where('training_batches.status', 'open')
            ->get()
            ->toArray();
    }

    // ─────────────────────────────────────────────────────────────
    // Detect schedule conflicts
    // ─────────────────────────────────────────────────────────────

    public function detectConflicts()
    {
        $this->conflictingBatchIds = [];

        if (empty($this->trainerBatchList) || !$this->startDate || !$this->endDate) {
            return;
        }

        $newDays      = [];
        $newStartTime = null;
        $newEndTime   = null;

        if ($this->trainingBatchScheduleId) {
            $schedule = TrainingScheduleItem::find($this->trainingBatchScheduleId);

            if ($schedule) {
                $newDays = is_array($schedule->schedule_days)
                    ? $schedule->schedule_days
                    : json_decode($schedule->schedule_days, true);

                $newStartTime = \Carbon\Carbon::parse($schedule->start_time)->format('H:i:s');
                $newEndTime   = \Carbon\Carbon::parse($schedule->end_time)->format('H:i:s');
            }
        }

        foreach ($this->trainerBatchList as $batch) {

            // ✅ Only skip when EDITING an existing batch — never skip on create
            if ($this->editingBatchId && $batch['id'] == $this->editingBatchId) {
                continue;
            }

            // 1️⃣ Date overlap
            $datesOverlap = $this->startDate <= $batch['end_date']
                && $this->endDate >= $batch['start_date'];

            if (!$datesOverlap) continue;

            // 2️⃣ No schedule selected yet — flag by date only
            if (empty($newDays)) {
                $this->conflictingBatchIds[] = $batch['id'];
                continue;
            }

            // 3️⃣ Day overlap
            $existingDays = $batch['schedule_days'];
            if (is_string($existingDays)) {
                $existingDays = json_decode($existingDays, true);
            }
            if (!is_array($existingDays)) {
                $existingDays = [];
            }

            $commonDays = array_intersect($newDays, $existingDays);

            if (empty($commonDays)) continue;

            // 4️⃣ Time overlap
            $existingStartTime = \Carbon\Carbon::parse($batch['start_time'])->format('H:i:s');
            $existingEndTime   = \Carbon\Carbon::parse($batch['end_time'])->format('H:i:s');

            if ($newStartTime < $existingEndTime && $newEndTime > $existingStartTime) {
                $this->conflictingBatchIds[] = $batch['id'];
            }
        }
    }

    // ─────────────────────────────────────────────────────────────
    // Save
    // ─────────────────────────────────────────────────────────────

    public function saveTrainingBatch()
    {
        if (!empty($this->conflictingBatchIds)) {
            $this->addError(
                'trainingBatchTrainerId',
                'The selected trainer has a conflicting schedule. Please resolve before saving.'
            );
            return;
        }

        // TODO: validate + save your batch here
    }

    public function render()
    {
        $trainingCourses = TrainingCourse::all();

        $trainigScheduleItems = TrainingScheduleItem::where('center_id', auth()->user()->center_id)->get();

        $trainers = User::role(['Trainer'])
            ->orderBy('name', 'asc')
            ->get();

        $centers = Center::all();

        return view('livewire.course-administration.create-training-batch-livewire', [
            'trainingCourses'      => $trainingCourses,
            'trainigScheduleItems' => $trainigScheduleItems,
            'trainers'             => $trainers,
            'centers'              => $centers,
        ]);
    }
}
