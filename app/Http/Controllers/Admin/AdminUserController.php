<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.users',['users' => $users]);
    }


    public function edit(User $user)
    {
        $perms = Permission::all();
        $roles = Role::all();
        $user->load('roles','permissions');
        return view('admin.user_edit',['user' => $user ,'perms' => $perms , 'roles' => $roles]);
    }


    public function update(Request $request){
       // dd($request);

        $user = User::find($request->user);
        $user->refreshPermissions($request->perms);
        $user->refreshRoles($request->roles);

        session()->flash('success',__('messages.The_update_was_completed_successfully'));
        return redirect()->back();
    }
}
