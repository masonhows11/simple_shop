<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    //
    public function loginSocial($driver)
    {
        // this line redirect new user to google login page
        // and continue login with google account
        // or any social media
        return Socialite::driver($driver)->redirect();
    }

    public function loginSocialCallback($driver)
    {
        // when user click on google account
        // the redirect to our web uri
        // then get user info from google
        $user = Socialite::driver($driver)->user();
        dd($user);
    }
}
