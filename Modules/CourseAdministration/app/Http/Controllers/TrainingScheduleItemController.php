<?php

namespace Modules\CourseAdministration\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\CourseAdministration\Http\Requests\CreateTrainingScheduleItemRequest;
use Modules\CourseAdministration\Http\Requests\UpdateTrainingScheduleItemRequest;
use Modules\CourseAdministration\Models\TrainingScheduleItem;

class TrainingScheduleItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('courseadministration.schedule_items.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('courseadministration.schedule_items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTrainingScheduleItemRequest $request)
    {
        // Validate the request data
        $validated = $request->validated();
        // Logic to store the training schedule item
        TrainingScheduleItem::create($validated);
        // Redirect or return response
        return redirect()->route('training_schedule_items.index')
            ->with('success', 'Training Schedule Item created successfully.');
    }

    /**
     * Show the specified resource.
     */
    public function show($uuid)
    {
        $trainingScheduleItem = TrainingScheduleItem::where('uuid', $uuid)->firstOrFail();
        return view('courseadministration.schedule_items.view', compact('trainingScheduleItem'));
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
    public function update(UpdateTrainingScheduleItemRequest $request, $uuid)
    {
        // Validate the request data
        $validated = $request->validated();
        // dd($validated);
        // Logic to update the training schedule item
        $trainingScheduleItem = TrainingScheduleItem::where('uuid', $uuid)->firstOrFail();
        $trainingScheduleItem->update($validated);
        // Redirect or return response
        return redirect()->route('training_schedule_items.index')
            ->with('success', 'Training Schedule Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        // Logic to delete the training schedule item
        $trainingScheduleItem = TrainingScheduleItem::where('uuid', $uuid)->firstOrFail();
        $trainingScheduleItem->delete();
        // Redirect or return response
        return redirect()->route('training_schedule_items.index')
            ->with('success', 'Training Schedule Item deleted successfully.');
    }
}
