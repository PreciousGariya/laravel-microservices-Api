<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\StudentDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isNull;

class StudentDetailsController extends Controller
{
    //
    public function index($studentId)
    {

        // $check=StudentDetails::where('student_id',$studentId)->all();
        $check = DB::table('students_details')->where('student_id', $studentId)->first();
        //dd($check);
        if ($check == null) {
            return response()->json(array('data' => '', 'message' => 'error-No Record Found'), 200);
        } else {
            return response()->json(array('data' => $check, 'message' => 'success'), 200);
        }
        // return response()->json(array('data' => $check, 'message' => 'success'), 200);


    }
    public function create(Request $request)
    {
        $data = new StudentDetails;
        $input = $request->all();
        $validator = Validator::make($input, [
            'student_id' => 'required',
            'profile_picture' => 'required',
            'address' => 'required',
            'current_school' => 'required',
            'previous_school' => 'required',
            'parents_details' => 'required'
        ]);
        if (!$validator->fails()) {
            $data->profile_picture = $request->profile_picture;
            $data->student_id = $request->student_id;
            $data->address = $request->address;
            $data->current_school = $request->current_school;
            $data->previous_school = $request->previous_school;
            $data->parents_details = $request->parents_details;
            try {
                $store = $data->save();
                // Closures include ->first(), ->get(), ->pluck(), etc.
            } catch (\Illuminate\Database\QueryException $ex) {
                //dd($ex->getMessage());
                return response()->json(array('error' => $ex->getMessage()), 502);
                // Note any method of class PDOException can be called on $ex.
            }
            if ($store) {
                return response()->json(array('success' => 'Student Details Addedd Successfully'), 200);
            }
        } else {
            return response()->json(array('error' => $validator->errors()->all()), 201);
        }
    }

    public function Update(Request $request)
    {
        //dd($student_id);
        $input = $request->all();
        $validator = Validator::make($input, [
            'student_id' => 'required|exists:students_details,student_id',
            'address' => 'required',
            'current_school' => 'required',
            'previous_school' => 'required',
            'parents_details' => 'required'
        ]);
        if (!$validator->fails()) {
            if (!$request->profile_picture) {
                // without image
                $affected = DB::table('students_details')
                    ->where('student_id', $request->student_id)
                    ->update([
                        'address' => $request->address,
                        'current_school' => $request->current_school,
                        'previous_school' => $request->previous_school,
                        'parents_details' => $request->parents_details,
                    ]);
                // Notify
                return response()->json(array('success' => 'Details updated Successfully Excluding Image'), 200);
            } else {
                // with image
                $affected = DB::table('students_details')
                    ->where('student_id', $request->student_id)
                    ->update([
                        'address' => $request->address,
                        'profile_picture' => $request->profile_picture,
                        'current_school' => $request->current_school,
                        'previous_school' => $request->previous_school,
                        'parents_details' => $request->parents_details,
                    ]);
                return response()->json(array('success' => 'Details updated Successfully Including Image'), 200);
            }
        } else {
            return response()->json(array('error' => $validator->errors()->all()), 201);
        }
    }


    public function delete($studentId)
    {
        $user = StudentDetails::where('student_id', $studentId);
        if ($user->first()) {
            if ($user->delete()) {
                return response()->json(array('Message' => 'Deleted Successfully'), 200);
            } else {
                return response()->json(array('Message' => 'error'), 200);
            }
        } else {
            return response()->json(array('Message' => 'Not Found'), 200);
        }
    }

    public function asignTeacher(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'student_id' => 'required|exists:students_details,student_id',
            'teachers_id'=>'required'
        ]);
        if (!$validator->fails()) {
            $affected = DB::table('students_details')
                ->where('student_id', $request->student_id)
                ->update([
                    'asigned_teacher' => $request->teachers_id,
                ]);
            // Notify
            return response()->json(array('success' => 'Teacher Asigned Successfully'), 200);
        } else {
            return response()->json(array('error' => $validator->errors()->all()), 201);
        }
    }
}
