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

            $order = $this->makeOrder();
            $payment = $this->makePayment($order);
            DB::commit();


            if ($payment->isOnline()) {

                $gateway = $this->request->gateway;
                if ($gateway == 'idPay') {
                    $idPayRequest = new IDPayRequest([
                        'amount' => $order->amount,
                        'orderId' => $order->code,
                        'user' => Auth::user(),
                        'apiKey' => Config::get('services.gateways.id_pay.api_key'),
                    ]);
                    $paymentService = new PaymentService(PaymentService::IDPAY, $idPayRequest);
                    return $paymentService->pay();
                }
                if ($gateway == 'zarinpal') {
                    session()->flash('warning', __('messages.this_part_is_being_prepared'));
                    return redirect()->back();
                }

            } else {
                $result = [
                    'status' => true,
                    'order_id' => $order->code,

                ];
                $this->basket->clear();
                session()->flash('success', __('messages.your_order_has_been_successfully_register_with_number', ['order_number' => $result['order_id']]));
                return redirect()->route('home');
            };
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => __('messages.An_error_occurred')]);
        }
    }


    public function verify(Request $request)
    {

        $paymentInfo = $request->all();
        // dd($paymentInfo);
        $idPayVerifyRequest = new  IDPayVerifyRequest([
            'apiKey' => config('services.gateways.id_pay.api_key'),
            'id' => $paymentInfo['id'],
            'orderId' => $paymentInfo['order_id'],
            'gateway' => 'idPay',
        ]);

        $paymentService = new PaymentService(PaymentService::IDPAY, $idPayVerifyRequest);

        $result = $paymentService->verify();

        if ($result['status'] == false) {
            return $this->sendErrorResponse($result);
        }

        if ($result['status'] == true){
            return $this->sendSuccessResponse($result);
        }

        return null;
    }

    private function makePayment($order)
    {

        return Payment::create([
            'order_id' => $order->id,
            'method' => $this->request['method'],
            'amount' => $order->amount,
        ]);
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

    private function products()
    {

        $products = [];
        foreach ($this->basket->all() as $product) {
            $products[$product->id] = ['quantity' => $product->stock];
        }
        return $products;
    }

    //    private function gateway()
    //    {
    //
    //        //// make gateway
    //
    //        ////  and make gateway request
    //
    //        // $idPayRequest = new IDPayRequest([
    //        //     'amount' => $order->amount,
    //        //     'orderId' => $order->code,
    //        //     'user' => Auth::user(),
    //        //     'apiKey' => Config::get('services.gateways.id_pay.api_key'),
    //        // ]);
    //
    //
    //        // $paymentService = new PaymentService(PaymentService::IDPAY, $idPayRequest);
    //        // return $paymentService->pay();
    //
    //    }



    private function sendErrorResponse($result, $message = null)
    {

        session()->flash('error', $message ? $message : __('messages.payment_failed'));
        return redirect()->route('home');
    }

    private function sendSuccessResponse($result, $message = null)
    {

        session()->flash('success', $message ? $message : __('messages.payment_successfully'));
        return redirect()->route('home');
    }



    /////// other way for pay & verify ///////
    //    public function pay(Request $request)
    //    {
    //        $this->validateForm($request);
    //        $order = $this->transaction->checkout();
    //        session()->flash('success', __('messages.your_order_has_been_successfully_register_with_number', ['order_number' => $order->code]));
    //        return redirect()->route('home');
    //
    //    }

    //    public function verify(Request $request)
    //    {
    //        dd($request);
    //
    //        $result = $this->transaction->verify();
    //        return $result ? $this->sendErrorResponse() : $this->sendSuccessResponse();
    //    }


}
