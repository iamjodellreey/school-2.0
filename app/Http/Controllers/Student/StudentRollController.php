<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DiscountStudent;
use App\Models\Student;
use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use DB;
use PDF;

class StudentRollController extends Controller
{
    public function index()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();

        return view('school.student.roll.index', [
            'years' => $data['years'],
            'classes' => $data['classes'],
        ]);
    }

    public function show(Request $request)
    {
        $allData = Student::with(['student'])->where('year_id',$request->year_id)->where('class_id',$request->class_id)->get();
        return response()->json($allData);
    }

    public function store(Request $request)
    {
        // FIXME: error when roll is null
        $year_id = $request->year_id;
        $class_id = $request->class_id;

        if ($request->student_id !=null)
        {
            for ($i = 0; $i < count($request->student_id); $i++) {
                Student::where('year_id',$year_id)->where('class_id',$class_id)->where('student_id',$request->student_id[$i])->update(['roll' => $request->roll[$i]]);
            }
        }else {

            $notification = array(
            'message' => 'Sorry there are no student',
            'alert-type' => 'error'
        );

            return redirect()->back()->with($notification);
        }

        // $notification = array(
        //     'message' => 'Well Done Roll Generated Successfully',
        //     'alert-type' => 'success'
        // );

        return redirect()->route('students.roll.index');

    }
}
