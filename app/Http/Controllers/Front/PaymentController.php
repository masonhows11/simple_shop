<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Services\Basket\Basket;
use App\Services\PaymentServiceOne\Transaction;
use App\Services\PaymentServiceTwo\PaymentService;
use App\Services\PaymentServiceTwo\Request\IDPayRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{

    private  $transaction;
    private $request;
    private $basket;

    public function __construct(Transaction $transaction, Request $request, Basket $basket)
    {
        $this->transaction = $transaction;
        $this->request = $request;
        $this->basket = $basket;
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


    public function pay(Request $request)
    {

        $this->validateForm($request);


        DB::beginTransaction();

        try {

            // make order & order items
            $order = $this->makeOrder();

            // make payment
            $this->makePayment($order);

            DB::commit();

            dd('hello fucker');

            $idPayRequest = new IDPayRequest([
                'amount' => 1000,
                'user' => Auth::user()->id,
            ]);



            $paymentService = new PaymentService(PaymentService::IDPAY, $idPayRequest);

            dd($paymentService->pay());
        } catch (\Exception $ex) {

            DB::rollBack();
            return $ex->getMessage();
        }
    }


    public function verify(Request $request)
    { }


    private function makeOrder()
    {
        $order = Order::create([
            'user_id' => auth()->id(),
            'code' => bin2hex(Str::random(16)),
            'amount' => $this->basket->subTotal(),
        ]);

        $order->products()->attach($this->products());
        return $order;
    }


    private function makePayment($order)
    {

        return Payment::create([
            'order_id' => $order->id,
            'method' => $this->request->method,
            'amount' => $order->amount,
        ]);
    }

    private function products()
    {

        $products = [];
        foreach ($this->basket->all() as $product) {
            $products[$product->id] = ['quantity' => $product->stock];
        }
        return $products;
    }


    //    public function verify(Request $request)
    //    {
    //        $result = $this->transaction->verify();
    //        return $result ? $this->sendErrorResponse() : $this->sendSuccessResponse();
    //    }


    private function sendErrorResponse()
    {
        session()->flash('error', __('messages.payment_failed'));
        return redirect()->route('home');
    }

    private function sendSuccessResponse()
    {
        session()->flash('error', __('messages.payment_successfully'));
        return redirect()->route('home');
    }
}
