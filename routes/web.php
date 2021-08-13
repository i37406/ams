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
Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'handleAdmin'])->name('admin.route')->middleware('admin');
Route::post('/updateDetails', [App\Http\Controllers\HomeController::class, 'userUpdate'])->name('user.update');
Route::post('/updateImage', [App\Http\Controllers\HomeController::class, 'updateImage'])->name('updateUserImage');
Route::post('/leave', [App\Http\Controllers\HomeController::class, 'applyLeave'])->name('apply.leave');
Route::resource('attendance', AttendanceController::class);
Route::get('admin/home/leaves', [App\Http\Controllers\HomeController::class, 'handleLeaves'])->name('admin.leave')->middleware('admin');



