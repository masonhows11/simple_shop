<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidateEmailController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verifyEmailVerification');
        $this->middleware('throttle:6,1')->only('verifyEmailVerification', 'resendEmailVerification');
    }


    public function emailVerificationNotice()
    {

        return view('auth_front.verify.verify_email_notice');

    }


    public function verifyEmailVerification(Request $request)
    {

        if($request->user()->hasVerifiedEmail()){
            return redirect()->route('home');
        }
        $request->user()->markEmailAsVerified();
        session()->flash('success',__('messages.your_email_has_verified'));
        session()->forget('user_unverified');
        return redirect()->route('home');


    }


    public function resendEmailVerification(Request $request)
    {
        if (Auth::user()->hasVerifiedEmail()) {
            return redirect()->route('home');
        }
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message',__('messages.verification_email_has_sent'));
    }
}
