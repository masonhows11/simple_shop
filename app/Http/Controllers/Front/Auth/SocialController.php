<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // so register new user into our web site
        // then login registered user
        $user = Socialite::driver($driver)->user();
        Auth::login($this->findOrCreateUser($user,$driver));
        session()->flash('success', __('messages.your_login_was_successful'));
        return redirect()->route('home');

    }


    protected function findOrCreateUser($user, $driver)
    {

        $providerUser = User::where
        (['email' => $user->getEmail()])->first();
        // if  incoming user is exists then return it
        if(!is_null($providerUser)) return $providerUser;
        // else create new user
        return User::create([
            'email' => $user->getEmail(),
            'name' => $user->getName(),
            'provider' => $driver,
            'provider_id' => $user->getId(),
            'avatar' => $user->getAvatar(),
            'email_verified_at' => now()
        ]);


    }
}
