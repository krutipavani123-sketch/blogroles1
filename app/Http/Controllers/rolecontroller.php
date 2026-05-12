<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Auth;

class rolecontroller extends Controller
{
    public function create()
    {
        $permissions = Permission::all();
        return view("roles.create", compact("permissions"));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => 'required|unique:roles|min:3'
        ]);

        if ($validator->fails()) {
            return redirect()->route('roles.create')
                ->withErrors($validator)
                ->withInput();
        }

        $role = Role::create([
            'name' => $request->name
        ]);

        $role->syncPermissions($request->permission ?? []); //remove old permission and new permission when change the permission

        app()[\Spatie\Permission\PermissionRegistrar::class]
            ->forgetCachedPermissions();

        return redirect()->route('roles.list')->with('success', 'Role Added');
    }


    public function list(Request $request)
    {
        $query = Role::query();

        if (!empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $roles = $query->get();

        return view('roles.list', compact('roles'));
    }


    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $hasPermissions = $role->permissions->pluck('name');
        $permissions = Permission::all();
        return view('roles.edit', compact('permissions', 'hasPermissions', 'role'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,' . $id . ',id'
        ]);

        if ($validator->fails()) {
            return redirect()->route('roles.edit', $id)
                ->withInput()
                ->withErrors($validator);
        }

        $role->update([
            'name' => $request->name
        ]);

        $role->syncPermissions($request->permission ?? []);

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return redirect()->route('roles.list')->with('success', 'Updated');
    }
    public function delete($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        app()[\Spatie\Permission\PermissionRegistrar::class]
            ->forgetCachedPermissions();

        return redirect()->route('roles.list')->with('success', 'Deleted');
    }
}










//  public function delete($id)
//     {
//         $role = Role::findOrFail($id);
//         $role->delete();
//         if ($role) {

//             app()[\Spatie\Permission\PermissionRegistrar::class]
//                 ->forgetCachedPermissions();

//             return redirect()->route('roles.list')->with('success', 'Deleted');
//         } else {
//             return redirect()->route('roles.list')->with('Error', 'Not Deleted');
//         }
//     }

//  public function update(Request $request, $id)
//     {
//         $role = Role::findOrFail($id);
//         $validator = Validator::make($request->all(), [
//             'name' => 'required|unique:roles,name,' . $id . ',id'
//         ]);

//         if ($validator->passes()) {
//             $role->name = $request->name;
//             $role->save();

//             if (!empty($request->permission)) {
//                 $role->syncPermissions($request->permission ?? []);
//                 app()[\Spatie\Permission\PermissionRegistrar::class]
//                     ->forgetCachedPermissions();
//             } else {
//                 $role->syncPermissions([]);
//             }
//             return redirect()->route('roles.list')->with('success', 'Updated');
//         } else {
//             return redirect()->route('roles.edit', $id)->withInput()->withErrors($validator);
//         }
//     }










    // public function list(Request $request)
    // {

    //     $roles = Role::paginate(3);

    //     if (!empty($request->search)) {
    //         $data = $roles->where('name', 'like', "%$request->search%");
    //     }
    //     return view('roles.list', compact('roles'));
    //     // return view("roles.list");
    // }



    //  public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         "name" => 'required|unique:roles|min:3'
    //     ]);

    //     if ($validator->passes()) {
    //         $role = Role::create([
    //             'name' => $request->name
    //         ]);

    //         if (!empty($request->permission)) {
    //             $role->syncPermissions($request->permission ?? []);
    //             app()[\Spatie\Permission\PermissionRegistrar::class]
    //                 ->forgetCachedPermissions();
    //         } else {
    //             $role->syncPermissions([]);
    //         }


    //         return redirect()->route('roles.list')->with('success', 'Role Added');
    //     } else {
    //         return redirect()->route('roles.create')->with('error', 'Role Not Added');
    //     }
    // }