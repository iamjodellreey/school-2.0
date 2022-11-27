<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setups\ExamType\AllFormRequest;
use App\Models\ExamType;

class ExamTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $examTypeList = ExamType::all();
        return view('school.setup.exam_type.index', [
            'examTypeList' => $examTypeList,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('school.setup.exam_type.create');
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

        ExamType::create(['name' => $data['name']]);

        // TODO: Add flash success
        return redirect()->route('setups.exam.type.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamType $examType)
    {
        return view('school.setup.exam_type.edit', [
            'examType' => $examType,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AllFormRequest $request, ExamType $examType)
    {
        $data = $request->validated();

        $examType->update(['name' => $data['name']]);

        // TODO: Add flash success
        return redirect()->route('setups.exam.type.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamType $examType)
    {
        $examType->delete();
        return redirect()->route('setups.exam.type.index');
    }
}
