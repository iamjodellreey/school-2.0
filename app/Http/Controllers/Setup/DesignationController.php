<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setups\Designation\AllFormRequest;
use App\Models\Designation;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $designationList = Designation::all();
        return view('school.setup.designation.index', [
            'designationList' => $designationList,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('school.setup.designation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AllFormRequest $request)
    {
        $data = $request->validated();

        Designation::create(['name' => $data['name']]);

        // TODO: Add flash success
        return redirect()->route('setups.designation.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Designation $designation)
    {
        return view('school.setup.designation.edit', [
            'designation' => $designation,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AllFormRequest $request, Designation $designation)
    {
        $data = $request->validated();

        $designation->update(['name' => $data['name']]);

        // TODO: Add flash success
        return redirect()->route('setups.designation.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Designation $designation)
    {
        $designation->delete();
        return redirect()->route('setups.designation.index');
    }
}
