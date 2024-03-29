<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function home()
    {
        $products = Product::all();

        // $test = app()->make('test');
        // echo $test;

        return view('home', ['products' => $products]);
    }

    public function notFound()
    {
        return view('errors_custom.model_not_found');
    }
}
