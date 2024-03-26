<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Notifications\AdminLoginNotification;
use App\Services\GenerateToken;
use App\Http\Requests\Admin\AdminRegisterRequest;

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


        try {
            $token = GenerateToken::generateToken();
            $admin = Admin::create([
                'name' => $request->name,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'token' => $token,
            ]);


            session(['admin_mobile' => $admin->mobile]);

            $admin->notify(new AdminLoginNotification($admin));
            $request->session()
                ->flash('success', 'کد فعال سازی به شماره موبایل ارسال شد.');
            return view('auth_admin.validate_token');

        } catch (\Exception $ex) {

            return view('errors_custom.login_error')
                ->with(['error' => $ex->getMessage()]);
        }
    }
}
