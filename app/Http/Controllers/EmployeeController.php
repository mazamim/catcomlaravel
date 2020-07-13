<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Resources\EmployeeResource;
use App\Employee;
use App\Photo;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use JD\Cloudder\Facades\Cloudder;

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
        $emp->emp_name = $request->input('lastname');
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
                    $photo->description = $cloundary_upload['public_id'];;
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
