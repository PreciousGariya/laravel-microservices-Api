<?php

namespace App\Http\Controllers;

use App\Events\SendMailNotification;
use App\Traits\ApiResponser;
use App\Services\StudentService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PharIo\Manifest\Url;


class StudentController extends Controller
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


    public function index($studentId)
    {
        // Authorize the tokans
        if (!(Auth::user()->user_type == 'student' && Auth::user()->id == $studentId)) {
            return response()->json(array('error' => 'Access-Denied'), 200);
        }
        //
        return $this->successResponse($this->StudentService->getStudents($studentId));
    }
    public function create(Request $request)
    {
        // Authorize the tokans
        if (!(Auth::user()->user_type == 'student' && Auth::user()->id == $request->student_id)) {
            return response()->json(array('error' => 'Access-Denied'), 200);
        }
        // storing File
        $input = $request->all();
        $validator = Validator::make($input, [
            'student_id' => 'required',
            'image' => 'required|max:20000|mimes:jpg,png,jpeg',
            'address' => 'required',
            'current_school' => 'required',
            'previous_school' => 'required',
            'parents_details' => 'required'
        ]);
        if (!$validator->fails()) {
            if ($files = $request->file('image')) {
                $timestamp = "ST_PROFILE_PIC" . time() . rand(1, 10000);
                $name = $timestamp . $files->getClientOriginalName();
                $files->move('StudentsImages', $name);
                // $path=Storage::move('StudentsImages',$name);
                $path = Url('/') . "/StudentsImages/" . $name;
                //return response()->json(array('data' => $data, 'success' => 'success'), 200);
                // send to micro services
                $request->offsetSet('profile_picture', $path);
                $user = [
                    "name" => "Sam",
                    "email" => "email@gmail.com"
                ];
                event(new SendMailNotification($user));
                return $this->successResponse($this->StudentService->createstudent($request->all(), Response::HTTP_CREATED));
            }
        } else {
            return response()->json(array('error' => $validator->errors()->all()), 201);
        }
        // Storinf file

    }
    public function update(Request $request, $studentId)
    {

        // Authorize the tokans
        if (!(Auth::user()->user_type == 'student' && Auth::user()->id == $studentId)) {
            return response()->json(array('error' => 'Access-Denied'), 200);
        }
        // Validate current req
        $input = $request->all();
        // print_r($request->all());
        // die();
        $validator = Validator::make($input, [
            'image' => 'max:20000|mimes:jpg,png,jpeg',
            'address' => 'required',
            'current_school' => 'required',
            'previous_school' => 'required',
            'parents_details' => 'required'
        ]);
        // store image here
        if (!$validator->fails()) {
            if ($files = $request->file('image')) {
                $timestamp = "ST_PROFILE_PIC" . time() . rand(1, 10000);
                $name = $timestamp . $files->getClientOriginalName();
                $files->move('StudentsImages', $name);
                // $path=Storage::move('StudentsImages',$name);
                $path = Url('/') . "/StudentsImages/" . $name;
                //return response()->json(array('data' => $data, 'success' => 'success'), 200);
                // send to micro services
                $request->offsetSet('profile_picture', $path);
                $user = [
                    "name" => "Sam",
                    "email" => "email@gmail.com",
                    "action" => "Details Updated Successfuly"
                ];
                event(new SendMailNotification($user));
                $request->offsetSet('student_id', $studentId);
                $request->offsetSet('profile_picture', $path);

                return $this->successResponse($this->StudentService->updatestudent($request->all(), Response::HTTP_CREATED));
            } else {
                $request->offsetSet('student_id', $studentId);
                return $this->successResponse($this->StudentService->updatestudent($request->all(), Response::HTTP_CREATED));
            }
        } else {
            return response()->json(array('error' => $validator->errors()->all()), 201);
        }
    }
    public function delete($studentId)
    {
        // Authorize the tokans
        if (!(Auth::user()->user_type == 'student' && Auth::user()->id == $studentId)) {
            return response()->json(array('error' => 'Access-Denied'), 200);
        }
        return $this->successResponse($this->StudentService->deletestudent($studentId, Response::HTTP_CREATED));
    }
}
