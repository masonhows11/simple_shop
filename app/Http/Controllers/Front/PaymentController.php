<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Services\Basket\Basket;
use App\Services\PaymentServiceOne\Transaction;
use App\Services\PaymentServiceTwo\PaymentService;
use App\Services\PaymentServiceTwo\Request\IDPayRequest;
use App\Services\PaymentServiceTwo\Request\IDPayVerifyRequest;


class PaymentController extends Controller
{

    private Transaction $transaction;
    private Request $request;
    private Basket $basket;

    public function __construct(Transaction $transaction, Request $request, Basket $basket)
    {
        $this->transaction = $transaction;
        $this->request = $request;
        $this->basket = $basket;
    }

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
            session(['current_user' => Auth::user()]);
            $order = $this->makeOrder();
            $this->makePayment($order);
            DB::commit();
            $idPayRequest = new IDPayRequest([
                'amount' => $order->amount,
                'orderId' => $order->code,
                'user' => Auth::user(),
                'apiKey' => Config::get('services.gateways.id_pay.api_key'),
            ]);
            $paymentService = new PaymentService(PaymentService::IDPAY, $idPayRequest);
            return $paymentService->pay();
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => $ex->getMessage()]);
        }
    }


    public function verify(Request $request)
    {
        $paymentInfo = $request->all();
        $idPayVerifyRequest = new  IDPayVerifyRequest([
            'apiKey' => config('services.gateways.id_pay.api_key'),
            'id' => $paymentInfo['id'],
            'orderId' => $paymentInfo['order_id'],
        ]);
        $paymentService = new PaymentService(PaymentService::IDPAY, $idPayVerifyRequest);
        $result = $paymentService->verify();
        if ($result['status'] == false ) {
          return  $this->sendErrorResponse($result);
        }
        if ($result['status'] == true) {
            return  $this->sendSuccessResponse($result);
        }
    }

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
            'method' => $this->request['method'],
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

    private function sendErrorResponse($result)
    {

        session()->flash('error', __('messages.payment_failed'));
        return redirect()->route('home');
    }

    private function sendSuccessResponse($result)
    {

        session()->flash('success', __('messages.payment_successfully'));
        return redirect()->route('home');
    }

    //    public function verify(Request $request)
    //    {
    //        $result = $this->transaction->verify();
    //        return $result ? $this->sendErrorResponse() : $this->sendSuccessResponse();
    //    }



}
