<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => '/v1/admin', 'middleware' => ['auth:api']], function () {
    Route::put('user/verify/{teacherId}', [AdminController::class, 'VerifyTeacher'])->name('verifyTeacher');
    Route::post('student/AsignTeacher', [AdminController::class, 'AsignTeacher'])->name('AsignTeacher');
});

Route::group(['prefix' => '/v1'], function () {

    Route::post('login', [LoginController::class, 'Login'])->name('login');
    Route::post('register', [RegisterController::class, 'register'])->name('user.register');
});


Route::group(['prefix' => '/v1', 'middleware' => ['auth:api']], function () {

    Route::get('profile', [LoginController::class, 'profile'])->name('user_get');
    // teacher
    Route::get('teacher/view/{teacherId}', [TeacherController::class, 'index'])->name('index');
    Route::post('teacher/create', [TeacherController::class, 'create'])->name('save');
    Route::post('teacher/update/{teacherId}', [TeacherController::class, 'update'])->name('update');
    Route::delete('teacher/delete/{teacherId}', [TeacherController::class, 'delete'])->name('delete');

    // Teacher

    //Students Done
    Route::get('user/{studentId}', [StudentController::class, 'index'])->name('index');
    Route::post('user/create', [StudentController::class, 'create'])->name('create');
    Route::delete('user/delete/{studentId}', [StudentController::class, 'delete'])->name('delete');
    Route::post('user/update/{studentId}', [StudentController::class, 'update'])->name('update');

    Route::post('logout', [RegisterController::class, 'logout'])->name('user.logout');
});
