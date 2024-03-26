<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
// use App\Notifications\AdminLoginNotification;
// use App\Services\GenerateToken;
use App\Http\Requests\Admin\AdminRegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Http\Request;


class AdminRegisterController extends Controller
{



    public function __construct()
    {

    }
    //
    public function registerForm()
    {
        return view('auth_admin.register');
    }

    public function register(AdminRegisterRequest $request)
    {
        $admin = $this->create($request->all(), $request);
       // dd(Auth::guard('admin'));
        Auth::guard('admin')->login($admin, $request->remember);
        session()->flash('success', 'ورود موفقیت آمیز بود.');
        return redirect()->route('admin.index');
    }


    private function create(array $data, Request $request)
    {

        try {
            // $token = GenerateToken::generateToken();
            return $admin = Admin::create([
                'name' => $data['name'],
                'department' => $data['department'],
                'password' => Hash::make($data['password']),
                'email' => $data['email'],
                // 'mobile' => $data['mobile'],
                // 'first_name' => $data['first_name'],
                // 'last_name' => $data['last_name'],
                //'token' => $token,

            ]);

            //            session(['admin_mobile' => $admin->mobile]);
            //            $admin->notify(new AdminLoginNotification($admin,$token));
            //            $request->session()
            //                ->flash('success', 'کد فعال سازی به شماره موبایل ارسال شد.');
            //            return view('auth_admin.validate_token');

        } catch (\Exception $ex) {

            return view('errors_custom.register_error')
                ->with(['error' => $ex->getMessage()]);
        }
    }
}
