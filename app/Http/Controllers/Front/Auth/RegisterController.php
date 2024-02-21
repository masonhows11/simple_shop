<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

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

    protected  function create(array  $data)
    {
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'password' => $data['password']
        ]);
    }


    public function register(RegisterUserRequest $request)
    {
        dd($request);
        $this->create((array)$request);
    }
}
