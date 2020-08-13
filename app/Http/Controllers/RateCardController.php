<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\EmployeeResource;
use App\Employee;
use App\Attendance;
use App\Photo;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use JD\Cloudder\Facades\Cloudder;
use App\RateCard;
use Illuminate\Support\Carbon;

class RateCardController extends Controller
{

    //Route::get('ratecards', 'RateCardController@index')->middleware("cors");
    public function index()
    {
        return response()->json(RateCard::get(),200);
    }


    public function create()
    {
        //
    }

//Route::post('ratecards', 'RateCardController@store')->middleware("cors");
    public function store(Request $request)
    {
        //
    }

    //Route::get('ratecard/{id}', 'RateCardController@show')->middleware("cors");
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    //Route::delete('ratecard/{id}', 'RateCardController@destroy')->middleware("cors");
    public function destroy($id)
    {
        //
    }

    //Route::post('addbulkratecard', 'RateCardController@addbulk')->middleware("cors");
    public function addbulk(Request $request)
    {
        $alldata = $request->input();
        $count=count($alldata)-1;
try{

    DB::beginTransaction();
    for($i = 0; $i<=$count; $i++)
    {
      $data = new RateCard();
  $data->sor = $request->input($i.'.sor');
  $data->description = $request->input($i.'.description');
  $data->uom = $request->input($i.'.uom');
  $data->rate = $request->input($i.'.rate');
  $data->category = $request->input($i.'.category');
  $data->client_id = $request->input($i.'.client_id');
  $data->remarks = $request->input($i.'.remarks');
  $data->save();

    }

    DB::commit();
}


catch(Exception $e)
{
    DB::rollback();

}
return response()->json(null,201);
    }
}
