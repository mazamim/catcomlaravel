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

use Illuminate\Support\Carbon;

class EmployeeController extends Controller
{
    public function index()
    {

        return response()->json(Employee::get(),200);
    }


    public function store(Request $request)
    {
       /* $employee = Employee::create($request->all());
        return response()->json($employee,201); */

        $emp = new Employee();
        $emp->emp_name = $request->input('emp_name');
        $emp->lastname = $request->input('lastname');
        $emp->position = $request->input('position');
        $emp->description = $request->input('description');
        $emp->mobile = $request->input('mobile');
        $emp->emailadd = $request->input('emailadd');


        $emp->save();
        return response()->json($emp,201);

    }

    //Route::post('attendance', 'EmployeeController@saveAttendance')->middleware("cors");
    public function saveAttendance(Request $request)
    {

      if (DB::table('attendances')
      ->where('emp_id', '=', $request->input('emp_id'))
      ->where('punchOut', '=','1986/12/24 08:00:00')
      ->exists())
      {
        return "Already sign in";

      }


        $emp = new Attendance();

        $emp->punchIn = $request->input('punchIn');
        $rerurnPuchIN = date('Y-m-d H:i:s', strtotime($emp->punchIn));

        $emp->punchOut = $request->input('punchOut');
        $rerurnpunchOut = date('Y-m-d H:i:s', strtotime($emp->punchOut));

        $emp->emp_id = $request->input('emp_id');
        $emp->punchIn=$rerurnPuchIN;
        $emp->punchOut=$rerurnpunchOut;

        $emp->save();

      return response()->json($emp,201);

    }

  //  Route::post('attendancelistbydate', 'EmployeeController@listbydate')->middleware("cors");
  public function listbydate(Request $request)
  {

    if($request->input('emp_id')=="all")
    {

        // $startTime = Carbon::parse('2020-02-11 04:04:26');
        // $endTime = Carbon::parse('2020-02-11 04:36:56');
        // $totalDuration = $endTime->diffForHumans($startTime);

   $users = DB::table('attendances')
   ->join('employees', 'employees.id', '=', 'attendances.emp_id')
   ->select('attendances.*', 'employees.emp_name',DB::raw('TIMEDIFF(attendances.punchOut,attendances.punchIn) as timediff' ))
   ->get()
   ->toArray();




    return response()->json($users,201);
    }


elseif ($request->input('emp_id'))
{
    $users = DB::table('attendances')
    ->join('employees', 'employees.id', '=', 'attendances.emp_id')
    ->select('attendances.*', 'employees.emp_name',DB::raw('TIMEDIFF(attendances.punchOut,attendances.punchIn) as timediff' ))
    ->where('emp_id', '=', $request->input('emp_id'))
    ->whereBetween('punchIn', array($request->input('startIn'),$request->input('endIn')))
    ->get()
    ->toArray();

    return response()->json($users,201);

}
else
{

    $users = DB::table('attendances')
    ->join('employees', 'employees.id', '=', 'attendances.emp_id')
    ->select('attendances.*', 'employees.emp_name',DB::raw('TIMEDIFF(attendances.punchOut,attendances.punchIn) as timediff' ))
    ->whereBetween('punchIn', array($request->input('startIn'),$request->input('endIn')))
    ->get()
    ->toArray();

    return response()->json($users,201);

}


  }


    public function show($id)
    {
       /*return response()->json(Employee::find($id),200);*/

       $article = Employee::find($id); //id comes from route
       if( $article ){
        return response()->json($article,200);
       }
       return "Employee Not found"; // temporary error

    }

    public function update(Request $request, $id)
    {

        $emp = Employee::find($id);
        $emp->emp_name = $request->input('emp_name');
        $emp->lastname = $request->input('lastname');
        $emp->position = $request->input('position');
        $emp->description = $request->input('description');
        $emp->mobile = $request->input('mobile');
        $emp->emailadd = $request->input('emailadd');
        $emp->skills = $request->input('skills');
        $emp->address = $request->input('address');
        $emp->salarytype = $request->input('salarytype');
        $emp->salary = $request->input('salary');
        $emp->payment_mode = $request->input('payment_mode');
        $emp->bankdetails = $request->input('bankdetails');
        $emp->save();

        return response()->json($emp,200);
    }


