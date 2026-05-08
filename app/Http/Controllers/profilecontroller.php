<?php

namespace App\Http\Controllers;

use App\Models\login;
use App\Models\blog;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class profilecontroller extends Controller
{

    public function profile()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $data = User::where('id', $user->id)->get();

        return view('profile', compact('user', 'data'));
    }
}
