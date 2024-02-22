<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidateEmailController extends Controller
{
    //


    public function emailVerificationNotice()
    {
        $user = Auth::user();

        return view('auth_front.verify.verify_email_notice');

    }


    public function verifyEmailVerification()
    {

    }


    public function resendEmailVerification()
    {

    }
}
