<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setups\StudentShift\AllFormRequest;
use App\Models\StudentShift;

class StudentShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studentShiftList = StudentShift::all();
        return view('school.setup.student_shift.index', [
            'studentShiftList' => $studentShiftList,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('school.setup.student_shift.create');
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

        StudentShift::create(['name' => $data['name']]);

        // TODO: Add flash success
        return redirect()->route('setups.student.shift.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentShift $studentShift)
    {
        return view('school.setup.student_shift.edit', [
            'studentShift' => $studentShift,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AllFormRequest $request, StudentShift $studentShift)
    {
        $data = $request->validated();

        $studentShift->update(['name' => $data['name']]);

        // TODO: Add flash success
        return redirect()->route('setups.student.shift.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentShift $studentShift)
    {
        $studentShift->delete();
        return redirect()->route('setups.student.shift.index');
    }
}
