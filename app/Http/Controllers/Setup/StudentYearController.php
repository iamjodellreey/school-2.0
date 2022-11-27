<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setups\StudentYear\AllFormRequest;
use App\Models\StudentYear;

class StudentYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studentYearList = StudentYear::all();
        return view('school.setup.student_year.index', [
            'studentYearList' => $studentYearList,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('school.setup.student_year.create');
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

        StudentYear::create(['name' => $data['name']]);

        // TODO: Add flash success
        return redirect()->route('setups.student.year.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentYear $studentYear)
    {
        return view('school.setup.student_year.edit', [
            'studentYear' => $studentYear,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AllFormRequest $request, StudentYear $studentYear)
    {
        $data = $request->validated();

        $studentYear->update(['name' => $data['name']]);

        // TODO: Add flash success
        return redirect()->route('setups.student.year.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentYear $studentYear)
    {
        $studentYear->delete();
        return redirect()->route('setups.student.year.index');
    }
}
