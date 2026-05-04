<?php

namespace App\Http\Controllers;

use App\Models\login;
use App\Models\User;
use App\Models\blog;

use Illuminate\Http\Request;

class relationcontroller extends Controller
{
    function onelist() //one to one
    {

        return login::find(47)->blogdata;
    }

    function manylist() // one to many
    {
        return login::find(47)->manylist;
    }

    function manytoone() //mant to one
    {
        //return blog::all();
        return blog::with('manytoone')->get();
    }
}
