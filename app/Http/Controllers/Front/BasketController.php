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
        $this->basket->addToBasket($product,1);
        session()->flash('success',__('messages.the_product_has_been_added_to_the_cart'));
        return redirect()->back();
    }

    public function cart(Request $request)
    {
        return view('front.cart.cart');
    }
}
