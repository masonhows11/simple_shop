<?php

namespace App\Http\Controllers\Front;

use App\Exceptions\QuantityExceededException;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Services\Basket\Basket;
use App\Services\PaymentServiceOne\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class BasketController extends Controller
{
    //
    private $basket;
    private $transaction;

    public function __construct(Basket $basket, Transaction $transaction)
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
            session()->flash('success',
                __('messages.the_product_has_been_added_to_the_cart'));
            return redirect()->back();
        } catch (QuantityExceededException $ex) {

            return back()->with('error',
                __('messages.product_out_of_stock_as_u_requested'));
        }

    }

    public function cart(Request $request)
    {
        $products = $this->basket->all();
        return view('front.cart.cart', ['products' => $products]);
    }


    public function update(Request $request, Product $product)
    {

        //// update the quantity product
        $this->basket->update($product, $request->stock);
        session()->flash('success',
            __('messages.The_update_was_completed_successfully'));
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
        ], $messages = [
            'method' => 'انتخاب نوع پرداخت الزامی است',
            'gateway' => 'انتخاب نوع درگاه الزامی است',
        ]);
    }

    // for final payment
    public function pay(Request $request)
    {


        $this->validateForm($request);

        $order = $this->transaction->checkOut();

        session()->flash('success',
            __('messages.your_order_has_been_successfully_register_with_number', ['order_number' => $order->id]));
        return redirect()->route('home');

        // $this->transaction->checkOut();
        //        $order = Order::first();
        //        $callBack = route('payment.verify', 'idPay');
        //        $params = array(
        //            'order_id' => $order->code,
        //            'amount' => $order->amount,
        //            'name' => $order->user->name,
        //            'phone' => $order->user->mobile,
        //            'mail' => $order->user->email,
        //            'desc' => 'توضیحات پرداخت کننده',
        //            'callback' => $callBack,
        //        );
        //        $ch = curl_init();
        //        curl_setopt($ch, CURLOPT_URL, 'https://api.idpay.ir/v1.1/payment');
        //        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        //        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        //        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        //            'Content-Type: application/json',
        //            'X-API-KEY: ' . Config::get('services.gateways.id_pay.api_key') . '',
        //            'X-SANDBOX: 1' // for real gateway comment the sandbox line
        //        ));
        //        $result = curl_exec($ch);
        //        curl_close($ch);
        //        $result = json_decode($result, true);
        //        if (isset($result['error_code'])) {
        //            throw  new \InvalidArgumentException($result['error_message']);
        //        }
        //        return redirect()->away($result['link']);


    }


}
