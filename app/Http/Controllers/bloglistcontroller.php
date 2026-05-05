<?php

namespace App\Http\Controllers;

use App\Models\image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\blog;
use Faker\Guesser\Name;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use File;
use Illuminate\Support\Facades\Validator;

class bloglistcontroller extends Controller
{

    function bloglist(Request $request)
    {
        $request->validate([

            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image'
        ]);
        $path = $request->file('image')->store('images', 'public');
        $data = new blog;
        $data->isfeatured = $request->has('isfeatured') ? 1 : 0;
        $data->title = $request->title;
        $data->description = $request->description;
        $data->image = $path;
        $data->login_id = auth()->id();
        $data->save();

        if ($data) {

            return redirect('welcome')->with('success', 'Blog added successfully!');
        } else {
            return "Something went wrong";
        }
    }

    function list()
    {
        $data = Blog::where('login_id', auth()->id())->paginate(10);
        return view("bloglist", ["data" => $data]);
    }

    function delete($id)
    {
        $data = blog::find($id);

        if ($data->image) {
            Storage::disk('public')->delete($data->image);
        }
        $data->delete();

        return redirect("list")->with("success", "Data Deleted");
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
        $data->isfeatured = $request->has('isfeatured') ? 1 : 0;
        if ($request->hasFile('image')) {
            if ($data->image) {
                storage::disk('public')->delete($data->image);
            }
            $path = $request->file('image')->store('images', 'public');
            $data->image = $path;
        }
        $data->save();
        return redirect('list');
    }


    function search(Request $request)
    {
        $search = $request->search;

        $data = blog::where(function ($query) use ($search) {
            $query->where('title', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%");
        })->paginate(10);

        return view("bloglist", [
            "data" => $data,
            "search" => $search
        ]);
    }

    public function listJson(Request $request)
    {

        //        $path = $request->file('image')->store('images', 'public');

        $validator = Validator::make($request->all(), [
            "offset" => 'required|string',
            'limit' => 'string',
        ]);
        $data = DB::table('blogs')
            ->join('logins', 'blogs.login_id', '=', 'logins.id')
            ->select('blogs.*', 'logins.name');



        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed']);
        }
        //  $data = blog::limit($request->limit)->offset($request->offset);



        if (!empty($request->search)) {
            $data = $data->where('title', 'like', "%$request->search%")->orwhere('description', 'like', "%$request->search%");
        }


        if (!empty($request->sort) && !empty($request->order)) {
            $data = $data->orderBy($request->sort, $request->order);
        }

        if (!empty($request->is_featured)) {
            $data = $data->where('isFeatured', $request->is_featured);
        }
        $count = $data->count();
        $data = $data->get();



        $response = [
            'total' => $count,
            'rows' => $data
        ];
        return response()->json($response);
    }

    public function viewList()
    {
        return view('bt-table');
    }
}
//         public function getname()
//         {
//             $data = DB::table('blogs')
//                 ->join('logins', 'blogs.login_id', '=', 'logins.id')
//                 ->select('logins.name')
//                 ->get();

//             return $data;
//         }
// }






    // function search(Request $request)
    // {
    //     $data = blog::where('title', 'like', "%$request->search%")->paginate(4);
    //     return view("bloglist", ["data" => $data, 'search' => $request->search]);
    // }
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


  

    //     function bloglist(Request $request)
    // {
    //     try {
    //         $request->validate([
    //             'title' => 'required',
    //             'description' => 'required',
    //             'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         ]);
    //         $image = $request->file('image');
    //         $filename = date('YmdHis') . '_' . $image->getClientOriginalExtension();
    //         $image->move(public_path('upload'), $filename);
    //         $saveurl = 'upload/' . $filename;

    //         image::create([
    //             'title' => $request->title,
    //             'description' => $request->description,
    //             'image' => $saveurl,
    //         ]);
    //         return back()->with([
    //             'status' => 'success',
    //             'message' => 'uploaded successfully',
    //             'alert-type' => 'success'
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'alert-type' => 'error',
    //             'message' => 'failed' . $e->getMessage(),
    //         ], 400);
    //     }
    // }



      // function delete($id)
    // {
    //     $isDeleted = blog::destroy($id);
    //     if ($isDeleted) {
    //         return redirect("list");
    //     } else {
    //         return "Data not Deleted";
    //     }
    // }
