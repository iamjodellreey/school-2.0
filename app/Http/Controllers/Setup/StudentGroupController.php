<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setups\StudentGroup\AllFormRequest;
use App\Models\StudentGroup;

class StudentGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studentGroupList = StudentGroup::all();
        return view('school.setup.student_group.index', [
            'studentGroupList' => $studentGroupList,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('school.setup.student_group.create');
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

        StudentGroup::create(['name' => $data['name']]);

        // TODO: Add flash success
        return redirect()->route('setups.student.group.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentGroup $studentGroup)
    {
        return view('school.setup.student_group.edit', [
            'studentGroup' => $studentGroup,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AllFormRequest $request, StudentGroup $studentGroup)
    {
        $data = $request->validated();

        $studentGroup->update(['name' => $data['name']]);

        // TODO: Add flash success
        return redirect()->route('setups.student.group.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentGroup $studentGroup)
    {
        $studentGroup->delete();
        return redirect()->route('setups.student.group.index');
    }
}
