<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('employees', 'EmployeeController@index');
Route::get('employee/{id}', 'EmployeeController@show');
Route::get('employeepic/{id}', 'EmployeeController@showmyPic')->middleware("cors");
Route::post('employeepic/{id}', 'EmployeeController@postmyPic')->middleware("cors");
Route::post('employee', 'EmployeeController@store')->middleware("cors");
Route::post('attendance', 'EmployeeController@saveAttendance')->middleware("cors");
Route::put('attendance', 'EmployeeController@updateAttendance');
Route::get('attendance/{id}', 'EmployeeController@checkAttendance');
Route::put('employee/{id}', 'EmployeeController@update');
Route::delete('employee/{id}', 'EmployeeController@destroy');
Route::get('attendancelist', 'EmployeeController@attendancelist');

Route::post('employeecloud/{id}', 'EmployeeController@cloud')->middleware("cors");
Route::get('employeecloud/{id}', 'EmployeeController@cloudgetUrl')->middleware("cors");
Route::delete('employeedoc/{id}', 'EmployeeController@deleteDocuments');





