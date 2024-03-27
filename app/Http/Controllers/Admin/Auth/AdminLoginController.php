<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;

//use App\Models\Admin;
use App\Http\Requests\Admin\AdminLoginRequest;
use App\Models\Admin;
use App\Models\User;

//use App\Notifications\AdminAuthNotification;
//use App\Notifications\AdminLoginNotification;
//use App\Services\GenerateToken;
use App\Notifications\AdminLoginNotification;
use App\Services\GenerateToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class AdminLoginController extends Controller
{
    public function __construct()
    {

    }

    //

    public function loginForm()
    {
        return view('auth_admin.login');
    }

    public function login(AdminLoginRequest $request)
    {
        try {
            $credentials = $request->validated();

            if (Auth::guard('admin')->attempt($credentials,$request->has('remember'))) {
                $request->session()->regenerate();
                session()->flash('success', __('messages.your_login_was_successful'));
                return redirect()->route('admin.index');
            }
            session()->flash('error',__('messages.your_login_information_is_not_valid'));
            return redirect()->route('admin.login.form');



        //            $token = GenerateToken::generateAdminToken();
        //            $admin = Admin::where('email', $request->email)->first();
        //            $admin->token = $token;
        //            $admin->save();
        //
        //
        //            $admin->notify(new AdminLoginNotification($admin->email,$token));
        //
        //            session()->flash('success', 'کد فعال سازی به ایمیل ارسال شد');
        //            return redirect()->route('admin.validate.email.form');
        } catch (\Exception $ex) {
            return view('errors_custom.login_error', ['error' => $ex->getMessage()]);
        }

    }

    public function logOut(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $admin->token = null;
        $admin->email_verified_at = null;
        $admin->mobile_verified_at = null;
        $admin->remember_token = null;
        $admin->save();
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        return redirect()->route('admin.login.form');
    }

}
