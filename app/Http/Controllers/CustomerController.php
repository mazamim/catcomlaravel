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

class CustomerController extends Controller
{
    public function index()
    {

        $data = DB::table('customers')
                ->orderBy('id','DESC')
                ->limit(10)
                ->get();

                return response()->json($data,200);
    }


    public function create()
    {

    }


    public function store(Request $request)
    {
        $data = new Customer();
        $data->cus_name = $request->input('cus_name');
        $data->mobile = $request->input('mobile');
        $data->emailadd = $request->input('emailadd');
        $data->description = $request->input('description');


        $data->save();
        return response()->json($data,201);
    }


    public function show($id)
    {
        $article = Customer::find($id); //id comes from route
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
        $data = Customer::findOrfail($id);
        if($data->delete()){
            return response()->json(null,204);
        }
        return "Error while deleting";
    }
}
