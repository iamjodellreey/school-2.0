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

class EmployeeSalaryController extends Controller
{
    public function index()
    {
        $data['allData'] = User::where('usertype','employee')->get();
        return view('school.employee.salary.index',[
            'allData' => $data['allData'],
        ]);
    }

    public function increase($employeeId)
    {
        $data['editData'] = User::find($employeeId);

        return view('school.employee.salary.increase', [
            'editData' => $data['editData'],
        ]);
    }

    public function store(Request $request, $employeeId)
    {
        $user = User::find($employeeId);
        $previous_salary = $user->salary;
        $present_salary = (float) $previous_salary + (float) $request->increment_salary;
        $user->salary = $present_salary;
        $user->save();

        $salaryData = new EmployeeSallaryLog();
        $salaryData->employee_id = $employeeId;
        $salaryData->previous_salary = $previous_salary;
        $salaryData->increment_salary = $request->increment_salary;
        $salaryData->present_salary = $present_salary;
        $salaryData->effected_salary = date('Y-m-d',strtotime($request->effected_salary));
        $salaryData->save();

        // $notification = array(
        //     'message' => 'Employee Salary Increment Successfully',
        //     'alert-type' => 'success'
        // );

        return redirect()->route('employees.salary.index');
    }


    public function details($employeeId)
    {
        $data['details'] = User::find($employeeId);
        $data['salary_log'] = EmployeeSallaryLog::where('employee_id', $data['details']->id)->get();

        return view('school.employee.salary.details', [
            'details' => $data['details'],
            'salary_log' => $data['salary_log'],
        ]);
    }
}
