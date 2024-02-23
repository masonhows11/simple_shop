<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function home()
    {
        auth()->user()->givePermissionsTo('delete_post','delete_user');
        return view('home');
    }
}
