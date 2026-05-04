<?php

namespace App\Http\Controllers;

use App\Models\loginmail;

use App\Models\blog;
use Illuminate\Http\Request;
use App\Models\usertoken;
use App\Models\login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class usertokencontroller extends Controller
{

    function register(Request $request)
    {


        $request->validate([
            'name' => 'required',
            'email'    => 'required|email',
            'password' => 'required',
        ]);


        $user = login::where('email', $request->email)->first();

        if ($user) {

            if (!Hash::check($request->password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'msg' => 'User not registered'
                ]);
            }
        } else {
            $user = login::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => bcrypt($request->password),
            ]);
        }

        $token = $user->createToken('mytoken')->plainTextToken;

        return response()->json([
            'success' => true,
            'token' => $token,
            'msg' => 'User registered successfully',
            'user' => $user
        ]);
    }

    function bloglist(Request $request)
    {
        $data = blog::all();
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
    function addblog(Request $request)
    {

        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string'
        ]);


        $data = blog::create(
            [
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => $request->user()->id

            ]
        );
        //token = $data->createToken('mytoken')->plainTextToken;

        if ($data) {
            return response()->json([
                'success' => true,
                'data' => $data,
                'msg' => 'Data Added'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'msg' => 'Data not added'
            ]);
        }
    }

    function deleteblog(Request $request, $id)
    {
        $data = blog::find($id);

        if ($data) {
            $data->delete();
            return response()->json([
                'success' => true,
                'data' => 'Data Deleted'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'messsage' => "Data not deleted"
            ]);
        }
    }

    function updateblog(Request $request, $id)
    {
        $data = blog::find($id);
        $data->title = $request->title;
        $data->description = $request->description;
        $data->save();
        if ($data) {
            return response()->json([
                'success' => true,
                'data' => $data,
                'msg' => 'Data Updated'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'msg' => 'Data not updated'
            ]);
        }
    }
    public function search(Request $request)
    {
        $search = $request->search;

        $data = blog::where('title', 'like', '%' . $search . '%')->get();


        if (!$data->isEmpty()) {
            return response()->json([
                "success" => true,
                "data" => $data
            ]);
        } else {
            return response()->json([
                "success" => false,
                'msg' => 'No such Data'
            ]);
        }
    }
}

// function search(Request $request)
//     {
//         $data = blog::where('title', 'like', "%$request->search%")->get();
//         return response()->json([
//             "success"=> true,
//             "data"=> $data
//             ]);
//     }
        // function editblog(Request $request, $id)
        // {
        //     $data = blog::find($id);
        //     $data->title = $request->title;
        //     $data->description = $request->description;
        //     return response()->json([
        //         'success' => true,
        //         'data' => $data
        //     ]);
        // }
        // function updateblog(Request $request, $id)
        // {
        //     $data = blog::find($id);
        //     $data->title = $request->title;
        //     $data->description = $request->description;
        //     $data->save();
        //     return response()->json([
        //         'success' => true,
        //         'data' => $data
        //     ]);
        // }
        // function loginapi(Request $request)
        // {
        //     $input = $request->all();

        //     $input['password'] = Hash::make($input['password']);
        //     $user = login::create($input);
        //     $success['token'] = $user->createToken('mytoken')->plainTextToken;
        //     $user['name'] = $user->name;

        //     return ['success' => true, "result" => $success, "msg" => "user Login"];
        // }
