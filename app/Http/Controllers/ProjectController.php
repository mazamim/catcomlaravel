<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\EmployeeResource;
use App\Employee;
use App\Task;
use App\Attendance;
use App\Photo;
use App\MyProject;
use App\Ticketchild;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use JD\Cloudder\Facades\Cloudder;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return response()->json(MyProject::get(),200);
        $data = DB::table('my_projects')
        ->join('customers', 'customers.id', '=', 'my_projects.cus_id')
        ->join('clients', 'clients.id', '=', 'my_projects.cus_id')
        ->select('my_projects.*', 'customers.cus_name','clients.client_name')
        ->get();
       // ->simplePaginate(15);
        return response()->json($data,200);
    }


    public function create()
    {

    }

    //Route::post('projects', 'ProjectController@store')->middleware("cors");
    public function store(Request $request)
    {
        $data = new MyProject();
        $data->address = $request->input('address');
        $data->jobType = $request->input('jobType');
        $data->describtion = $request->input('describtion');
        $data->status = $request->input('status');
        $data->remarks = $request->input('remarks');
        $data->cus_id = $request->input('cus_id');
        $data->client_id = $request->input('cus_id');

        $data->save();
        return response()->json($data,201);
    }


    public function show($id)
    {

        $data = DB::table('my_projects')
        ->join('customers', 'customers.id', '=', 'my_projects.cus_id')
        ->join('clients', 'clients.id', '=', 'my_projects.cus_id')
        ->select('my_projects.*', 'customers.cus_name','clients.client_name')
        ->where('my_projects.id','=', $id)
        ->first();
        return response()->json($data,200);


    }


    public function edit($id)
    {
        //
    }

    //Route::put('project/{id}', 'ProjectController@update')->middleware("cors");
    public function update(Request $request, $id)
    {

        $data = MyProject::find($id);
        $data->address = $request->input('address');
        $data->jobType = $request->input('jobType');
        $data->describtion = $request->input('describtion');
        $data->status = $request->input('status');
        $data->remarks = $request->input('remarks');
        $data->cus_id = $request->input('cus_id');
        $data->client_id = $request->input('cus_id');

        $data->save();

      //  $data1 = new Ticketchild();
      if ($request->has('emp_names.0')){

   foreach($request->input('emp_names') as $value)
   {
    $data1 = new Ticketchild();
    $data1->emp_id  = $value;
    $data1->project_id = $id;
    $data1->save();
   }



   return response()->json(null,200);

}

return response()->json($data,200);
    }


    public function destroy($id)
    {
        $data = MyProject::findOrfail($id);
        if($data->delete()){
            return response()->json(null,204);
        }
        return "Error while deleting";
    }
}
