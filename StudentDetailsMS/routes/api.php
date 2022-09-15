<?php

use App\Http\Controllers\API\StudentDetailsController;
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

Route::get('user/{studentId}',[StudentDetailsController::class, 'index'])->name('index');

Route::post('user/create',[StudentDetailsController::class, 'create'])->name('create');

Route::post('user/update/',[StudentDetailsController::class, 'update'])->name('update');

Route::delete('user/delete/{studentId}',[StudentDetailsController::class, 'delete'])->name('delete');
Route::post('user/asignTeacher/',[StudentDetailsController::class, 'asignTeacher'])->name('asignTeacher');




});












// Route::get('user/view/{id}',[StudentDetailsController::class, 'edit'])->name('user.edit');
// Route::get('/u/{id}', function ($id) {

//     return $id;
// });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
