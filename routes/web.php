<?php

use App\Http\Controllers\Account\AccountSalaryController;
use App\Http\Controllers\Account\AccountStudentFeeController;
use App\Http\Controllers\Account\OtherCostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\Employee\EmployeeAttendanceController;
use App\Http\Controllers\Employee\EmployeeLeaveController;
use App\Http\Controllers\Employee\EmployeeRegistrationController;
use App\Http\Controllers\Employee\EmployeeSalaryController;
use App\Http\Controllers\Employee\MonthlySalaryController;
use App\Http\Controllers\Mark\GradeController;
use App\Http\Controllers\Mark\MarksController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Report\AttendanceReportController;
use App\Http\Controllers\Report\MarkSheetController;
use App\Http\Controllers\Report\ProfitController;
use App\Http\Controllers\Report\ResultReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Setup\StudentClassController;
use App\Http\Controllers\Setup\StudentYearController;
use App\Http\Controllers\Setup\StudentGroupController;
use App\Http\Controllers\Setup\StudentShiftController;
use App\Http\Controllers\Setup\FeeCategoryController;
use App\Http\Controllers\Setup\FeeCategoryAmountController;
use App\Http\Controllers\Setup\ExamTypeController;
use App\Http\Controllers\Setup\SchoolSubjectController;
use App\Http\Controllers\Setup\AssignSubjectController;
use App\Http\Controllers\Setup\DesignationController;
use App\Http\Controllers\Student\ExamFeeController;
use App\Http\Controllers\Student\MonthlyFeeController;
use App\Http\Controllers\Student\StudentFeeController;
use App\Http\Controllers\Student\StudentRegistrationController;
use App\Http\Controllers\Student\StudentRollController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// TODO: Update to new group syntax


