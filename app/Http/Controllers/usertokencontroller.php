<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\usertoken;
use App\Models\login;

class usertokencontroller extends Controller
{
    function register(Request $request)
    {


        $user = login::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('mytoken')->plainTextToken;

        return response()->json([
            'success' => true,
            'token' => $token,
            'msg' => 'User registered successfully'
        ]);
    }
}
