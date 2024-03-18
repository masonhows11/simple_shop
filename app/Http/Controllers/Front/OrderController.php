<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auht');
    }


    public function index()
    {
       // auth()->user()->orders;
        dd( auth()->user()->orders);
    }
}
