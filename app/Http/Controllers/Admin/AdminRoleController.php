<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminRoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', ['roles' => $roles]);
    }


    public function store(CreateRoleRequest $request)
    {
        try {

            Role::create([
                'name' => $request->name,
                'persian_name' => $request->persian_name
            ]);
            $roles = Role::all();
            session()->flash('success', __('messages.New_record_saved_successfully'));
            return redirect()->route('admin.roles.index')->with(['roles' => $roles]);
        } catch (\Exception $ex) {
            abort(500);
        }
    }



    public function edit(Role $role,Request $request)
    {

        $permissions = Permission::all();
        $role->load('permissions');
        return view('admin.roles.edit',['role' => $role ,'perms' => $permissions]);
    }

    public function update(Request $request)
    {

    }


    public function destroy(Request $request)
    {

    }
}
