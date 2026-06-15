<?php

namespace App\Livewire\Application;

use App\Mail\BatchNotificationEmail;
use App\Models\User;
use Exception;
use FPDF;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\CourseAdministration\Models\LearnerTrainingApplication;
use Modules\CourseAdministration\Models\TrainingBatch;
use Modules\CourseAdministration\Models\TrainingBatchStudent;
use Modules\CourseAdministration\Models\TrainingCourse;
use Modules\CourseAdministration\Models\TrainingScheduleItem;
use Modules\CourseAdministration\Repositories\TrainingBatchStudentRepository;
use Modules\Institution\Models\Center;

class ApplicationListNoBatchLivewire extends Component
{
    use WithPagination;

    public $search = '';
    public $pageCount = 10;

    public $filterCenterId = '';
    public $filterTrainingCourseId = '';

    public $selectedIds = [];
    public $selectAll = false;

    public $openAssignBatchModal = false;

    public $trainingCourseId = null;
    public $trainingCenterId = null;
    public $trainingBatchId = null;

    public $trainingCourses = [];
    public $trainingCenters = [];
    public $trainingBatches = [];

    public function updatedSearch()
    {
        $this->resetPage();
        $this->clearSelection();
    }

    public function updatedFilterCenterId()
    {
        $this->resetPage();
        $this->clearSelection();
    }

    public function updatedFilterTrainingCourseId()
    {
        $this->resetPage();
        $this->clearSelection();
    }

    public function updatedPageCount()
    {
        $this->resetPage();
        $this->clearSelection();
    }

