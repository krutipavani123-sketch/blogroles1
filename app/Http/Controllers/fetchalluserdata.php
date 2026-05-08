<?php

namespace App\Http\Controllers;

use  App\Models\blog;
use Illuminate\Http\Request;

class fetchalluserdata extends Controller
{
    function datalist()
    {
        $data = blog::paginate(5);
        return view("fetchalluserdata", ["data" => $data]);
    }
}
