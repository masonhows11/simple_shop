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
        return view('admin.roles.index', ['roles' => $roles]);
    }


    public function store(Request $request)
    {
        try {
            $this->validate($request);
            Role::create([
                'name' => $request->name,
                'persian_name' => $request->persian_name
            ]);
            $roles = Role::all();
            session()->flash('success', __('messages.New_record_saved_successfully'));
            return view('admin.roles.index', ['roles' => $roles]);
        } catch (\Exception $ex) {
            abort(500);
        }
    }

    public function validation($request)
    {
       return  $request->validate([
            'name' => ['required', 'min:1', 'max:100', 'string'],
            'persian_name ' => ['required', 'min:1', 'max:100', 'string'],
        ]);
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
