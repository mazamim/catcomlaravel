<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\EmployeeResource;
use App\Employee;
use App\Attendance;
use App\Photo;
use App\MyProject;
use App\Customer;
use App\Client;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use JD\Cloudder\Facades\Cloudder;

use Illuminate\Support\Carbon;

class ClientController extends Controller
{
    public function index()
    {
        return response()->json(Client::get(),200);
    }


    public function create()
    {
  
    }

  
    public function store(Request $request)
    {
        $data = new Client();
        $data->client_name = $request->input('client_name');
        $data->mobile = $request->input('mobile');
        $data->emailadd = $request->input('emailadd');
        $data->description = $request->input('description');
     

        $data->save();
        return response()->json($data,201);
    }

 
    public function show($id)
    {
        $article = Client::find($id); //id comes from route
        if( $article ){
         return response()->json($article,200);
        }
        return "Task Not found"; // temporary error
    }

  
    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

  
    public function destroy($id)
    {
        $data = Client::findOrfail($id);
        if($data->delete()){
            return response()->json(null,204);
        }
        return "Error while deleting";
    }
}
