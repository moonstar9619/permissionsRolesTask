<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('users.index',compact('users'));
    }

    public function create()
    {
        $roles = Role::get();
        return view('users.create',compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
           'name'=>'required|max:120',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|confirmed'
        ]);
        $newUser = [
          'name' =>$request->input('name'),
            'email'=>$request->input('email'),
            'password'=>$request->input('password')
        ];
        $newUserObject = User::create($newUser);
        $roles = $request['roles'];
        if (isset($roles)){
            foreach ($roles as $role){
                $rolee = Role::where('id','=',$role)->first();
                $newUserObject->assignRole($rolee);
            }
        }
        return redirect()->route('user.list')->with('msg','User successfully created.');
    }

    public function edit($user_id)
    {
        $user = User::find($user_id);
        $userRoles = $user->roles()->pluck('name')->toArray();
        $roles = Role::get();
        return view('users.edit',compact('user','roles','userRoles'));
    }

    public function update(Request $request, $user_id)
    {
        $this->validate($request,[
            'name'=>'required|max:120',
            'email'=>'required|email|unique:users,email'
        ]);
        $editUser =[
            'name'=>$request->input('name'),
            'email'=>$request->input('email')
        ];
        $user = User::find($user_id);
        $user->update($editUser);
        return redirect()->route('post.list')->with('msg','user successfully updated!');
    }

    public function destroy($user_id)
    {
        $user = User::find($user_id);
        $user->delete();
        return redirect()->route('user.list')->with('msg','User successfully deleted!');
    }
}
