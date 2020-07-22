<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\EmployeeResource;
use App\Employee;
use App\Task;
use App\Attendance;
use App\Photo;
use App\MyProject;
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
        return response()->json(Project::get(),200);
    }


    public function create()
    {
  
    }

  
    public function store(Request $request)
    {
        $data = new Project();
        $data->address = $request->input('address');
        $data->jobType = $request->input('jobType');
        $data->describtion = $request->input('describtion');
        $data->status = $request->input('status');
        $data->remarks = $request->input('remarks');

        $data->save();
        return response()->json($data,201);
    }

 
    public function show($id)
    {
        $article = Project::find($id); //id comes from route
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
        $data = Project::findOrfail($id);
        if($data->delete()){
            return response()->json(null,204);
        }
        return "Error while deleting";
    }
}
