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
        dd($sessionStorage);

        $products = Product::all();
        return view('front.products.products',['products' => $products]);
    }
}
