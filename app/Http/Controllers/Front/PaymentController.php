<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\PaymentServiceOne\Transaction;
use App\Services\PaymentServiceTwo\PaymentService;
use App\Services\PaymentServiceTwo\Request\IDPayRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class PaymentController extends Controller
{

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


    public function pay(Request $request)
    {

        $this->validateForm($request);


        try {

            $idPayRequest = new IDPayRequest([
                'amount' => 1000,
                'user' => Auth::user()->id,
            ]);

            $paymentService = new PaymentService(PaymentService::IDPAY, $idPayRequest);

            dd($paymentService->pay());

        } catch (\Exception $ex) {


            return $ex->getMessage();
        }





    }


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
