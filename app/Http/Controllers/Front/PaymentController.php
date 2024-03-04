<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\Payment\Transaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    private  $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
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
