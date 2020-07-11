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
Route::put('employee/{id}', 'EmployeeController@update');
Route::delete('employee/{id}', 'EmployeeController@destroy');

Route::post('employeecloud/{id}', 'EmployeeController@cloud')->middleware("cors");


