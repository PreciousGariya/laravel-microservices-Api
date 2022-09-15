<?php

namespace App\Http\Controllers;

use App\Events\SendMailNotification;
use App\Services\TeacherService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    //
    use ApiResponser;
    public $TeacherService;
    public function __construct(TeacherService $TeacherService)
    {
        $this->TeacherService = $TeacherService;
    }
    public function index($teacherId)
    {
        if(!(Auth::user()->user_type=='teacher' && Auth::user()->id==$teacherId)){
            return response()->json(array('error' => 'Access-Denied'), 200);
        }
        return $this->successResponse($this->TeacherService->getteacher($teacherId));
    }
    public function create(Request $request)
    {
        if(!(Auth::user()->user_type=='teacher' && Auth::user()->id==$request->teachers_id)){
            return response()->json(array('error' => 'Access-Denied'), 200);
        }
        // storing File
        $input = $request->all();

        $validator = Validator::make($input, [
            'teachers_id' => 'required',
            'image' => 'required|max:20000|mimes:jpg,png,jpeg',
            'address' => 'required',
            'current_school' => 'required',
            'previous_school' => 'required',
            'expertise' => 'required',
            'expertise' => 'required',
        ]);
        if (!$validator->fails()) {
            if ($files = $request->file('image')) {
                $timestamp = "ST_PROFILE_PIC" . time() . rand(1, 10000);
                $name = $timestamp . $files->getClientOriginalName();
                $files->move('TeacherImages', $name);
                // $path=Storage::move('StudentsImages',$name);
                $path = Url('/') . "/TeachersImages/" . $name;
                $user = [
                    "name" => "Sam",
                    "email" => "email@gmail.com",
                    "action" => "teachers Details Added",
                ];
                event(new SendMailNotification($user));
                // $request->offsetSet('student_id', $studentId);
                $request->offsetSet('profile_picture', $path);
                return $this->successResponse($this->TeacherService->creatteacher($request->all(), Response::HTTP_CREATED));
            }
        } else {
            return response()->json(array('error' => $validator->errors()->all()), 201);
        }
        // Storinf file

        // return $this->successResponse($this->TeacherService->creatteacher($request->all(), Response::HTTP_CREATED));

    }

    public function update(Request $request, $teacherId)
    {
        if(!(Auth::user()->user_type=='teacher' && Auth::user()->id==$teacherId)){
            return response()->json(array('error' => 'Access-Denied'), 200);
        }
        $input = $request->all();

        $validator = Validator::make($input, [
            // 'teachers_id' => 'required',
            'image' => 'max:20000|mimes:jpg,png,jpeg',
            'address' => 'required',
            'current_school' => 'required',
            'previous_school' => 'required',
            'expertise' => 'required',
            'expertise' => 'required',
        ]);
        if (!$validator->fails()) {
            if ($files = $request->file('image')) {
                $timestamp = "ST_PROFILE_PIC" . time() . rand(1, 10000);
                $name = $timestamp . $files->getClientOriginalName();
                $files->move('TeacherImages', $name);
                // $path=Storage::move('StudentsImages',$name);
                $path = Url('/') . "/TeachersImages/" . $name;
                $user = [
                    "name" => "Sam",
                    "email" => "email@gmail.com",
                    "action" => "teachers Details Added",
                ];
                event(new SendMailNotification($user));
                // $request->offsetSet('student_id', $studentId);
                $request->offsetSet('profile_picture', $path);
                $request->offsetSet('teachers_id', $teacherId);
                return $this->successResponse($this->TeacherService->updateTeacher($request->all(), Response::HTTP_CREATED));
            } else {
                $request->offsetSet('teachers_id', $teacherId);
                return $this->successResponse($this->TeacherService->updateTeacher($request->all(), Response::HTTP_CREATED));
            }
        } else {
            return response()->json(array('error' => $validator->errors()->all()), 201);
        }
    }

    public function delete($teacherId)
    {
        if(!(Auth::user()->user_type=='teacher' && Auth::user()->id==$teacherId)){
            return response()->json(array('error' => 'Access-Denied'), 200);
        }
    return $this->successResponse($this->TeacherService->deleteteacher($teacherId, Response::HTTP_CREATED));
    }
}