Route::group(['middleware' => 'auth'],function(){
    // TODO: Check if this route is still needed
    // Route::get('/profile', function() {
    //     return view('profile.show');
    // })->name('admin.profile');

    // Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::group(
        [
            'prefix' => 'users',
            'as' => 'users.'
        ],
        function () {
            Route::get('/index', [UserController::class, 'index'])->name('index');
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
            Route::post('/{user}/update', [UserController::class, 'update'])->name('update');
            Route::get('/{user}/delete', [UserController::class, 'delete'])->name('delete');
            Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        }
    );

    // Setup Management
    Route::group(
        [
            'prefix' => 'setups',
            'as' => 'setups.'
        ],
        function(){
            // group student class
            Route::get('student/class/index', [StudentClassController::class, 'index'])->name('student.class.index');
            Route::get('student/class/create', [StudentClassController::class, 'create'])->name('student.class.create');
            Route::post('student/class/store', [StudentClassController::class, 'store'])->name('student.class.store');
            Route::get('student/class/{studentClass}/edit', [StudentClassController::class, 'edit'])->name('student.class.edit');
            Route::post('student/class/{studentClass}/update', [StudentClassController::class, 'update'])->name('student.class.update');
            Route::get('student/class/{studentClass}/delete', [StudentClassController::class, 'destroy'])->name('student.class.delete');

            // group student year
            Route::get('student/year/index', [StudentYearController::class, 'index'])->name('student.year.index');
            Route::get('student/year/create', [StudentYearController::class, 'create'])->name('student.year.create');
            Route::post('student/year/store', [StudentYearController::class, 'store'])->name('student.year.store');
            Route::get('student/year/{studentYear}/edit', [StudentYearController::class, 'edit'])->name('student.year.edit');
            Route::post('student/year/{studentYear}/update', [StudentYearController::class, 'update'])->name('student.year.update');
            Route::get('student/year/{studentYear}/delete', [StudentYearController::class, 'destroy'])->name('student.year.delete');

            // group student group
            Route::get('student/group/index', [StudentGroupController::class, 'index'])->name('student.group.index');
            Route::get('student/group/create', [StudentGroupController::class, 'create'])->name('student.group.create');
            Route::post('student/group/store', [StudentGroupController::class, 'store'])->name('student.group.store');
            Route::get('student/group/{studentGroup}/edit', [StudentGroupController::class, 'edit'])->name('student.group.edit');
            Route::post('student/group/{studentGroup}/update', [StudentGroupController::class, 'update'])->name('student.group.update');
            Route::get('student/group/{studentGroup}/delete', [StudentGroupController::class, 'destroy'])->name('student.group.delete');

            // group student shift
            Route::get('student/shift/index', [StudentShiftController::class, 'index'])->name('student.shift.index');
            Route::get('student/shift/create', [StudentShiftController::class, 'create'])->name('student.shift.create');
            Route::post('student/shift/store', [StudentShiftController::class, 'store'])->name('student.shift.store');
            Route::get('student/shift/{studentShift}/edit', [StudentShiftController::class, 'edit'])->name('student.shift.edit');
            Route::post('student/shift/{studentShift}/update', [StudentShiftController::class, 'update'])->name('student.shift.update');
            Route::get('student/shift/{studentShift}/delete', [StudentShiftController::class, 'destroy'])->name('student.shift.delete');

            // group fee category
            Route::get('fee/category/index', [FeeCategoryController::class, 'index'])->name('fee.category.index');
            Route::get('fee/category/create', [FeeCategoryController::class, 'create'])->name('fee.category.create');
            Route::post('fee/category/store', [FeeCategoryController::class, 'store'])->name('fee.category.store');
            Route::get('fee/category/{feeCategory}/edit', [FeeCategoryController::class, 'edit'])->name('fee.category.edit');
            Route::post('fee/category/{feeCategory}/update', [FeeCategoryController::class, 'update'])->name('fee.category.update');
            Route::get('fee/category/{feeCategory}/delete', [FeeCategoryController::class, 'destroy'])->name('fee.category.delete');

            // group fee category amount
            Route::get('fee/amount/index', [FeeCategoryAmountController::class, 'index'])->name('fee.category.amount.index');
            Route::get('fee/amount/create', [FeeCategoryAmountController::class, 'create'])->name('fee.category.amount.create');
            Route::post('fee/amount/store', [FeeCategoryAmountController::class, 'store'])->name('fee.category.amount.store');
            Route::get('fee/amount/{feeCategoryId}/edit', [FeeCategoryAmountController::class, 'edit'])->name('fee.category.amount.edit');
            Route::post('fee/amount/{feeCategoryId}/update', [FeeCategoryAmountController::class, 'update'])->name('fee.category.amount.update');
            Route::get('fee/amount/{feeCategoryId}/details', [FeeCategoryAmountController::class, 'details'])->name('fee.category.amount.details');

            // group exam type
            Route::get('exam/type/index', [ExamTypeController::class, 'index'])->name('exam.type.index');
            Route::get('exam/type/create', [ExamTypeController::class, 'create'])->name('exam.type.create');
            Route::post('exam/type/store', [ExamTypeController::class, 'store'])->name('exam.type.store');
            Route::get('exam/type/{examType}/edit', [ExamTypeController::class, 'edit'])->name('exam.type.edit');
            Route::post('exam/type/{examType}/update', [ExamTypeController::class, 'update'])->name('exam.type.update');
            Route::get('exam/type/{examType}/delete', [ExamTypeController::class, 'destroy'])->name('exam.type.delete');

            // group school subject
            Route::get('school/subject/index', [SchoolSubjectController::class, 'index'])->name('school.subject.index');
            Route::get('school/subject/create', [SchoolSubjectController::class, 'create'])->name('school.subject.create');
            Route::post('school/subject/store', [SchoolSubjectController::class, 'store'])->name('school.subject.store');
            Route::get('school/subject/{schoolSubject}/edit', [SchoolSubjectController::class, 'edit'])->name('school.subject.edit');
            Route::post('school/subject/{schoolSubject}/update', [SchoolSubjectController::class, 'update'])->name('school.subject.update');
            Route::get('school/subject/{schoolSubject}/delete', [SchoolSubjectController::class, 'destroy'])->name('school.subject.delete');

            // group assign subjects
            Route::get('assign/subject/index', [AssignSubjectController::class, 'index'])->name('assign.subject.index');
            Route::get('assign/subject/create', [AssignSubjectController::class, 'create'])->name('assign.subject.create');
            Route::post('assign/subject/store', [AssignSubjectController::class, 'store'])->name('assign.subject.store');
            Route::get('assign/subject/{classId}/edit', [AssignSubjectController::class, 'edit'])->name('assign.subject.edit');
            Route::post('assign/subject/{classId}/update', [AssignSubjectController::class, 'update'])->name('assign.subject.update');
            Route::get('assign/subject/{classId}/details', [AssignSubjectController::class, 'details'])->name('assign.subject.details');

            // group designation
            Route::get('designation/index', [DesignationController::class, 'index'])->name('designation.index');
            Route::get('designation/create', [DesignationController::class, 'create'])->name('designation.create');
            Route::post('designation/store', [DesignationController::class, 'store'])->name('designation.store');
            Route::get('designation/{designation}/edit', [DesignationController::class, 'edit'])->name('designation.edit');
            Route::post('designation/{designation}/update', [DesignationController::class, 'update'])->name('designation.update');
            Route::get('designation/{designation}/delete', [DesignationController::class, 'destroy'])->name('designation.delete');
        }
    );

    // Student Management

    Route::group(
        [
            'prefix' => 'students',
            'as' => 'students.'
        ],
        function () {
            Route::get('registration/index', [StudentRegistrationController::class, 'index'])->name('registration.index');
            Route::get('registration/create', [StudentRegistrationController::class, 'create'])->name('registration.create');
            Route::post('registration/store', [StudentRegistrationController::class, 'store'])->name('registration.store');
            Route::get('year/class/wise', [StudentRegistrationController::class, 'search'])->name('year.class.wise');
            Route::get('registration/{studentId}/edit', [StudentRegistrationController::class, 'edit'])->name('registration.edit');
            Route::post('registration/{studentId}/update}', [StudentRegistrationController::class, 'update'])->name('registration.update');
            Route::get('registration/{studentId}/promotion', [StudentRegistrationController::class, 'promotion'])->name('registration.promotion');
            Route::post('registration/update/{studentId}/promotion', [StudentRegistrationController::class, 'updatePromotion'])->name('registration.update.promotion');
            Route::get('registration/{studentId}/details', [StudentRegistrationController::class, 'details'])->name('registration.details');

            Route::get('/roll/generate/index', [StudentRollController::class, 'index'])->name('roll.index');
            Route::get('/reg/getstudents', [StudentRollController::class, 'show'])->name('roll.show');
            Route::post('/roll/generate/store', [StudentRollController::class, 'store'])->name('roll.store');

            Route::get('/reg/fee/index', [StudentFeeController::class, 'index'])->name('fee.index');
            Route::get('/reg/fee/classwisedata', [StudentFeeController::class, 'feeClassData'])->name('classwise.data');
            Route::get('/reg/fee/payslip', [StudentFeeController::class, 'payslip'])->name('fee.payslip');

            Route::get('/monthly/fee/index', [MonthlyFeeController::class, 'index'])->name('monthly.fee.index');
            Route::get('/monthly/fee/classwisedata', [MonthlyFeeController::class, 'feeClassData'])->name('monthly.fee.classwise.data');
            Route::get('/monthly/fee/payslip', [MonthlyFeeController::class, 'payslip'])->name('monthly.fee.payslip');

            Route::get('/exam/fee/index', [ExamFeeController::class, 'index'])->name('exam.fee.index');
            Route::get('/exam/fee/classwisedata', [ExamFeeController::class, 'feeClassData'])->name('exam.fee.classwise.data');
            Route::get('/exam/fee/payslip', [ExamFeeController::class, 'payslip'])->name('exam.fee.payslip');
        }
    );

    // Employee Management

    Route::group(
        [
            'prefix' => 'employees',
            'as' => 'employees.'
        ],
        function () {
            Route::get('reg/employee/index', [EmployeeRegistrationController::class, 'index'])->name('registration.index');
            Route::get('reg/employee/create', [EmployeeRegistrationController::class, 'create'])->name('registration.create');
            Route::post('reg/employee/store', [EmployeeRegistrationController::class, 'store'])->name('registration.store');
            Route::get('reg/employee/{employeeId}/edit', [EmployeeRegistrationController::class, 'edit'])->name('registration.edit');
            Route::post('reg/employee/{employeeId}/update', [EmployeeRegistrationController::class, 'update'])->name('registration.update');
            Route::get('reg/employee/{employeeId}/details', [EmployeeRegistrationController::class, 'details'])->name('registration.details');

            Route::get('salary/employee/index', [EmployeeSalaryController::class, 'index'])->name('salary.index');
            Route::get('salary/employee/{employeeId}/increment', [EmployeeSalaryController::class, 'increase'])->name('salary.increase');
            Route::post('salary/employee/{employeeId}/store', [EmployeeSalaryController::class, 'store'])->name('salary.store');
            Route::get('salary/employee/{employeeId}/details', [EmployeeSalaryController::class, 'details'])->name('salary.details');

            Route::get('leave/employee/index', [EmployeeLeaveController::class, 'index'])->name('leave.index');
            Route::get('leave/employee/create', [EmployeeLeaveController::class, 'create'])->name('leave.create');
            Route::post('leave/employee/store', [EmployeeLeaveController::class, 'store'])->name('leave.store');
            Route::get('leave/employee/{employeeId}/edit', [EmployeeLeaveController::class, 'edit'])->name('leave.edit');
            Route::post('leave/employee/{employeeId}/update', [EmployeeLeaveController::class, 'update'])->name('leave.update');
            Route::get('leave/employee/{employeeId}/delete', [EmployeeLeaveController::class, 'delete'])->name('leave.delete');

            // Employee Attendance All Routes
            Route::get('attendance/employee/index', [EmployeeAttendanceController::class, 'index'])->name('attendance.index');
            Route::get('attendance/employee/create', [EmployeeAttendanceController::class, 'create'])->name('attendance.create');
            Route::post('attendance/employee/store', [EmployeeAttendanceController::class, 'store'])->name('attendance.store');
            Route::get('attendance/employee/{date}/edit', [EmployeeAttendanceController::class, 'edti'])->name('attendance.edit');
            Route::get('attendance/employee/{date}/details', [EmployeeAttendanceController::class, 'details'])->name('attendance.details');

            Route::get('monthly/salary/view', [MonthlySalaryController::class, 'index'])->name('monthly.salary.index');
            Route::get('monthly/salary/get', [MonthlySalaryController::class, 'getSalary'])->name('monthly.salary.get');
            Route::get('monthly/salary/{employeeId}/payslip', [MonthlySalaryController::class, 'payslip'])->name('monthly.salary.payslip');
        }
    );

    Route::group(
        [
            'prefix' => 'marks',
            'as' => 'marks.'
        ],
        function () {
            Route::get('marks/entry/create', [MarksController::class, 'create'])->name('entry.create');
            Route::post('marks/entry/store', [MarksController::class, 'store'])->name('entry.store');
            Route::get('marks/entry/edit', [MarksController::class, 'edit'])->name('entry.edit');
            Route::get('marks/getstudents/edit', [MarksController::class, 'get'])->name('student.edit.get');
            Route::post('marks/entry/update', [MarksController::class, 'update'])->name('entry.update');

            Route::get('marks/grade/index', [GradeController::class, 'index'])->name('grade.index');
            Route::get('marks/grade/create', [GradeController::class, 'create'])->name('grade.create');
            Route::post('marks/grade/store', [GradeController::class, 'store'])->name('grade.store');
            Route::get('marks/grade/{id}/edit', [GradeController::class, 'edit'])->name('grade.edit');
            Route::post('marks/grade/{id}/update', [GradeController::class, 'update'])->name('grade.update');
        }
    );

    Route::get('marks/getsubject', [DefaultController::class, 'GetSubject'])->name('marks.getsubject');
    Route::get('student/marks/getstudents', [DefaultController::class, 'GetStudents'])->name('student.marks.getstudents');


    Route::group(
        [
            'prefix' => 'accounts',
            'as' => 'accounts.'
        ],
        function () {
            Route::get('student/fee/index', [AccountStudentFeeController::class, 'index'])->name('student.fee.index');
            Route::get('student/fee/create', [AccountStudentFeeController::class, 'create'])->name('student.fee.create');
            Route::get('student/fee/getstudent', [AccountStudentFeeController::class, 'getStudent'])->name('student.fee.getstudent');
            Route::post('student/fee/store', [AccountStudentFeeController::class, 'store'])->name('student.fee.store');

            // // Employee Salary Routes
            Route::get('account/salary/index', [AccountSalaryController::class, 'index'])->name('salary.index');
            Route::get('account/salary/create', [AccountSalaryController::class, 'create'])->name('salary.create');
            Route::get('account/salary/getemployee', [AccountSalaryController::class, 'getEmployee'])->name('salary.getemployee');
            Route::post('account/salary/store', [AccountSalaryController::class, 'store'])->name('salary.store');

            // // Other Cost Rotues

            Route::get('other/cost/index', [OtherCostController::class, 'index'])->name('other.cost.index');
            Route::get('other/cost/create', [OtherCostController::class, 'create'])->name('other.cost.create');
            Route::post('other/cost/store', [OtherCostController::class, 'store'])->name('other.cost.store');
            Route::get('other/cost/{id}/edit', [OtherCostController::class, 'edit'])->name('other.cost.edit');
            Route::post('other/cost/{id}/update', [OtherCostController::class, 'update'])->name('other.cost.update');
        }
    );

    Route::group(
        [
            'prefix' => 'reports',
            'as' => 'reports.'
        ],
        function () {
            Route::get('monthly/profit/index', [ProfitController::class, 'index'])->name('monthly.profit.index');
            Route::get('monthly/profit/datewise', [ProfitController::class, 'dateWise'])->name('monthly.profit.datewise.get');
            Route::get('monthly/profit/pdf', [ProfitController::class, 'pdf'])->name('monthly.profit.pdf');

            // MarkSheet Generate Routes
            Route::get('marksheet/generate/index', [MarkSheetController::class, 'index'])->name('marksheet.index');
            Route::get('marksheet/generate/get', [MarkSheetController::class, 'get'])->name('marksheet.get');

            // Attendance Report Routes
            Route::get('attendance/report/index', [AttendanceReportController::class, 'index'])->name('attendance.index');
            Route::get('report/attendance/get', [AttendanceReportController::class, 'get'])->name('attendance.get');

            // Student Result Report Routes
            Route::get('student/result/index', [ResultReportController::class, 'index'])->name('result.index');
            Route::get('student/result/get', [ResultReportController::class, 'get'])->name('result.get');

            // Student ID Card Routes
            Route::get('student/idcard/index', [ResultReportController::class, 'idIndex'])->name('idcard.index');
            Route::get('student/idcard/get', [ResultReportController::class, 'IdGet'])->name('idcard.get');
        }
    );
});

require __DIR__.'/auth.php';
