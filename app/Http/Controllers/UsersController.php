<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use test\Mockery\Fixtures\EmptyTestCaseV5;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::get();
        $permissions = Permission::all();
        return view('users.create', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:120',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);
        $newUser = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];
        $newUserObject = User::create($newUser);
        $roles = $request['roles'];
        $permissions = $request['permissions'];
        if (!empty($request['roles'])) {
            foreach ($roles as $role) {
                $rolee = Role::where('id', '=', $role)->first();
                $newUserObject->assignRole($rolee);
            }
        }
        if (!empty($request['permissions'])) {
            foreach ($permissions as $permission) {
                $permiss = Permission:: where('id', '=', $permission)->first();
                $newUserObject->givePermissionTo($permiss);
            }
        }
        return redirect()->route('user.list')->with('msg', 'User successfully created.');
    }

    public function edit($user_id)
    {
        $user = User::find($user_id);
        $userRoles = $user->roles()->pluck('name')->toArray();
        $roles = Role::get();
        $permissions = Permission::all();
        $userPermissions = $user->permissions()->pluck('name')->toArray();
        return view('users.edit', compact('user', 'roles', 'userRoles', 'permissions', 'userPermissions'));
    }

    public function update(Request $request, $user_id)
    {
        $this->validate($request, [
            'name' => 'required|max:120',
            'email' => 'required|email'
        ]);
        $editUser = [
            'name' => $request->input('name'),
            'email' => $request->input('email')
        ];
        $user = User::find($user_id);
        $user->update($editUser);
        $roles = $request['roles'];
        $permissions = $request['permissions'];
        $user->syncRoles($roles);
        $user->syncPermissions($permissions);
        return redirect()->route('user.list')->with('msg', 'user successfully updated!');
    }

    public function destroy($user_id)
    {
        $user = User::find($user_id);
        $user->delete();
        return redirect()->route('user.list')->with('msg', 'User successfully deleted!');
    }
}
