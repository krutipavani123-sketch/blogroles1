<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\services\loginservice;

use Illuminate\Support\Facades\Auth;


class logincontroller extends Controller
{
    protected $loginservice;
    public function __construct(loginservice $loginservice)
    {
        $this->loginservice = $loginservice;
    }

    public function login(Request $request)
    {
        $request->validate([
            "email" => 'required|email',
            'password' => 'required'
        ]);
        try {
            //call service
            $user = $this->loginservice->createuser($request->all());
            Auth::login($user);
            return redirect('welcome')->with('success', 'Login');
        } catch (\Exception $e) {
            return redirect('login')->with('error', $e->getMessage());
        }
    }
}



?>



// namespace App\Http\Controllers;

// use App\Models\login;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Mail;
// use App\Mail\loginmail;
// use App\Models\blog;
// use App\Models\User;
// use App\Services\loginservice;
// use Spatie\Permission\PermissionRegistrar;

// class logincontroller extends Controller
// {
// protected $loginservice;

// public function __construct(loginservice $loginservice)
// {
// $this->loginservice = $loginservice;
// }

// public function login(loginservice $request)
// {
// $request->validate([
// 'email' => 'required|email',
// 'password' => 'required',
// ]);
// try {
// $user = $this->loginservice->createuser($request->all());
// Auth::login($user);
// return redirect('welcome')->with('success', 'Login');
// } catch (\Exception $e) {
// return redirect('login')->with('error', $e->getMessage());
// }
// }
// }


<!-- <?php 

// namespace App\Http\Controllers;

// use App\Models\login;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Mail;
// use App\Mail\loginmail;
// use App\Models\blog;
// use App\Models\User;
// use Spatie\Permission\PermissionRegistrar;

// class logincontroller extends Controller
// {


//     public function login(Request $request)
//     {
//         $request->validate([
//             'email'    => 'required|email',
//             'password' => 'required',
//         ]);

//         $user = User::where('email', $request->email)->first();

//         // 🟢 CASE 1: USER EXISTS → LOGIN ONLY
//         if ($user) {

//             if (Hash::check($request->password, $user->password)) {

//                 Auth::login($user);
//                 $request->session()->regenerate();
//                 $user->load('roles', 'permissions');
//                 // auth()->setUser($user);
//                 // app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();


//                 Mail::to($request->email)->queue(
//                     new loginmail("You are Login", "You are login in blog management system")
//                 );

//                 return redirect('welcome')->with('success', 'Login Successful');
//             }

//             return redirect('login')->with('error', 'Invalid password');
//         }

//         // 🔴 CASE 2: USER NOT EXISTS → CREATE + LOGIN
//         $newuser = User::create([
//             'name'     => $request->name ?? 'User',
//             'email'    => $request->email,
//             'password' => bcrypt($request->password),
//         ]);

//         // role assign
//         if ($newuser->id == 1) {
//             $newuser->assignRole('admin');
//         } else {
//             $newuser->assignRole('user');
//         }

//         Auth::login($newuser);
//         $request->session()->regenerate();


//         return redirect('welcome')->with('success', 'Account created & logged in');
//     }
// }
