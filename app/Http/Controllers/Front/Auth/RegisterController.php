<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //

    public function registerForm()
    {
        return view('auth_front.register');
    }


    public function register()
    {

    }
}
