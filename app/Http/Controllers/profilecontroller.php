<?php

namespace App\Http\Controllers;

use App\Models\login;
use App\Models\blog;

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

        $data = login::where('id', $user->id)->get();

        return view('profile', compact('user', 'data'));
    }
}
