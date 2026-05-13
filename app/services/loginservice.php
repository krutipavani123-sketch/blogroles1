<?php


namespace App\Services;

use App\Mail\loginmail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class loginservice
{
    public function createuser(array $data)
    {
        $user = User::where('email', $data['email'])->first();
        if ($user) {
            if (!Hash::check($data['password'], $user->password)) {
                throw new \Exception('Invalid Password');
            }
            $user->load('roles', 'permissions');
            Mail::to($data['email'])->queue(new loginmail('You are Login', 'You are Login in Blog Management System'));
            return $user;
        }
        $newuser = User::create([
            'name' => $data['name'] ?? 'user',
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        if ($newuser->id == 1) {
            $newuser->assignRole('admin');
        } else {
            $newuser->assignRole('user');
        }
        return $newuser;
    }
}

?>

// namespace App\Services;

// use App\Models\User;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
// use App\Mail\loginmail;
// use Illuminate\Support\Facades\Mail;

// class loginservice
// {
// public function createuser(array $data)
// {
// $user = User::where('email', $data['email'])->first();


// if ($user) {

// if (Hash::check($data['password'], $user->password)) {
// throw new \Exception('Invalid password');
// }

// $user->load('roles', 'permissions');

// Mail::to($data['email'])->queue(
// new loginmail("You are Login", "You are login in blog management system")
// );

// return $user;
// }
// $newuser = User::create([
// 'name' => $data['name'] ?? 'User',
// 'email' => $data['email'],
// 'password' => bcrypt($data['password']),
// ]);

// if ($newuser->id == 1) {
// $newuser->assignRole('admin');
// } else {
// $newuser->assignRole('user');
// }
// return $newuser;
// }
// }