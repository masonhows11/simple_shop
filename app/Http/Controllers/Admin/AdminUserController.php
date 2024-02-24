<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

        return view('admin.user_edit',['users' => $user]);
    }
}
