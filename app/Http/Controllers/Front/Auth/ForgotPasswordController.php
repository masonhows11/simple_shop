<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

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
        return view('auth_front.password.reset_password')
            ->with(['email' => $request->email ,
                    'token' => $request->token]);
    }




    public function resetPassword(NewPasswordRequest $request)
    {
       // dd($request->all());
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

               // event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('auth.login.form')
                ->with('success',__('messages.reset_password_updated_successfully'))
            : back()->withErrors('error',__('messages.An_error_occurred'));
    }





}
