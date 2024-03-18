<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{


    public function index()
    {
        $orders = auth()->user()->orders;
        return view('front.orders.orders', ['orders' => $orders]);
    }
}
