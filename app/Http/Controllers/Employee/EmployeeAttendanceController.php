<?php

namespace App\Http\Controllers\Employee;

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

use App\Models\Designation;
use App\Models\EmployeeSallaryLog;

use App\Models\EmployeeLeave;
use App\Models\LeavePurpose;

use App\Models\EmployeeAttendance;


class EmployeeAttendanceController extends Controller
{
    public function index()
    {
        $data['allData'] = EmployeeAttendance::select('date')->groupBy('date')->orderBy('id','DESC')->get();

        return view('school.employee.attendance.index', [
            'allData' => $data['allData'] ,
        ]);
    }

    public function create()
    {
        $data['employees'] = User::where('usertype','employee')->get();

        return view('school.employee.attendance.create', [
            'employees' => $data['employees'],
        ]);
    }


    public function store(Request $request)
    {
        EmployeeAttendance::where('date', date('Y-m-d', strtotime($request->date)))->delete();
        $countemployee = count($request->employee_id);

        for ($i= 0; $i < $countemployee; $i++) {
            $attend_status = 'attend_status'.$i;
            $attend = new EmployeeAttendance();
            $attend->date = date('Y-m-d',strtotime($request->date));
            $attend->employee_id = $request->employee_id[$i];
            $attend->attend_status = $request->$attend_status;
            $attend->save();
        }

        // $notification = array(
        // 	'message' => 'Employee Attendace Data Update Successfully',
        // 	'alert-type' => 'success'
        // );

        return redirect()->route('employees.attendance.index');
    }

    public function edit($date)
    {
        $data['editData'] = EmployeeAttendance::where('date',$date)->get();
        $data['employees'] = User::where('usertype','employee')->get();

        return view('school.employee.attendance.edit', [
            'editData' => $data['editData'],
            'employees' => $data['employees'],
        ]);
    }

    public function details($date)
    {
        $data['details'] = EmployeeAttendance::where('date',$date)->get();

        return view('school.employee.attendance.details', [
            'details' => $data['details'],
        ]);
    }
}
