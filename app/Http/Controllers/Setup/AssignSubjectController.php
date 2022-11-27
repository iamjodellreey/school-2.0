<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolSubject;
use App\Models\StudentClass;
use App\Models\AssignSubject;

class AssignSubjectController extends Controller
{
    public function index()
    {
        $assignSubjectList = AssignSubject::select('class_id')->groupBy('class_id')->get();

        return view('school.setup.assign_subject.index', [
            'assignSubjectList' => $assignSubjectList,
        ]);
    }

    public function create()
    {
        $dataList['subjects'] = SchoolSubject::all();
        $dataList['classes'] = StudentClass::all();

        return view('school.setup.assign_subject.create', [
            'subjects' => $dataList['subjects'],
            'classes' => $dataList['classes'],
        ]);
    }

	public function store(Request $request)
    {
        $subjectCount = count($request->subject_id);

        if ($subjectCount != null) {
            for ($i = 0; $i < $subjectCount; $i++) {
                AssignSubject::create([
                    'class_id' => $request->class_id,
                    'subject_id' => $request->subject_id[$i],
                    'full_mark' => $request->full_mark[$i],
                    'pass_mark' => $request->pass_mark[$i],
                    'subjective_mark' => $request->subjective_mark[$i],
                ]);
            }
        }

        return redirect()->route('setups.assign.subject.index');
    }

	public function edit($classId)
    {
        $data['editData'] = AssignSubject::where('class_id', $classId)->orderBy('subject_id','asc')->get();
        $data['subjects'] = SchoolSubject::all();
        $data['classes'] = StudentClass::all();

        return view('school.setup.assign_subject.edit', [
            'editData' => $data['editData'],
            'subjects' => $data['subjects'],
            'classes' => $data['classes'],
        ]);
	}

    public function update(Request $request, $classId)
    {
        $countClass = count($request->subject_id);
        AssignSubject::where('class_id', $classId)->delete();
                for ($i = 0; $i < $countClass; $i++) {
                    AssignSubject::create([
                        'class_id' => $request->class_id,
                        'subject_id' => $request->subject_id[$i],
                        'full_mark' => $request->full_mark[$i],
                        'pass_mark' => $request->pass_mark[$i],
                        'subjective_mark' => $request->subjective_mark[$i],
                    ]);
                }

        return redirect()->route('setups.assign.subject.index');
    }

	public function details($classId)
    {
        $data['detailsData'] = AssignSubject::where('class_id', $classId)->orderBy('subject_id','asc')->get();

        return view('school.setup.assign_subject.details', [
            'detailsData' => $data['detailsData'],
        ]);
    }
}
