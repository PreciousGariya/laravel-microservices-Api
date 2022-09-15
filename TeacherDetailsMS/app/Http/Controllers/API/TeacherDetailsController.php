<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TeacherDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Print_;

class TeacherDetailsController extends Controller
{
    //
    public function index($teacherId)
    {
        // echo "hello";
        // die();
        $data = TeacherDetails::where('teachers_id', $teacherId)->first();
        if (!empty($data)) {
            return response()->json(array('data' => $data, 'success' => 'success'), 200);
        } else {
            return response()->json(array('data' => null, 'success' => 'Not found'), 500);
        }
    }
    public function create(Request $request)
    {
        $data = new TeacherDetails;
        $input = $request->all();
        // print_r($input);
        // die();
        $validator = Validator::make($input, [
            'teachers_id' => 'required',
            'profile_picture' => 'required',
            'address' => 'required',
            'current_school' => 'required',
            'previous_school' => 'required',
            'experience' => 'required',
            'expertise' => 'required',
        ]);
        if (!$validator->fails()) {
            if ($request->profile_picture) {
                $data->profile_picture = $request->profile_picture;
                $data->teachers_id = $request->teachers_id;
                $data->address = $request->address;
                $data->current_school = $request->current_school;
                $data->previous_school = $request->previous_school;
                $data->experience = $request->experience;
                $data->expertise = $request->expertise;
            }else{
            $data->teachers_id = $request->teachers_id;
            $data->address = $request->address;
            $data->current_school = $request->current_school;
            $data->previous_school = $request->previous_school;
            $data->experience = $request->experience;
            $data->expertise = $request->expertise;
            }
            try {
                $store = $data->save();
                // Closures include ->first(), ->get(), ->pluck(), etc.
            } catch (\Illuminate\Database\QueryException $ex) {
                //dd($ex->getMessage());
                return response()->json(array('error' => $ex->getMessage()), 502);
                // Note any method of class PDOException can be called on $ex.
            }
            if ($store) {
                return response()->json(array('success' => 'Teacher Details Addedd Successfully'), 200);
            }
        } else {
            return response()->json(array('error' => $validator->errors()->all()), 201);
        }
    }

    public function Update(Request $request)
    {
        $input = $request->all();

        // print_r($input);
        // die();
        $validator = Validator::make($input, [
            'teachers_id' => 'required|exists:teachers_details,teachers_id',
            'address' => 'required',
            'current_school' => 'required',
            'previous_school' => 'required',
            'experience' => 'required',
            'expertise' => 'required',
        ]);
        if (!$validator->fails()) {
            if ($request->profile_picture) {
                // $data->profile_picture=$name;
                $affected = DB::table('teachers_details')
                    ->where('teachers_id', $request->teachers_id)
                    ->update([
                        'address' => $request->address,
                        'profile_picture' => $request->profile_picture,
                        'current_school' => $request->current_school,
                        'previous_school' => $request->previous_school,
                        'experience' => $request->experience,
                        'expertise' => $request->expertise,
                    ]);
                // notify
                return response()->json(array('success' => 'Details including Image Updated Successfully'), 200);
            } else {
                $affected = DB::table('teachers_details')
                    ->where('teachers_id', $request->teachers_id)
                    ->update([
                        'address' => $request->address,
                        'current_school' => $request->current_school,
                        'previous_school' => $request->previous_school,
                        'experience' => $request->experience,
                        'expertise' => $request->expertise,
                    ]);
                // Notify
                return response()->json(array('success' => 'Details Excluding Image Successfully'), 200);
            }
        } else {
            return response()->json(array('error' => $validator->errors()->all()), 201);
        }
    }


    public function delete($teacherId){
        $user=TeacherDetails::where('teachers_id',$teacherId);
        if($user->first()){
            if($user->delete()){
                return response()->json(array('Message' => 'Deleted Successfully'), 200);
            }else{
                return response()->json(array('Message' => 'error'), 200);
            }
        }else{
            return response()->json(array('Message' => 'Not Found'), 200);

        }
    }
}
