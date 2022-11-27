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

class EmployeeLeaveController extends Controller
{
    public function index()
    {
        $data['allData'] = EmployeeLeave::orderBy('id','desc')->get();

        return view('school.employee.leave.index', [
            'allData' => $data['allData'],
        ]);
    }

    public function create()
    {
        $data['employees'] = User::where('usertype','employee')->get();
        $data['leave_purpose'] = LeavePurpose::all();

        return view('school.employee.leave.create', [
            'employees' => $data['employees'],
            'leave_purpose' => $data['leave_purpose'],
        ]);
    }

    public function store(Request $request)
    {
        if ($request->leave_purpose_id == "0") {
            $leavepurpose = new LeavePurpose();
            $leavepurpose->name = $request->name;
            $leavepurpose->save();
            $leave_purpose_id = $leavepurpose->id;
        }else{
            $leave_purpose_id = $request->leave_purpose_id;
        }

        $data = new EmployeeLeave();
        $data->employee_id = $request->employee_id;
        $data->leave_purpose_id = $leave_purpose_id;
        $data->start_date = date('Y-m-d',strtotime($request->start_date));
        $data->end_date = date('Y-m-d',strtotime($request->end_date));
        $data->save();

        // $notification = array(
        //     'message' => 'Employee Leave Data Inserted Successfully',
        //     'alert-type' => 'success'
        // );

        return redirect()->route('employees.leave.index');
    }

    public function edit($employeeId)
    {
        $data['editData'] = EmployeeLeave::find($employeeId);
        $data['employees'] = User::where('usertype','employee')->get();
        $data['leave_purpose'] = LeavePurpose::all();

        return view('school.employee.leave.edit', $data);
    }

    public function update(Request $request, $employeeId)
    {

        if ($request->leave_purpose_id == "0") {
            $leavepurpose = new LeavePurpose();
            $leavepurpose->name = $request->name;
            $leavepurpose->save();
            $leave_purpose_id = $leavepurpose->id;
        }else{
            $leave_purpose_id = $request->leave_purpose_id;
        }

        $data = EmployeeLeave::find($employeeId);
        $data->employee_id = $request->employee_id;
        $data->leave_purpose_id = $leave_purpose_id;
        $data->start_date = date('Y-m-d',strtotime($request->start_date));
        $data->end_date = date('Y-m-d',strtotime($request->end_date));
        $data->save();

        // $notification = array(
        //     'message' => 'Employee Leave Data Updated Successfully',
        //     'alert-type' => 'success'
        // );

        return redirect()->route('employees.leave.index');
    }

    public function delete($employeeId)
    {
        $leave = EmployeeLeave::find($employeeId);
        $leave->delete();

        // $notification = array(
        //     'message' => 'Employee Leave Data Deleted Successfully',
        //     'alert-type' => 'success'
        // );

        return redirect()->route('employees.leave.index');
    }
}
