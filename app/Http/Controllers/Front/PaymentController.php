<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\PaymentServiceOne\Transaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    private  $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
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




    public function verify(Request $request)
    {
        // dd('return from bank');
        // dd($request->all());
        // dd($result);
        $result = $this->transaction->verify();
        return $result ? $this->sendErrorResponse() : $this->sendSuccessResponse();
    }


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
