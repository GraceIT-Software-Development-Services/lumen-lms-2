<?php

namespace Modules\Institution\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Institution\Http\Requests\CreateCenterRequest;

class CenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('institution.center.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('institution.center.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCenterRequest $request) {}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('institution::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('institution::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
