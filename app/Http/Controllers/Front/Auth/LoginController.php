<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('guest')->except('logOut');
    }

    public function loginForm()
    {
        return view('auth_front.login');
    }


    public function login(LoginUserRequest $request)
    {
        try {

            if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']], $request->filled('remember'))) {
                $request->session()->regenerate();

                return redirect()->intended('/');
            }
            session()->flash('success', __('messages.your_login_was_successful'));
            return redirect()->route('home');
        } catch (\Exception $ex) {

            session()->flash('success', __('messages.An_error_occurred'));
            return redirect()->route('home');
        }
    }


    public function logOut(Request $request)
    {
        $user = User::find($request->user()->id);
        Auth::logout();
        $user->token = null;
        $user->token_guid = null;
        $user->auth_type = 1;
        $user->mobile_verified_at = null;
        $user->email_verified_at = null;
        $user->remember_token = null;
        $user->activate = 0;
        $user->save();
        $request->session()->invalidate();
        return redirect()->route('home');
    }
}
