<?php

namespace App\Livewire\Application;

use App\Http\Requests\CreateRegisterLearnerApplicationRequest;
use App\Http\Requests\UpdateRegisterLearnerApplicationRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\CourseAdministration\Models\LearnerTrainingApplication;
use Modules\CourseAdministration\Models\TrainingBatch;
use Modules\CourseAdministration\Models\TrainingCourse;
use Modules\CourseAdministration\Repositories\TrainingBatchStudentRepository;
use Modules\Institution\Models\Center;

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
        $this->checkLearnerCurrentApplicationStatus($userId);

        $this->userId = $userId;
        $this->user = User::findOrFail($this->userId);

        // Personal Info
        $this->firstName                = $this->user->name;
        $this->middleName               = $this->user->middle_name;
        $this->lastName                 = $this->user->last_name;
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
}
