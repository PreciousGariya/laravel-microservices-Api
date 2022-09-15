<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\StudentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponser;

class AdminController extends Controller
{
    use ApiResponser;
    public $StudentService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(StudentService $StudentService)
    {
        // print_r()

        $this->StudentService = $StudentService;
    }



   public function VerifyTeacher($teacherId){
    if(!(Auth::user()->user_type=='admin')){
        return response()->json(array('error' => 'Access-Denied'), 200);
    }
    $user=User::where('id',$teacherId);
        if($user->first()){
            if($user->update(['verified' => 1])){
                return response()->json(array('Message' => 'Verified Successfully'), 200);
            }else{
                return response()->json(array('Message' => 'error'), 200);
            }
        }else{
            return response()->json(array('Message' => 'Not Found'), 200);
        }
   }

   public function AsignTeacher(Request $request){
    if(!(Auth::user()->user_type=='admin')){
        return response()->json(array('error' => 'Access-Denied'), 200);
    }
    $input=$request->all();
    $validator = Validator::make($input, [
        'teachers_id' => 'required',
        'image' => 'max:20000|mimes:jpg,png,jpeg',
    ]);

    $verify_teacher= DB::table('users')->where(['id'=> $request->teachers_id,'user_type' => 'teacher'])->first();
    if(!$verify_teacher){
        return response()->json(array('error' => 'Teacher Not Found'), 200);
    }else{
        if (!$validator->fails()) {
            return $this->successResponse($this->StudentService->AsignTeacher($request->all()));
        }else{
            return response()->json(array('error' => $validator->errors()->all()), 201);
        }
    }
   }


}
