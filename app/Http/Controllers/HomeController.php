<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function home()
    {
        auth()->user()->givePermissionsTo('add_product');
        return view('home');
    }
}
