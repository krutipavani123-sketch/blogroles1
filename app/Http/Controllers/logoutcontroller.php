<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class logoutcontroller extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect("login");
    }
}
