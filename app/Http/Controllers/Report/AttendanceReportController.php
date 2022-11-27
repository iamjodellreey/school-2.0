<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\EmployeeAttendance;
use PDF;

class AttendanceReportController extends Controller
{
    public function index()
    {
        $data['employees'] = User::where('usertype','employee')->get();
        return view('school.report.attendance.index', [
            'employees' => $data['employees'],
        ]);
    }

    public function get(Request $request)
    {
        $employee_id = $request->employee_id;
        if ($employee_id != '') {
            $where[] = ['employee_id',$employee_id];
        }
        $date = date('Y-m', strtotime($request->date));
        if ($date != '') {
            $where[] = ['date','like',$date.'%'];
        }

        $singleAttendance = EmployeeAttendance::with(['user'])->where($where)->get();

        if ($singleAttendance == true) {
            $data['allData'] = EmployeeAttendance::with(['user'])->where($where)->get();
            $data['absents'] = EmployeeAttendance::with(['user'])->where($where)->where('attend_status','Absent')->get()->count();
            $data['leaves'] = EmployeeAttendance::with(['user'])->where($where)->where('attend_status','Leave')->get()->count();
            $data['month'] = date('m-Y', strtotime($request->date));

        $pdf = PDF::loadView('school.report.attendance.details', [
            'allData' => $data['allData'],
            'absents' => $data['absents'],
            'leaves' => $data['leaves'],
            'month' => $data['month'],
        ]);

        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');

        }else{

            // $notification = array(
            //     'message' => 'Sorry These Criteria Donse not match',
            //     'alert-type' => 'error'
            // );

            return redirect()->back();
        }
    }
}
