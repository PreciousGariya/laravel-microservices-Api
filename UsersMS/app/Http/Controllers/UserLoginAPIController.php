<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserLoginAPIController extends Controller
{
    //

    public function user(Request $request){
       dd($request->all());
    }
}
