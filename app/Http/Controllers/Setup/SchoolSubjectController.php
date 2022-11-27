<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setups\SchoolSubject\AllFormRequest;
use App\Models\SchoolSubject;

class SchoolSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schoolSubjectList = SchoolSubject::all();
        return view('school.setup.subject.index', [
            'schoolSubjectList' => $schoolSubjectList,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('school.setup.subject.create');
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

        SchoolSubject::create(['name' => $data['name']]);

        // TODO: Add flash success
        return redirect()->route('setups.school.subject.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolSubject $schoolSubject)
    {
        return view('school.setup.subject.edit', [
            'schoolSubject' => $schoolSubject,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AllFormRequest $request, SchoolSubject $schoolSubject)
    {
        $data = $request->validated();

        $schoolSubject->update(['name' => $data['name']]);

        // TODO: Add flash success
        return redirect()->route('setups.school.subject.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolSubject $schoolSubject)
    {
        $schoolSubject->delete();
        return redirect()->route('setups.school.subject.index');
    }
}
