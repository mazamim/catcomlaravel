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

//employee routes
Route::get('employees', 'EmployeeController@index');
Route::get('employeenames', 'EmployeeController@employeenames'); //only names
Route::get('employee/{id}', 'EmployeeController@show');
Route::get('employeepic/{id}', 'EmployeeController@showmyPic')->middleware("cors");
Route::post('employeepic/{id}', 'EmployeeController@postmyPic')->middleware("cors");
Route::post('employee', 'EmployeeController@store')->middleware("cors");
Route::post('attendance', 'EmployeeController@saveAttendance')->middleware("cors");
Route::put('attendance', 'EmployeeController@updateAttendance');
Route::get('attendance/{id}', 'EmployeeController@checkAttendance');
Route::get('attendanceall', 'EmployeeController@checkAttendanceAll');
Route::put('employee/{id}', 'EmployeeController@update');
Route::delete('employee/{id}', 'EmployeeController@destroy');
Route::get('attendancelist', 'EmployeeController@attendancelist');
Route::post('attendancelistbydate', 'EmployeeController@listbydate')->middleware("cors");
Route::post('employeecloud/{id}', 'EmployeeController@cloud')->middleware("cors");
Route::get('employeecloud/{id}', 'EmployeeController@cloudgetUrl')->middleware("cors");
Route::delete('employeedoc/{id}', 'EmployeeController@deleteDocuments');

//tasks routes
Route::get('tasks', 'TaskController@index')->middleware("cors");
Route::post('tasks', 'TaskController@store')->middleware("cors");
Route::get('task/{id}', 'TaskController@show')->middleware("cors");
Route::delete('task/{id}', 'TaskController@destroy')->middleware("cors");


//projects routes
Route::get('projects', 'ProjectController@index')->middleware("cors");
Route::get('projects8', 'ProjectController@show8')->middleware("cors");
Route::post('projects', 'ProjectController@store')->middleware("cors");
Route::post('jobtypes', 'ProjectController@addjobtypes')->middleware("cors");
Route::get('jobtypes', 'ProjectController@getjobtypes')->middleware("cors");
Route::get('countJobs', 'ProjectController@countJobs')->middleware("cors");
Route::get('countIndexPage', 'ProjectController@countIndexPage')->middleware("cors");
Route::post('addbulk', 'ProjectController@addbulk')->middleware("cors");
Route::get('project/{id}', 'ProjectController@show')->middleware("cors");
Route::get('projectchild/{id}', 'ProjectController@projectchild')->middleware("cors");
Route::delete('project/{id}', 'ProjectController@destroy')->middleware("cors");
Route::put('project/{id}', 'ProjectController@update')->middleware("cors");

//Customer routes
Route::get('customers', 'CustomerController@index')->middleware("cors");
Route::post('customers', 'CustomerController@store')->middleware("cors");
Route::get('customer/{id}', 'CustomerController@show')->middleware("cors");
Route::delete('customer/{id}', 'CustomerController@destroy')->middleware("cors");


//clients routes
Route::get('clients', 'ClientController@index')->middleware("cors");
Route::post('clients', 'ClientController@store')->middleware("cors");
Route::get('client/{id}', 'ClientController@show')->middleware("cors");
Route::delete('client/{id}', 'ClientController@destroy')->middleware("cors");


//RateCard routes
Route::get('ratecards', 'RateCardController@index')->middleware("cors");
Route::post('ratecards', 'RateCardController@store')->middleware("cors");
Route::post('addbulkratecard', 'RateCardController@addbulk')->middleware("cors");
Route::get('ratecard/{id}', 'RateCardController@show')->middleware("cors");
Route::delete('ratecard/{id}', 'RateCardController@destroy')->middleware("cors");




