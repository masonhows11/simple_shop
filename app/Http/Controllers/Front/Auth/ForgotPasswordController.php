<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

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

        $result = Password::broker()->sendResetLink($request->only('email'));
        if ($result == Password::RESET_LINK_SENT) {
            session()->flash('success',__('messages.reset_link_password_sent_successfully'));
            return redirect()->back();
        }
        session()->flash('error',__('messages.An_error_occurred'));
        return redirect()->back();

    }


    public function showResetPasswordForm(Request $request)
    {

        return view('auth_front.password.reset_password');
    }


}