   // Route::get('employeenames', 'EmployeeController@employeenames'); //only names
   public function employeenames()
   {



   $data = DB::table('employees')
   ->select('emp_name')
   ->get();


   return $data;

   }

   //Route::put('attendance', 'EmployeeController@updateAttendance');
    public function updateAttendance(Request $request)
    {

      if (DB::table('attendances')
      ->where('emp_id', '=', $request->input('emp_id'))
      ->where('punchOut', '=','1986/12/24 08:00:00')
      ->exists())
      {

        DB::table('attendances')
        ->where('emp_id', '=', $request->input('emp_id'))
        ->where('punchOut', '=','1986/12/24 08:00:00')
        ->update(['punchOut' => $request->input('punchOut')]);
        return response(200);
      }


    }

//Route::get('attendance/{id}', 'EmployeeController@checkAttendance');
    public function checkAttendance($id)
    {

        if (DB::table('attendances')
        ->where('emp_id', '=', $id)
        ->where('punchOut', '=','1986/12/24 08:00:00')
        ->exists())
        {

            $data = DB::table('attendances')
            ->where('emp_id', '=', $id)
            ->where('punchOut', '=','1986/12/24 08:00:00')
            ->get();
            return response()->json($data,200);
        }
        {

            return "not found";
        }
    }

//Route::get('attendanceall', 'EmployeeController@checkAttendanceAll');
    public function checkAttendanceAll()
    {

        if (DB::table('attendances')
        ->where('punchOut', '=','1986/12/24 08:00:00')
        ->exists())
        {

            $data = DB::table('attendances')
            ->where('punchOut', '=','1986/12/24 08:00:00')
            ->get();
            return response()->json($data,200);
        }
        {

            return "not found";
        }
    }

    //Route::get('attendancelist', 'EmployeeController@attendancelist');
    public function attendancelist()
    {
        $users = DB::table('attendances')
        ->join('employees', 'employees.id', '=', 'attendances.emp_id')
        ->select('attendances.*', 'employees.emp_name')
        ->get()->toArray();

        return response()->json($users,200);

    }


    public function destroy($id)
    {
        $emp = Employee::findOrfail($id);
        if($emp->delete()){
            return response()->json(null,204);
        }
        return "Error while deleting";
    }
    public function deleteDocuments($id)
    {
        DB::table('photos')->where('emp_id', '=', $id)->delete();
        return response()->json(null,204);
    }

    public function showmyPic($id)
    {

        $photos = DB::table('photos')->where('emp_id', '=', $id)->get();
        return response()->json($photos,200);

    }

    public function postmyPic(Request $request, $id)
    {

        $article = Employee::find($id); //id comes from route
        if( $article ){

            $photo = new Photo();
            $fileName="user_image";
            $path = $request->file('photo')->move(public_path("/"), $fileName);
            $photo->url = url('/'.$fileName);
            $photo->description = $request->input('description');
            $photo->emp_id = $request->input('emp_id');


            $photo->save();

            return response()->json($photo,200);

        }
        return "Employee Not found"; // temporary error
    }

    //Route::post('employeecloud/{id}', 'EmployeeController@cloud')->middleware("cors");
    public function cloud(Request $request,$id)
    {

        $article = Employee::find($id); //id comes from route
        if( $article ){

        $data = $request->all();

        if ($request->hasFile('image'))
        {

            Cloudder::upload($request->file('image'));
            $cloundary_upload = Cloudder::getResult();
                if ($cloundary_upload)
                {
                    $photo = new Photo();
                    $photo->emp_id = $id;
                   // $photo->url = Cloudder::show(Cloudder::getPublicId());
                   $photo->url = $cloundary_upload['url'];
                    $photo->description = $request->get('ImageCaption');
                    $photo->save();


                }

        }

        return response()->json($cloundary_upload,200);


    }
    return "Employee Not found"; // temporary error

    }


    public function cloudgetUrl($id)
    {
        $url = DB::table('photos')
        ->where('emp_id', '=', $id)
        ->get();
        return response()->json($url,200);

    }





}
