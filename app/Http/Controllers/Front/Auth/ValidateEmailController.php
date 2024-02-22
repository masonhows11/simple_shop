<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidateEmailController extends Controller
{
    //


    public function emailVerificationNotice()
    {

        return view('auth_front.verify.verify_email_notice');

    }


    public function verifyEmailVerification(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect('/');
    }


    public function resendEmailVerification(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }
}
