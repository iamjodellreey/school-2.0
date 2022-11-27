<?php

namespace App\Http\Controllers\Mark;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\User;
use App\Models\DiscountStudent;

use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use DB;
use PDF;

use App\Models\StudentMarks;
use App\Models\ExamType;

use App\Models\MarksGrade;

class GradeController extends Controller
{
    public function index()
    {
        $data['allData'] = MarksGrade::all();

        return view('school.marks.grade_index',[
            'allData' => $data['allData']
        ]);
    }

    public function create()
    {
        return view('school.marks.grade_create');
    }

    public function store(Request $request)
    {
        $data = new MarksGrade();
        $data->grade_name = $request->grade_name;
        $data->grade_point = $request->grade_point;
        $data->start_marks = $request->start_marks;
        $data->end_marks = $request->end_marks;
        $data->start_point = $request->start_point;
        $data->end_point = $request->end_point;
        $data->remarks = $request->remarks;
        $data->save();

        // $notification = array(
        // 	'message' => 'Grade Marks Inserted Successfully',
        // 	'alert-type' => 'success'
        // );

        return redirect()->route('marks.grade.index');
    }

    public function edit($id)
    {
        $data['editData'] = MarksGrade::find($id);

        return view('school.marks.grade_edit',[
            'editData' => $data['editData'],
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = MarksGrade::find($id);
        $data->grade_name = $request->grade_name;
        $data->grade_point = $request->grade_point;
        $data->start_marks = $request->start_marks;
        $data->end_marks = $request->end_marks;
        $data->start_point = $request->start_point;
        $data->end_point = $request->end_point;
        $data->remarks = $request->remarks;
        $data->save();

        // $notification = array(
        //     'message' => 'Grade Marks Updated Successfully',
        //     'alert-type' => 'success'
        // );

        return redirect()->route('marks.grade.index');

    }
}
