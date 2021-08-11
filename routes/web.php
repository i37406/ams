<?php

use Illuminate\Http\Request;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'handleAdmin'])->name('admin.route')->middleware('admin');
Route::post('/updateDetails', [App\Http\Controllers\HomeController::class, 'userUpdate'])->name('user.update');
Route::post('/attend', [App\Http\Controllers\HomeController::class, 'handleAttendance'])->name('attendance');
Route::post('/updateImage', [App\Http\Controllers\HomeController::class, 'updateImage'])->name('updateUserImage');


