<?php

namespace App\Http\Controllers;

use App\Models\blog;
use Faker\Guesser\Name;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class bloglistcontroller extends Controller
{


    function bloglist(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $data = new blog;
        $data->title = $request->title;
        $data->description = $request->description;
        $data->user_id = auth()->id();
        $data->save();

        if ($data) {

            return redirect('welcome')->with('success', 'Blog added successfully!');
        } else {
            return "Something went wrong";
        }
    }


    function list()
    {
        $data = Blog::where('user_id', auth()->id())->paginate(4);
        return view("bloglist", ["data" => $data]);
    }

    function delete($id)
    {
        $isDeleted = blog::destroy($id);
        if ($isDeleted) {
            return redirect("list");
        } else {
            return "Data not Deleted";
        }
    }

    function edit($id)
    {
        $data = blog::find($id);
        return view('edit', ['data' => $data]);
    }

    function update(Request $request, $id)
    {
        $data = blog::find($id);
        $data->title = $request->title;
        $data->description = $request->description;
        if ($data->save()) {
            return redirect('list');
        } else {
            return 'Data Not Updated';
        }
    }

    function search(Request $request)
    {
        $data = blog::where('title', 'like', "%$request->search%")->paginate(4);
        return view("bloglist", ["data" => $data, 'search' => $request->search]);
    }
}


// function list()
//     {
//         if (auth()->check()) {
//             $data = blog::where('user_id', auth()->id())->paginate(5);
//         } else {
//             $data = blog::paginate(5);
//             return view("bloglist", ["data" => $data]);
//         }
//         return view("bloglist", ["data" => $data]);

//         // $data = blogs::all();
//         // return $data;
//     }
    // function list()
    // {
    //     $data = blog::paginate(5);
    //     return view("bloglist", ["data" => $data]);
    //     // $data = blogs::all();
    //     // return $data;
    // }