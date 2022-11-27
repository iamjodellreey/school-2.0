<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setups\StudentClass\AllFormRequest;
use App\Models\StudentClass;

class StudentClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studentClassList = StudentClass::all();
        return view('school.setup.student_class.index', [
            'studentClassList' => $studentClassList,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('school.setup.student_class.create');
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

        StudentClass::create(['name' => $data['name']]);

        // TODO: Add flash success
        return redirect()->route('setups.student.class.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentClass $studentClass)
    {
        return view('school.setup.student_class.edit', [
            'studentClass' => $studentClass,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AllFormRequest $request, StudentClass $studentClass)
    {
        $data = $request->validated();

        $studentClass->update(['name' => $data['name']]);

        // TODO: Add flash success
        return redirect()->route('setups.student.class.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentClass $studentClass)
    {
        $studentClass->delete();
        return redirect()->route('setups.student.class.index');
    }
}
