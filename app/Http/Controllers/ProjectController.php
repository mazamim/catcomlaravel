<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\EmployeeResource;
use App\Employee;
use App\Task;
use App\Attendance;
use App\Photo;
use App\MyProject;
use App\JobType;
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

    //Route::get('jobtypes', 'ProjectController@getjobtypes')->middleware("cors");

    public function getjobtypes()
    {

        $data = DB::table('job_types')
        ->get();

        return response()->json($data,200);
    }


//Route::get('countJobs', 'ProjectController@countJobs')->middleware("cors");

public function countJobs()
{



    $assigned = DB::table('my_projects')
    ->select(DB::raw('count(*) as x'))
    ->where('status', '=', 'Assigned')
    ->get();
    $area1 = json_encode($assigned, true);
    $assigned1 = trim($area1,"[{\"x\":}]");


    $pending = DB::table('my_projects')
    ->select(DB::raw('count(*) as x'))
    ->where('status', '=', 'Pending')
    ->get();
    $area2 = json_encode($pending, true);
    $pending1 = trim($area2,"[{\"x\":}]");

    $notClosed = DB::table('my_projects')
    ->select(DB::raw('count(*) as x'))
    ->where('status', '=', 'Completed_not_Closed')
    ->get();
    $area3 = json_encode($notClosed, true);
    $notClosed1 = trim($area3,"[{\"x\":}]");

    $notInvoiced = DB::table('my_projects')
    ->select(DB::raw('count(*) as x'))
    ->where('status', '=', 'Completed_not_Invoiced')
    ->get();
    $area4 = json_encode($notInvoiced, true);
    $notInvoiced1 = trim($area4,"[{\"x\":}]");

    $invoiceupdated = DB::table('my_projects')
    ->select(DB::raw('count(*) as x'))
    ->where('status', '=', 'Completed_and_Invoice_Updated')
    ->get();
    $area5 = json_encode($invoiceupdated, true);
    $invoiceupdated1 = trim($area5,"[{\"x\":}]");



    $products1 = collect(['name' => 'Assigned' , 'value' => $assigned1]);
    $products2 = collect(['name' =>'Pending' , 'value' => $pending1]);
    $products3 = collect(['name' =>'Completed_not_Closed' , 'value' => $notClosed1 ]);
    $products4 = collect(['name' => 'Completed_not_Invoiced', 'value' => $notInvoiced1]);
    $products5 = collect(['name' => 'Completed_and_Invoice_Updated', 'value' => $invoiceupdated1]);

$products=[$products1,$products2,$products3,$products4,$products5];
    return response()->json($products,200);
}



    //Route::get('projects8', 'ProjectController@show8')->middleware("cors");
    public function show8()
    {

        $data = DB::table('my_projects')
        ->join('customers', 'customers.id', '=', 'my_projects.cus_id')
        ->join('clients', 'clients.id', '=', 'my_projects.cus_id')
        ->select('my_projects.*', 'customers.cus_name','clients.client_name')
        ->orderBy('updated_at','DESC')
        ->limit(8)
        ->get();

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
        $data->client_id = $request->input('client_id');

        $data->save();
        return response()->json($data,201);
    }

    //Route::post('jobtypes', 'ProjectController@addjobtypes')->middleware("cors");
    public function addjobtypes(Request $request)
    {
        $data = new JobType();
        $data->jobType = $request->input('jobType');

        $data->save();
        return response()->json($data,201);
    }

   // Route::post('addbulk', 'ProjectController@addbulk')->middleware("cors");
   public function addbulk(Request $request)
   {
    $alldata = $request->input();
    $count=count($alldata)-1;

  for($i = 0; $i<=$count; $i++)
  {
    $data = new MyProject();
$data->address = $request->input($i.'.address');
$data->jobType = $request->input($i.'.jobType');
$data->describtion = $request->input($i.'.describtion');
$data->status = $request->input($i.'.status');
$data->remarks = $request->input($i.'.remarks');
$data->cus_id = $request->input($i.'.cus_id');
$data->client_id = $request->input($i.'.client_id');
$data->save();

    $data->save();

  }


return response()->json($alldata,201);

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
