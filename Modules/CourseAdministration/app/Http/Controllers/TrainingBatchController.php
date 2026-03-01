<?php

namespace Modules\CourseAdministration\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\CourseAdministration\Http\Requests\CreateTrainingBatchesRequest;
use Modules\CourseAdministration\Http\Requests\UpdateTrainingBatchesRequest;
use Modules\CourseAdministration\Models\TrainingBatch;
use Modules\CourseAdministration\Models\TrainingCourse;
use Modules\CourseAdministration\Models\TrainingScheduleItem;
use Modules\Institution\Models\Center;

class TrainingBatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Return the view for listing training batches
        return view('courseadministration.training_batches.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('courseadministration.training_batches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTrainingBatchesRequest $request)
    {
        $validatedData = $request->validated();

        // Assign center_id based on role
        $validatedData['center_id'] = auth()->user()->hasRole('Business Admin')
            ? ($validatedData['center_id'] ?? null)
            : auth()->user()->center_id;

        if (is_null($validatedData['center_id'])) {
            return redirect()->route('training_batches.index')
                ->withInput()
                ->with('error', 'No center assigned. Please select or assign a center before creating a batch.');
        }

        TrainingBatch::create($validatedData);
        return redirect()
            ->route('training_batches.index')
            ->with('success', 'Training Batch created successfully.');
    }

    /** 
     * Show the specified resource.
     */
    public function show($uuid)
    {
        return view('courseadministration.training_batches.view', compact('uuid'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit($id)
    // {
    //     return view('courseadministration::edit');
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrainingBatchesRequest $request, $uuid)
    {
        // dd('update function called in TrainingBatchController', $request->validated());
        // Handle the update of an existing training batch
        $trainingBatch = TrainingBatch::where('uuid', $uuid)->firstOrFail();
        // Update the training batch with validated data
        $validatedData = $request->validated();
        // Update the training batch
        $trainingBatch->update($validatedData);
        // Redirect to the training batch show page with a success message
        return redirect()
            ->route('training_batches.show', $trainingBatch->uuid)
            ->with('success', 'Training batch updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        // Delete the specified training batch
        $trainingBatch = TrainingBatch::where('uuid', $uuid)->firstOrFail();
        // Delete the training batch
        $trainingBatch->delete();
        // Redirect to the training batches index with a success message
        return redirect()
            ->route('training_batches.index')
            ->with('success', 'Training batch deleted successfully.');
    }
}
