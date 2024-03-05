<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\PaymentServiceOne\Transaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    //    private  $transaction;
    //
    //    public function __construct(Transaction $transaction)
    //    {
    //        $this->transaction = $transaction;
    //    }

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

    // for pay the payment
    public function pay(Request $request)
    {

        $this->validateForm($request);

        session()->flash('success', __('messages.your_order_has_been_successfully_register_with_number', ['order_number' => $order->id]));
        return redirect()->route('home');

    }
    // for verify the payment
    public function verify(Request $request)
    {


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
