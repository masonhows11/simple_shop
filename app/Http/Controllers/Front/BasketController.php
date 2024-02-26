<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    //

    public function cart(Request $request)
    {
        return view('front.cart.cart');
    }
}
