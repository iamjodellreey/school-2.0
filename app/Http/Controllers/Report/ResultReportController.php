<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\ExamType;
use App\Models\StudentMarks;

use PDF;
use App\Models\AssignStudent;
use App\Models\Student;

class ResultReportController extends Controller
{
    public function index(){
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['exam_type'] = ExamType::all();

        return view('school.report.result.index', $data);
    }

    public function get(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_type_id = $request->exam_type_id;

        $singleResult = StudentMarks::where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_type_id)->first();

        if ($singleResult == true) {
            $data['allData'] = StudentMarks::select('year_id','class_id','exam_type_id','student_id')->where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_type_id)->groupBy('year_id')->groupBy('class_id')->groupBy('exam_type_id')->groupBy('student_id')->get();

            $pdf = PDF::loadView('school.report.result.details', $data);
            $pdf->SetProtection(['copy', 'print'], '', 'pass');
            return $pdf->stream('document.pdf');

        }else{
            // $notification = array(
            // 	'message' => 'Sorry These Criteria Does not match',
            // 	'alert-type' => 'error'
            // );

            return redirect()->back();
        }
    }

    public function idIndex()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        return view('school.report.id_card.index', [
            'years' => $data['years'],
            'classes' => $data['classes'],
        ]);
    }

    public function idGet(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;

        $check_data = Student::where('year_id',$year_id)->where('class_id',$class_id)->first();

        if ($check_data == true) {
            $data['allData'] = Student::where('year_id',$year_id)->where('class_id',$class_id)->get();

            $pdf = PDF::loadView('school.report.id_card.details', $data);
            $pdf->SetProtection(['copy', 'print'], '', 'pass');

            return $pdf->stream('document.pdf');

        }else{

            // $notification = array(
            // 	'message' => 'Sorry These Criteria Does not match',
            // 	'alert-type' => 'error'
            // );

            return redirect()->back();

        }
    }
}
