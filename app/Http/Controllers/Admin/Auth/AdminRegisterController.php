<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Notifications\AdminLoginNotification;
use App\Services\GenerateToken;
use App\Http\Requests\Admin\AdminRegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Http\Request;


class AdminRegisterController extends Controller
{
    //
    public function registerForm()
    {
        return view('auth_admin.register');
    }

    public function register(AdminRegisterRequest $request)
    {
        return $this->create($request->all(), $request);
    }


    private function create(array $data, Request $request)
    {

        try {
            // $token = GenerateToken::generateToken();
            $admin = Admin::create([
                'name' => $data['name'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'password' => Hash::make($data['password']),
                'email' => $data['email'],
                'mobile' => $data['mobile'],
                //'token' => $token,
                'department' => $data['department']
            ]);

            Auth::guard('admin')->login($admin, $request->remember);


            //            session(['admin_mobile' => $admin->mobile]);
            //            $admin->notify(new AdminLoginNotification($admin,$token));
            //            $request->session()
            //                ->flash('success', 'کد فعال سازی به شماره موبایل ارسال شد.');
            //            return view('auth_admin.validate_token');

        } catch (\Exception $ex) {

            return view('errors_custom.login_error')
                ->with(['error' => $ex->getMessage()]);
        }
    }
}
