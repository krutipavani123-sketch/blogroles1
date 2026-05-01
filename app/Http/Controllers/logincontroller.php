<?php

namespace App\Http\Controllers;

use App\Models\login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\loginmail;
use App\Models\blog;

class logincontroller extends Controller
{


    public function login(Request $request)
    {

        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        login::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user = login::where('email', $request->email)->first();


        if ($user && Hash::check($request->password, $user->password)) {


            Auth::login($user);


            $request->session()->regenerate();

            Mail::to($request->email)->send(new loginmail("You are Login", "You are login in blog management system"));
            return redirect('welcome')->with('error', 'Invalid email or password');
        } else {
            return redirect('login')->with('error', 'Invalid email or password');
        }
    }
}
