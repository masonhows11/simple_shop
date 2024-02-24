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
        return view('admin.user_edit',['users' => $user ,'perms' => $perms , 'roles' => $roles]);
    }
}
