<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class imgcontroller extends Controller
{
    function img(Request $request)
    {
        $path = $request->file('image')->store('images', 'public');
        // $filename = explode('/', $path);
        // $file = $filename[1];
        return view('display', compact('path')); // create array
    }
}
