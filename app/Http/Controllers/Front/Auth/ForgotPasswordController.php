<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    //

    public function __construct()
    {
        // only users as guest type can access to this
        // controller or route
        $this->middleware('guest');
    }

    public function resetPasswordForm()
    {
        return view('auth_front.password.forgot_password');
    }

    public function sendResetPassword(ResetPasswordRequest $request)
    {
        dd($request->all());
    }


}
