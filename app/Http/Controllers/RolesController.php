<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{

    public function index()
    {
        $roles = Role::all();
        return view('roles.list',compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::get();
        return view('roles.create',compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|unique:roles'
        ]);
        $name = $request['name'];
        $newRoleObject = Role::create(['name'=>$name]);
        $permissions = $request['permissions'];
        if(!empty($request['permissions'])) {
            foreach ($permissions as $permission) {
                $permiss = Permission::where('id', '=', $permission)->first();
                $role = Role::where('name', '=', $name)->first();
                $role->givePermissionTo($permiss);
            }
        }
        return redirect()->route('role.list')->with('msg','Role '.$newRoleObject->name.' created!');
    }

    public function edit($role_id)
    {
        $role = Role::find($role_id);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions()->pluck('name')->toArray();
        return view('roles.edit',compact('role','permissions','rolePermissions'));
    }

    public function update(Request $request, $role_id)
    {
//        dd($request['permissions']);
        $this->validate($request,[
            'name'=>'required|max:10'
        ]);
        $role = Role::find($role_id);
        $input = $request->except(['permissions']);
        $role->update($input);
        $permissions = $request['permissions'];
        $permissionAll = Permission::all();
        if(!empty($request['permissions'])) {
            foreach ($permissionAll as $per) {
                $role->revokePermissionTo($per);
            }
            foreach ($permissions as $permission) {
                $perm = Permission::where('id', '=', $permission)->first();
                $role->givePermissionTo($perm);
            }
        }
        return redirect()->route('role.list')->with('msg','Role '.$role->name.' Updated!');
    }

    public function destroy($role_id)
    {
        $role = Role::find($role_id);
        $role->delete();
        return redirect()->route('role.list')->with('msg','Role successfully deleted!');
    }
}
