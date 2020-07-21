<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\EmployeeResource;
use App\Employee;
use App\Task;
use App\Attendance;
use App\Photo;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use JD\Cloudder\Facades\Cloudder;

use Illuminate\Support\Carbon;

class TaskController extends Controller
{

    public function index()
    {

        return response()->json(Task::get(),200);
    }


    public function create()
    {

    }

    //Route::post('tasks', 'TaskController@store')->middleware("cors");
    public function store(Request $request)
    {
        $tsk = new Task();
        $tsk->describtion = $request->input('describtion');
        $tsk->remarks = $request->input('remarks');
        $tsk->status = $request->input('status');

        $tsk->save();
        return response()->json($tsk,201);
    }

    public function show($id)
    {
    $article = Task::find($id); //id comes from route
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
        $tsk = Task::findOrfail($id);
        if($tsk->delete()){
            return response()->json(null,204);
        }
        return "Error while deleting";
    }
}
