<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/attendance', [App\Http\Controllers\HomeController::class, 'seeAttendance'])->name('s.seeAttendance');
Route::post('/updateDetails', [App\Http\Controllers\HomeController::class, 'userUpdate'])->name('user.update');
Route::post('/leave', [App\Http\Controllers\HomeController::class, 'applyLeave'])->name('apply.leave');
Route::resource('attendance', AttendanceController::class);
//Admin Routes
//1. For Leave approve/disapprove use resource route of AttendanceController
Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'handleAdmin'])->name('admin.route')->middleware('admin');
Route::get('admin/leaves', [App\Http\Controllers\HomeController::class, 'handleLeaves'])->name('admin.leave')->middleware('admin');
Route::get('admin/home/students', [App\Http\Controllers\HomeController::class, 'viewStudents'])->name('admin.students')->middleware('admin');
Route::get('admin/home/manageAttendance', [App\Http\Controllers\HomeController::class, 'manageAttendance'])->name('admin.attendance')->middleware('admin');
Route::post('admin/home/manageAttendance', [App\Http\Controllers\HomeController::class, 'populateAttendance'])->name('admin.populate')->middleware('admin');
Route::get('admin/home/reports', [App\Http\Controllers\HomeController::class, 'manageReports'])->name('admin.reports')->middleware('admin');
Route::post('admin/home/manageAttendance/userReport', [App\Http\Controllers\HomeController::class, 'allUserReportRange'])->name('admin.allUserReportRange')->middleware('admin');
Route::post('admin/home/grade', [App\Http\Controllers\HomeController::class, 'gradeStudent'])->name('admin.grade')->middleware('admin');
//use by admin & student
Route::post('/updateImage', [App\Http\Controllers\HomeController::class, 'updateImage'])->name('updateUserImage');





