<?php

use App\Http\Controllers\API\TeacherDetailsController;
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
Route::group(['prefix' => '/v1'], function () {

Route::get('teacher/{teacherId}',[TeacherDetailsController::class, 'index'])->name('index');

Route::post('teacher/create',[TeacherDetailsController::class, 'create'])->name('create');

Route::post('teacher/update/',[TeacherDetailsController::class, 'update'])->name('update');
Route::delete('teacher/delete/{teacherId}',[TeacherDetailsController::class, 'delete'])->name('delete');


});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
