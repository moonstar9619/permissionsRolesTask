<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsController extends Controller
{

    public function index()
    {
        $permissions = Permission::all();
        return view('permissions.list',compact('permissions'));
    }

    public function create()
    {
        $roles = Role::get();
        return view('permissions.create',compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:40',
        ]);
        $name = $request['name'];
        $newPermissionObject = Permission::create(['name'=>$name]);
        $roles = $request['roles'];
        if(!empty($request['roles'])){
            foreach ($roles as $role) {
                $rol = Role::where('id', '=',$role)->first();
                $permission= Permission::where('name', '=', $name)->first();
                $rol->givePermissionTo($permission);
            }
        }
        return redirect()->route('permission.list')->with('msg','Permission '.$newPermissionObject->name.' created!');
    }

    public function edit($permission_id)
    {
        $permission = Permission::find($permission_id);
        return view('permissions.edit', compact('permission'));
    }

    public function update(Request $request, $permission_id)
    {
        $this->validate($request,[
            'name'=>'required|max:40'
        ]);
        $permission = Permission::find($permission_id);
        $input = $request->all();
        $permission->update($input);
        return redirect()->route('permission.list')->with('msg','Permission '.$permission->name.' updated!');
    }

    public function destroy($permission_id)
    {
        $permission = Permission::find($permission_id);
        if($permission->name == "Administer roles & permissions"){
            return redirect()->route('permission.list')->with('msg','Can not delete this Permission!');
        }
        $permission->delete();
        return redirect()->route('permission.list')->with('msg','Permission successfully deleted!');
    }
}
