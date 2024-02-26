<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\Storage\Contracts\StorageInterface;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    //
    public function index()
    {

        $sessionStorage = resolve(StorageInterface::class);
        $sessionStorage->set('product',4);
        $sessionStorage->set('product2',5);
        $sessionStorage->set('product3',12);
        dd($sessionStorage->all());
        // dd($sessionStorage->get('product'));


        $products = Product::all();
        return view('front.products.products',['products' => $products]);
    }
}
