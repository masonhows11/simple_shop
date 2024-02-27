<?php

namespace App\Http\Controllers\Front;

use App\Exceptions\QuantityExceededException;
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
        //// below line said only users can access checkOutForm method or route
        /// that already logged in else they cannot access
        $this->middleware('auth')->only(['checkOutForm']);
        $this->basket = $basket;
    }

    public function add(Product $product)
    {
        try {
            $this->basket->addToBasket($product,1);
            session()->flash('success',__('messages.the_product_has_been_added_to_the_cart'));
            return redirect()->back();
        }catch (QuantityExceededException $ex){

            return back()->with('error',__('messages.product_out_of_stock_as_u_requested'));
        }

    }

    public function cart(Request $request)
    {
        $products = $this->basket->all();
        return view('front.cart.cart',['products' => $products]);
    }


    public function update(Request $request,Product $product)
    {
        // dd($product);
        //// update the quantity product
        $this->basket->update($product,$request->stock);
        session()->flash('success',__('messages.The_update_was_completed_successfully'));
        return redirect()->back();
    }


    public function checkOutForm(Request $request)
    {

        return view('front.payment.check_out');
    }
}
