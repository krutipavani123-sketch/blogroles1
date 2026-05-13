<?php

namespace App\Services;

use App\Models\blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class bloglistservice
{
    public function bloglist(Request $request)
    {
        $path = $request->file('image')->store('images', 'public');

        $data = new blog;

        if ($this->canModify($data)) {

            $data->isfeatured = $request->has('isfeatured') ? 1 : 0;
            $data->title = $request->title;
            $data->description = $request->description;
            $data->image = $path;
            $data->user_id = auth()->id();

            $data->save();
            if ($data) {

                return redirect('welcome')->with('success', 'Blog added successfully!');
            } else {
                return "Something went wrong";
            }
        } else {
            return abort(403);
        }
    }


    private function canModify($blog)
    {
        $user = auth()->user();

        return $user && (
            $user->hasRole('admin') ||
            $user->can('update task') ||
            $user->can('delete task') ||
            $user->can('create task')
        );
    }

    public function list()
    {
        $data = blog::all();

        return view("bloglist", ["data" => $data]);
    }

    public function delete($id)
    {
        $data = blog::findOrFail($id);

        if ($this->canModify($data)) {

            if ($data->image) {
                Storage::disk('public')->delete($data->image);
            }

            $data->delete();

            return redirect("list")->with("success", "Data Deleted");
        }

        return abort(403);
    }

    public function edit($id)
    {
        $data = blog::findOrFail($id);

        if ($this->canModify($data)) {
            return view('edit', ['data' => $data]);
        }

        return abort(403);
    }

    public function update(Request $request, $id)
    {
        $data = blog::findOrFail($id);

        if ($this->canModify($data)) {

            $data->title = $request->title;
            $data->description = $request->description;
            $data->isfeatured = $request->has('isfeatured') ? 1 : 0;

            if ($request->hasFile('image')) {

                if ($data->image) {
                    Storage::disk('public')->delete($data->image);
                }

                $path = $request->file('image')->store('images', 'public');

                $data->image = $path;
            }

            $data->save();

            return redirect('list1');
        }

        return abort(403);
    }
}





























// class bloglistservice
// {
// use Queueable;

// public function list($request)
// {
// // CHECK PERMISSION
// if (!$this->canModify()) {
// throw new \Exception('Unauthorized');
// }

// $path = $request->file('image')
// ->store('images', 'public');

// $data1 = new blog();
// // $path = $data->file('image')->store('images,public');
// $data1->isfeatured = $request->has('isfeatured') ? 1 : 0;
// $data1->title = $request->title;
// $data1->description = $request->description;
// $data1->image = $path;
// $data1->user_id = auth()->id();
// $data1->save();

// return $data1;
// }

// // function list()
// // {
// // //$data = blog::paginate(5);
// // $data = blog::all();
// // return view("bloglist", ["data" => $data]);
// // }

// private function canModify($blog)
// {
// $user = auth()->user();

// return $user && (
// $user->hasRole('admin') ||
// $user->can('update task') ||
// $user->can('delete task') ||
// $user->can('create task')
// );
// }
// }

//


function bloglist(Request $request)
{
    $request->validate([

        'title' => 'required',
        'description' => 'required',
        'image' => 'required|image'
    ]);
    $data = new blog;
    if ($this->canModify($data)) {
        $path = $request->file('image')->store('images', 'public');

        $data->isfeatured = $request->has('isfeatured') ? 1 : 0;
        $data->title = $request->title;
        $data->description = $request->description;
        $data->image = $path;
        $data->user_id = auth()->id();
        $data->save();

        if ($data) {

            return redirect('welcome')->with('success', 'Blog added successfully!');
        } else {
            return "Something went wrong";
        }
    } else {
        return abort(403);
    }
}
