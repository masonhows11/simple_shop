<?php

namespace App\Http\Controllers\Front\Auth;

use App\Events\UserRegisteredEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class RegisterController extends Controller
{
    //

    public function __construct()
    {

        $this->middleware('guest');
    }

    public function registerForm()
    {
        return view('auth_front.register');
    }

    protected function create($data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['password']),
        ]);
    }


    public function register(RegisterUserRequest $request)
    {

        try {
            $newUser = $this->create($request);
            Auth::login($newUser);

            //// send verification email using event & listener
            event(new UserRegisteredEvent($newUser));

            return redirect()->route('verification.notice');

            // Auth::user()->sendEmailVerificationNotification();
            //  session()->flash('success',__('messages.your_registration_was_successful'));
            //  return redirect()->route('home');
        } catch (\Exception $ex) {
            session()->flash('success', __('messages.An_error_occurred'));
            return redirect()->route('home');
        }

    }
}
