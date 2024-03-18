<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class OrderController extends Controller
{


    public function index()
    {
        $orders = auth()->user()->orders;
        return view('front.orders.orders', ['orders' => $orders]);
    }
}
