<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\Storage\Contracts\StorageInterface;
use Illuminate\Http\Request;
use function Symfony\Component\Mime\Header\all;

class ProductsController extends Controller
{
    //
    public function index()
    {

        $sessionStorage = resolve(StorageInterface::class);
        // for test
        //        $sessionStorage->set('product', 2);
        //        $sessionStorage->set('product2', 4);
        //        $sessionStorage->set('product4', 6);
        //        $sessionStorage->set('product5', 12);
        //        $sessionStorage->set('product6', 13);
        // dd($sessionStorage->count());
        // $sessionStorage->clearAll();
        // dump(session()->all());
        // dd($sessionStorage->count());
        // dd($sessionStorage->get('product'));


        dump(session()->all());
        $products = Product::all();
        return view('front.products.products', ['products' => $products]);
    }
}
