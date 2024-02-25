<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminRoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index',['roles' => $roles]);
    }


    public function store(Request $request)
    {
        $roles = Role::all();
        return view('admin.roles.index',['roles' => $roles]);
    }

    public function edit(Request $request)
    {

    }

    public function update(Request $request)
    {

    }


    public function destroy(Request $request)
    {

    }
}
