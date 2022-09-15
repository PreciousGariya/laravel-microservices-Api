<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{


     public function Login(Request $request){
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $response_array = [];
            $response_array['token'] = $user->createToken('lpad')->accessToken;
            $response_array['id'] = $user->id;
            $response_array['name'] = $user->name;
            $response_array['user_type'] = $user->user_type;
            $response_array['success'] = 'successfully Logged In';

            return response()->json($response_array, 200);
        } else {
            return response()->json(array('error' => 'Unauthenticated'), 203);
        }
}

public function profile()
    {
        $user = Auth::guard('api')->user();
        if($user){
            return response()->json(array('data'=>$user), 200);
        }else{
            return response()->json(array('error'=>'Unauthorize'), 201);
        }
    }
}
