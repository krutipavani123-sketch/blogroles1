<?php

namespace App\Http\Controllers;

use App\Models\image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\blog;
use Faker\Guesser\Name;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\exportmail;
use File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Jobs\exporttask;
use App\services\bloglistservice;

class bloglist1controller extends Controller
{
    protected $bloglistservice;
    public function __construct(bloglistservice $bloglistservice)
    {
        $this->bloglistservice = $bloglistservice;
    }
    function bloglist(Request $request)
    {
        $request->validate([

            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image'
        ]);
        try {
            $this->bloglistservice->bloglist($request);
            return back()->with('success', 'Blog Added Successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    public function list()
    {
        return $this->bloglistservice->list();
    }
    public function delete($id)
    {
        return $this->bloglistservice->delete($id);
    }
    public function update(Request $request, $id)
    {
        return $this->bloglistservice->update($request, $id);
    }
    public function edit($id)
    {
        return $this->bloglistservice->edit($id);
    }
}

// function list()
// {
// //$data = blog::paginate(5);
// $data = blog::all();
// return view("bloglist", ["data" => $data]);
// }

// function export(Request $request)
// {

// //push job in queue
// exporttask::dispatch($request->user()->email);
// return redirect("list")->with("success", "email sent");
// }

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

// function delete($id)
// {
// $data = blog::findOrFail($id);

// if ($this->canModify($data)) {


// if ($data->image) {
// Storage::disk('public')->delete($data->image);
// }
// $data->delete();

// return redirect("list")->with("success", "Data Deleted");
// }
// return abort(403, 'unauthorized');
// }

// function edit($id)
// {
// $data = blog::findOrFail($id);
// if ($this->canModify($data)) {
// return view('edit', ['data' => $data]);
// }

// return abort(403);
// }



// function update(Request $request, $id)
// {
// $data = blog::findOrFail($id);
// if ($this->canModify($data)) {
// $data->title = $request->title;
// $data->description = $request->description;
// $data->isfeatured = $request->has('isfeatured') ? 1 : 0;
// if ($request->hasFile('image')) {
// if ($data->image) {
// storage::disk('public')->delete($data->image);
// }
// $path = $request->file('image')->store('images', 'public');
// $data->image = $path;
// }
// $data->save();
// return redirect('list');
// }
// return abort(403);
// }

// public function search(Request $request)
// {
// $search = $request->search;

// $query = Blog::query();

// if ($search) {
// $query->where(function ($q) use ($search) {
// $q->where('title', 'like', "%{$search}%")
// ->orWhere('description', 'like', "%{$search}%");
// });
// }

// $data = $query->get();

// return view('bloglist', compact('data', 'search'));
// }
// }





























// namespace App\Http\Controllers;

// use App\Models\image;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Str;
// use App\Models\blog;
// use Faker\Guesser\Name;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Cache;
// use File;
// use Illuminate\Support\Facades\Validator;

// class bloglist1controller extends Controller
// {

// function bloglist(Request $request)
// {
// $request->validate([

// 'title' => 'required',
// 'description' => 'required',
// 'image' => 'required|image'
// ]);
// $data = new blog;
// if ($this->canModify($data)) {
// $path = $request->file('image')->store('images', 'public');

// $data->isfeatured = $request->has('isfeatured') ? 1 : 0;
// $data->title = $request->title;
// $data->description = $request->description;
// $data->image = $path;
// $data->user_id = auth()->id();
// $data->save();

// if ($data) {

// return redirect('welcome')->with('success', 'Blog added successfully!');
// } else {
// return "Something went wrong";
// }
// } else {
// return abort(403);
// }
// }

// // function list()
// // {
// // $data = blog::paginate(5);
// // return view("bloglist", ["data" => $data]);
// // }

// public function list1()
// {
// $data = Cache::rememberForever('blogs', function () {
// return DB::table('blogs')->get();
// });
// return response()->json($data);

// // $users = blog::orderBy('id', 'desc')->take(4)->get();
// // Cache::put('blog', $users, 4);
// // return $users;

// // $data = Cache::get('blog');
// // return $data;
// // Cache::remember('blog', 120, function () {
// // return blog::get();
// // });
// // echo Cache::set("Item", "Helllo cache");
// // echo Cache::get('Item');
// // echo Cache::set('item', blog::all());
// // dd(Cache::get('item'));
// // Cache::forget('item');
// // return blog::all();

// // Cache::put('item', Blog::all()->toArray());

// // dd(Cache::get('item'));

// // return $data = Cache::rememberForever("bigdata", function () {
// // return blog::all();
// // });
// }


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

// function delete($id)
// {
// $data = blog::findOrFail($id);

// if ($this->canModify($data)) {


// if ($data->image) {
// Storage::disk('public')->delete($data->image);
// }
// $data->delete();

// return redirect("list1")->with("success", "Data Deleted");
// }
// return abort(403, 'unauthorized');
// }

// function edit($id)
// {
// $data = blog::findOrFail($id);
// if ($this->canModify($data)) {
// return view('edit', ['data' => $data]);
// }

// return abort(403);
// }



// function update(Request $request, $id)
// {
// $data = blog::findOrFail($id);
// if ($this->canModify($data)) {
// $data->title = $request->title;
// $data->description = $request->description;
// $data->isfeatured = $request->has('isfeatured') ? 1 : 0;
// if ($request->hasFile('image')) {
// if ($data->image) {
// storage::disk('public')->delete($data->image);
// }
// $path = $request->file('image')->store('images', 'public');
// $data->image = $path;
// }
// $data->save();
// return redirect('list1');
// }
// return abort(403);
// }

// public function search(Request $request)
// {
// $search = $request->search;

// $query = Blog::query();

// if ($search) {
// $query->where(function ($q) use ($search) {
// $q->where('title', 'like', "%{$search}%")
// ->orWhere('description', 'like', "%{$search}%");
// });
// }

// $data = $query->paginate(5);

// return view('bloglist', compact('data', 'search'));
// }
// }


// public function listJson(Request $request)
// {

// // $path = $request->file('image')->store('images', 'public');

// $validator = Validator::make($request->all(), [
// "offset" => 'required|string',
// 'limit' => 'string',
// ]);
// $data = DB::table('blogs')
// ->join('users', 'blogs.login_id', '=', 'users.id')
// ->select('blogs.*', 'users.name');



// if ($validator->fails()) {
// return response()->json(['message' => 'Validation failed']);
// }
// // $data = blog::limit($request->limit)->offset($request->offset);



// if (!empty($request->search)) {
// $data = $data->where('title', 'like', "%$request->search%")->orwhere('description', 'like', "%$request->search%");
// }


// if (!empty($request->sort) && !empty($request->order)) {
// $data = $data->orderBy($request->sort, $request->order);
// }

// if (!empty($request->is_featured)) {
// $data = $data->where('isFeatured', $request->is_featured);
// }
// $count = $data->count();
// $data = $data->get();



// $response = [
// 'total' => $count,
// 'rows' => $data
// ];
// return response()->json($response);
// }

// public function viewList()
// {
// return view('bt-table');
// }
// 
// public function getname()
// {
// $data = DB::table('blogs')
// ->join('logins', 'blogs.login_id', '=', 'logins.id')
// ->select('logins.name')
// ->get();

// return $data;
// }
// 






// function search(Request $request)
// {
// $data = blog::where('title', 'like', "%$request->search%")->paginate(4);
// return view("bloglist", ["data" => $data, 'search' => $request->search]);
// }
// function list()
// {
// if (auth()->check()) {
// $data = blog::where('user_id', auth()->id())->paginate(5);
// } else {
// $data = blog::paginate(5);
// return view("bloglist", ["data" => $data]);
// }
// return view("bloglist", ["data" => $data]);

// // $data = blogs::all();
// // return $data;
// }
// function list()
// {
// $data = blog::paginate(5);
// return view("bloglist", ["data" => $data]);
// // $data = blogs::all();
// // return $data;
// }




// function bloglist(Request $request)
// {
// try {
// $request->validate([
// 'title' => 'required',
// 'description' => 'required',
// 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
// ]);
// $image = $request->file('image');
// $filename = date('YmdHis') . '_' . $image->getClientOriginalExtension();
// $image->move(public_path('upload'), $filename);
// $saveurl = 'upload/' . $filename;

// image::create([
// 'title' => $request->title,
// 'description' => $request->description,
// 'image' => $saveurl,
// ]);
// return back()->with([
// 'status' => 'success',
// 'message' => 'uploaded successfully',
// 'alert-type' => 'success'
// ]);
// } catch (\Exception $e) {
// return response()->json([
// 'alert-type' => 'error',
// 'message' => 'failed' . $e->getMessage(),
// ], 400);
// }
// }



// function delete($id)
// {
// $isDeleted = blog::destroy($id);
// if ($isDeleted) {
// return redirect("list");
// } else {
// return "Data not Deleted";
// }
// }








// function list()
// {
// if (auth()->user()?->hasRole('admin')) {
// $data = blog::paginate(5);
// } else {
// $data = blog::where('user_id', auth()->id())->paginate(5);
// }

// return view("bloglist", ["data" => $data]);
// }
// private function canModify($blog)
// {
// return auth()->check() &&
// (auth()->user()->hasRole('admin') || $blog->user_id == auth()->id());
// }