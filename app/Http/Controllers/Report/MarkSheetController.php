<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\StudentMarks;
use App\Models\ExamType;
use App\Models\StudentClass;
use App\Models\StudentYear;
use App\Models\MarksGrade;


class MarkSheetController extends Controller
{
    public function index(){

        $data['years'] = StudentYear::orderBy('id','desc')->get();
        $data['classes'] = StudentClass::all();
        $data['exam_type'] = ExamType::all();

        return view('school.report.marksheet.index',[
            'years' => $data['years'],
            'classes' => $data['classes'],
            'exam_type' => $data['exam_type'],
        ]);
    }

    public function get(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_type_id = $request->exam_type_id;
        $id_no = $request->id_no;

        $count_fail = StudentMarks::where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_type_id)->where('id_no',$id_no)->where('marks','<','33')->get()->count();
        $singleStudent = StudentMarks::where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_type_id)->where('id_no',$id_no)->first();
        if ($singleStudent == true) {

        $allMarks = StudentMarks::with(['assign_subject','year'])->where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_type_id)->where('id_no',$id_no)->get();
        $allGrades = MarksGrade::all();

        return view('school.report.marksheet.details', compact('allMarks','allGrades','count_fail'));

        }else{

        // $notification = array(
        // 	'message' => 'Sorry These Criteria Donse not match',
        // 	'alert-type' => 'error'
        // );

        return redirect()->back();
        }
    }
}
