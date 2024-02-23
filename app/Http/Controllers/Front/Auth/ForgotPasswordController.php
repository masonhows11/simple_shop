<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function forgotPasswordForm()
    {
        return view('auth_front.password.forgot_password');
    }

    public function sendRecoverPasswordLink(Request $request)
    {
        dd($request);
    }


}
