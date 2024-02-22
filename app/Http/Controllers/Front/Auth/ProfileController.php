<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function profile()
    {
        return view('front_user.profile.profile');
    }
}