    public function updatedSelectedIds()
    {
        $this->selectAll = false;
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedIds = $this->baseApplicationQuery()
                ->pluck('learner_training_applications.id')
                ->map(fn($id) => (string) $id)
                ->toArray();
        } else {
            $this->selectedIds = [];
        }
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->filterCenterId = '';
        $this->filterTrainingCourseId = '';
        $this->resetPage();
        $this->clearSelection();
    }

    private function clearSelection()
    {
        $this->selectedIds = [];
        $this->selectAll = false;
    }

    private function baseApplicationQuery()
    {
        return User::query()
            ->select(
                'centers.name as center_name',
                'centers.code as center_code',
                'training_courses.course_name',
                'training_courses.course_code',
                'learner_training_applications.*',
                'users.name',
                'users.email',
                'users.middle_name',
                'users.last_name',
                'training_batches.batch_name',
                'training_batches.batch_code'
            )
            ->leftJoin('learner_training_applications', 'users.id', '=', 'learner_training_applications.user_id')
            ->leftJoin('centers', 'centers.id', '=', 'learner_training_applications.center_id')
            ->leftJoin('training_courses', 'training_courses.id', '=', 'learner_training_applications.training_course_id')
            ->leftJoin('training_batches', 'training_batches.id', '=', 'learner_training_applications.training_batch_id')
            ->whereIn('learner_training_applications.status', ['pending'])
            ->whereNull('learner_training_applications.training_batch_id')
            ->when($this->filterCenterId, function ($query) {
                $query->where('learner_training_applications.center_id', $this->filterCenterId);
            })
            ->when($this->filterTrainingCourseId, function ($query) {
                $query->where('learner_training_applications.training_course_id', $this->filterTrainingCourseId);
            })
            ->when($this->search, function ($query) {
                $search = '%' . trim($this->search) . '%';

                $query->where(function ($q) use ($search) {
                    $q->where('learner_training_applications.application_number', 'like', $search)
                        ->orWhere('users.name', 'like', $search)
                        ->orWhere('users.middle_name', 'like', $search)
                        ->orWhere('users.last_name', 'like', $search)
                        ->orWhere('users.email', 'like', $search)
                        ->orWhere('training_courses.course_name', 'like', $search)
                        ->orWhere('training_courses.course_code', 'like', $search)
                        ->orWhere('centers.name', 'like', $search)
                        ->orWhere('centers.code', 'like', $search);
                });
            });
    }

    private function reportApplicationQuery()
    {
        return LearnerTrainingApplication::query()
            ->select(
                'centers.name as center_name',
                'centers.code as center_code',
                'training_courses.course_name',
                'training_courses.course_code',
                'learner_training_applications.*',
                'users.full_name_searchable',
                'users.name',
                'users.middle_name',
                'users.last_name',
                'users.email'
            )
            ->leftJoin('users', 'users.id', '=', 'learner_training_applications.user_id')
            ->leftJoin('centers', 'centers.id', '=', 'learner_training_applications.center_id')
            ->leftJoin('training_courses', 'training_courses.id', '=', 'learner_training_applications.training_course_id')
            ->whereIn('learner_training_applications.status', ['pending'])
            ->whereNull('learner_training_applications.training_batch_id')
            ->when($this->filterCenterId, function ($query) {
                $query->where('learner_training_applications.center_id', $this->filterCenterId);
            })
            ->when($this->filterTrainingCourseId, function ($query) {
                $query->where('learner_training_applications.training_course_id', $this->filterTrainingCourseId);
            })
            ->when($this->search, function ($query) {
                $search = '%' . trim($this->search) . '%';

                $query->where(function ($q) use ($search) {
                    $q->where('learner_training_applications.application_number', 'like', $search)
                        ->orWhere('users.name', 'like', $search)
                        ->orWhere('users.middle_name', 'like', $search)
                        ->orWhere('users.last_name', 'like', $search)
                        ->orWhere('users.email', 'like', $search)
                        ->orWhere('training_courses.course_name', 'like', $search)
                        ->orWhere('training_courses.course_code', 'like', $search)
                        ->orWhere('centers.name', 'like', $search)
                        ->orWhere('centers.code', 'like', $search);
                });
            });
    }

    public function render()
    {
        $applicants = $this->baseApplicationQuery()
            ->orderByRaw("FIELD(learner_training_applications.status, 'pending')")
            ->orderBy('training_courses.course_name')
            ->orderBy('centers.name')
            ->paginate($this->pageCount);

        $this->trainingCourses = TrainingCourse::orderBy('course_name')->get();

        if ($this->trainingCourseId) {
            $course = TrainingCourse::find($this->trainingCourseId);
            $this->trainingCenters = $course?->centers ?? collect();
        }

        if ($this->trainingCourseId && $this->trainingCenterId) {
            $this->trainingBatches = TrainingBatch::query()
                ->where('training_course_id', $this->trainingCourseId)
                ->where('center_id', $this->trainingCenterId)
                ->whereIn('status', ['open', 'ongoing'])
                ->get();
        }

        return view('livewire.application.application-list-no-batch-livewire', [
            'applicants' => $applicants,
            'centers' => Center::orderBy('name')->get(),
            'trainingCourse' => TrainingCourse::orderBy('course_name')->get(),
        ]);
    }

    public function printReport()
    {
        $reportDetails = $this->reportApplicationQuery()
            ->orderBy('training_courses.course_name')
            ->orderBy('centers.name')
            ->orderByRaw("FIELD(learner_training_applications.status, 'pending')")
            ->get();

        if ($reportDetails->isEmpty()) {
            session()->flash('error', 'No records found for the selected filter.');
            return;
        }

        $selectedCenter = $this->filterCenterId ? Center::find($this->filterCenterId) : null;
        $selectedCourse = $this->filterTrainingCourseId ? TrainingCourse::find($this->filterTrainingCourseId) : null;

        $centerFilterLabel = $selectedCenter ? $selectedCenter->name : 'All Centers';
        $courseFilterLabel = $selectedCourse ? $selectedCourse->course_name : 'All Courses';

        $groupedByCourse = $reportDetails->groupBy('course_name');

        try {
            $pdf = new FPDF();
            $pdf->SetMargins(15, 15, 15);
            $pageWidth = 180;

            foreach ($groupedByCourse as $courseName => $learners) {
                $pdf->AddPage();

                $pdf->SetFont('Arial', 'B', 14);
                $pdf->SetTextColor(0, 0, 0);
                $pdf->Cell(0, 10, 'Pending Course Application Report', 0, 1, 'C');

                $pdf->SetFont('Arial', '', 8);
                $pdf->SetTextColor(100, 100, 100);
                $pdf->Cell(0, 5, 'Generated: ' . now()->format('F d, Y  h:i A'), 0, 1, 'C');
                $pdf->Cell(0, 5, 'Center Filter: ' . $centerFilterLabel, 0, 1, 'C');
                $pdf->Cell(0, 5, 'Course Filter: ' . $courseFilterLabel, 0, 1, 'C');

                if ($this->search) {
                    $pdf->Cell(0, 5, 'Search: ' . $this->search, 0, 1, 'C');
                }

                $pdf->Ln(4);

                $pdf->SetFont('Arial', 'B', 10);
                $pdf->SetTextColor(0, 0, 0);
                $pdf->Cell(0, 7, 'Course: ' . $courseName . ' (' . ($learners->first()->course_code ?? 'N/A') . ')', 0, 1, 'L');

                $pdf->SetDrawColor(180, 180, 180);
                $pdf->Line(15, $pdf->GetY(), 195, $pdf->GetY());
                $pdf->Ln(3);

                $pdf->SetFillColor(230, 230, 230);
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetFont('Arial', 'B', 9);
                $pdf->SetX(15);
                $pdf->Cell(10, 7, '#', 1, 0, 'C', true);
                $pdf->Cell(70, 7, 'Full Name', 1, 0, 'C', true);
                $pdf->Cell(65, 7, 'Center', 1, 0, 'C', true);
                $pdf->Cell(35, 7, 'Status', 1, 1, 'C', true);

                $pdf->SetFont('Arial', '', 9);
                $count = 1;

                foreach ($learners as $learner) {
                    $fullName = trim($learner->full_name_searchable);

                    if (!$fullName) {
                        $fullName = trim(($learner->name ?? '') . ' ' . ($learner->middle_name ?? '') . ' ' . ($learner->last_name ?? ''));
                    }

                    $pdf->SetX(15);
                    $pdf->Cell(10, 6, $count++, 1, 0, 'C');
                    $pdf->Cell(70, 6, $fullName, 1, 0, 'L');
                    $pdf->Cell(65, 6, $learner->center_name ?? 'N/A', 1, 0, 'L');
                    $pdf->Cell(35, 6, ucfirst($learner->status), 1, 1, 'C');
                }

                $pdf->Ln(2);
                $pdf->SetFont('Arial', 'I', 8);
                $pdf->SetTextColor(80, 80, 80);
                $pdf->SetX(15);
                $pdf->Cell($pageWidth, 5, 'Total: ' . $learners->count() . ' learner(s)', 0, 1, 'R');

                $pdf->SetTextColor(150, 150, 150);
                $pdf->SetFont('Arial', 'I', 7);
                $pdf->SetXY(15, 282);
                $pdf->Cell($pageWidth, 5, 'Page ' . $pdf->PageNo(), 0, 0, 'C');
            }

            $pdfContent = base64_encode($pdf->Output('S'));
            $this->dispatch('open-pdf', pdf: $pdfContent);
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function assignTrainingBatch()
    {
        if (empty($this->selectedIds)) {
            session()->flash('error', 'Please select at least one application.');
            return;
        }

        $selectedApplications = LearnerTrainingApplication::whereIn('id', $this->selectedIds)->get();

        foreach ($selectedApplications as $application) {
            if ($application->training_batch_id) {
                session()->flash('error', 'One or more selected applications already have a batch assigned. Please deselect those before proceeding.');
                return;
            }
        }

        $uniqueCourses = $selectedApplications->pluck('training_course_id')->unique();
        $uniqueCenters = $selectedApplications->pluck('center_id')->unique();

        if ($uniqueCourses->count() > 1 || $uniqueCenters->count() > 1) {
            session()->flash('error', 'All selected applications must belong to the same training course and center.');
            return;
        }

        $this->trainingCourseId = $uniqueCourses->first();
        $this->trainingCenterId = $uniqueCenters->first();

        $this->trainingBatches = TrainingBatch::query()
            ->where('training_course_id', $this->trainingCourseId)
            ->where('center_id', $this->trainingCenterId)
            ->whereIn('status', ['open'])
            ->get();

        if ($this->trainingBatches->isEmpty()) {
            session()->flash('error', 'No available batches found for the selected course and center.');
            return;
        }

        $this->openAssignBatchModal = true;
    }

    public function confirmBatchAssignment()
    {
        $this->validate([
            'trainingBatchId' => 'required|exists:training_batches,id',
        ]);

        $selectedApplications = LearnerTrainingApplication::whereIn('id', $this->selectedIds)->get();

        LearnerTrainingApplication::whereIn('id', $this->selectedIds)
            ->update([
                'training_batch_id' => $this->trainingBatchId,
                'status' => 'approved',
            ]);

        $trainingBatchStudentRepository = new TrainingBatchStudentRepository();

        foreach ($selectedApplications as $application) {
            $alreadyEnrolled = TrainingBatchStudent::where('training_batch_id', $this->trainingBatchId)
                ->where('user_id', $application->user_id)
                ->exists();

            $user = User::find($application->user_id);

            if ($user) {
                $user->update(['is_confirmed' => 1]);

                $batchDetails = TrainingBatch::where('id', $this->trainingBatchId)->first();
                $courseDetails = TrainingCourse::where('id', $application->training_course_id)->first();
                $centerDetails = Center::where('id', $application->center_id)->first();

                $scheduleDetails = $batchDetails
                    ? TrainingScheduleItem::where('id', $batchDetails->training_schedule_item_id)->first()
                    : null;

                if ($user->email) {
                    $data = [
                        'user' => $user,
                        'batch' => $batchDetails,
                        'course' => $courseDetails,
                        'center' => $centerDetails,
                        'schedule' => $scheduleDetails,
                    ];

                    Mail::to($user->email)->queue(new BatchNotificationEmail($data));
                }
            }

            if (!$alreadyEnrolled) {
                $trainingBatchStudentRepository->create([
                    'training_batch_id' => $this->trainingBatchId,
                    'user_id' => $application->user_id,
                    'enrollment_date' => now()->toDateString(),
                    'enrollment_status' => 'enrolled',
                ]);
            }
        }

        $this->openAssignBatchModal = false;
        $this->selectedIds = [];
        $this->selectAll = false;
        $this->trainingBatchId = null;
        $this->trainingCourseId = null;
        $this->trainingCenterId = null;
        $this->trainingCourses = [];
        $this->trainingBatches = [];
        $this->trainingCenters = [];

        session()->flash('success', 'Batch assigned successfully to the selected applications.');
    }
}
