<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
class UserRegisterAPIController extends Controller
{
    public function store(Request $request)
    {
    //     $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'confirmed', Rules\Password::defaults()],
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     event(new Registered($user));

    //     Auth::login($user);

    //     return redirect(RouteServiceProvider::HOME);
    // }

    //
    $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|min:6',
            'email' => 'required|email',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6',
            'user_type' => 'required|in:Teacher,Student'
        ]);

        if (!$validator->fails()) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'user_type' => $request->user_type,
            ]);
            // $token = $user->createToken('Laravel Password Grant Client')->accessToken;
            // $response = ['token' => $token,'success' => 'User Registered Successfully'];
            if ($user) {
                $response_array = [];
                $response_array['token'] = $user->createToken('lpad')->accessToken;
                $response_array['name'] = $user->name;
                $response_array['success'] = 'successfully Registered';
                return response()->json($response_array, 200);
            }
        } else {
            return response()->json(array('error' => $validator->errors()->all()), 201);
        }

    }
}
