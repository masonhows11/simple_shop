<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\Basket\Basket;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    //
    private $basket;

    public function __construct(Basket $basket)
    {
        $this->basket = $basket;
    }

    public function add(Product $product)
    {
        dd($product);
        $this->basket->addToBasket($product,1);
    }

    public function cart(Request $request)
    {
        return view('front.cart.cart');
    }
}
