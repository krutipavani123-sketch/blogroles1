<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class UserController extends Controller
{
    public function list()
    {
        $users = User::with('roles.permissions')->paginate(10);

        return view('users.list', compact('users'));
    }


    public function create()
    {
        return view('users.create'); // form page
    }

    public function edit($id)
    {
        $users = User::findOrFail($id);
        $roles = Role::all();
        return view('users.edit', compact('users', 'roles'));
    }
    public function update(Request $request, $id)
    {

        $users = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|min:3|unique:users,email,' . $id,
            'role' => 'nullable|array'

        ]);

        if ($validator->passes()) {
            // $permission->update(['name'=> $request->name]);
            $users->name = $request->name;
            $users->email = $request->email;
            $users->save();
            $users->syncRoles($request->role ?? []);
            return redirect()->route('users.list', $id)
                ->with('success', 'Updated');
        } else {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }
    }
}

    // public function store(Request $request)


    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|unique:permissions|min:3',

    //     ]);

    //     if ($validator->passes()) {
    //         Permission::create(['name' => $request->name]);


    //         return redirect('list')->with('success', 'Permission Added');
    //     } else {
    //         return redirect('create')->withInput()->withErrors($validator);
    //     }
    // }


    // public function edit($id)
    // {
    //     $users = User::findOrFail($id);
    //     $roles = Role::all();
    //     return view('users.edit', compact('users', 'roles'));
    // }
    // public function update(Request $request, $id)
    // {

    //     $users = User::findOrFail($id);

    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|min:3|unique:permissions,name,' . $id

    //     ]);

    //     if ($validator->passes()) {
    //         // $permission->update(['name'=> $request->name]);
    //         $users->name = $request->name;
    //         $users->save();
    //         return redirect()->route('users.list', $id)
    //             ->with('success', 'Updated');
    //     } else {
    //         return redirect()->back()
    //             ->withInput()
    //             ->withErrors($validator);
    //     }
    // }
