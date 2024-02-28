<?php

namespace App\Http\Controllers\Front;

use App\Exceptions\QuantityExceededException;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Services\Basket\Basket;
use App\Services\Payment\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    //
    private $basket;
    private $transaction;

    public function __construct(Basket $basket,Transaction $transaction)
    {
        //// below line said only users can access checkOutForm , pay methods or route
        /// that already logged in else they cannot access
        $this->middleware('auth')->only(['checkOutForm', 'pay']);
        $this->basket = $basket;
        $this->transaction = $transaction;
    }

    public function add(Product $product)
    {
        try {
            $this->basket->addToBasket($product, 1);
            session()->flash('success', __('messages.the_product_has_been_added_to_the_cart'));
            return redirect()->back();
        } catch (QuantityExceededException $ex) {

            return back()->with('error', __('messages.product_out_of_stock_as_u_requested'));
        }

    }

    public function cart(Request $request)
    {
        $products = $this->basket->all();
        return view('front.cart.cart', ['products' => $products]);
    }


    public function update(Request $request, Product $product)
    {
        // dd($product);
        //// update the quantity product
        $this->basket->update($product, $request->stock);
        session()->flash('success', __('messages.The_update_was_completed_successfully'));
        return redirect()->back();
    }


    public function checkOutForm(Request $request)
    {

        $info = Auth::user()->addresses;
        return view('front.payment.check_out')
            ->with(['info' => $info]);
    }


    // validate for final payment input from request
    public function validateForm($request)
    {
        $request->validate([
            'method' => ['required'],
            'gateway' => ['required_if:method,online']
        ],$messages=[
            'method' => 'انتخاب نوع پرداخت را الزامی',
            'gateway' => 'انتخاب نوع درگاه را الزامی',
        ]);
    }

    // for final payment
    public function pay(Request $request)
    {
        // dd($request->all());
        $this->validateForm($request);
    }


}
