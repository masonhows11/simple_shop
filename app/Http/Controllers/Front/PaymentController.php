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
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

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

         // dd($this->request);


        $this->validateForm($request);


        DB::beginTransaction();

        try {



            // make order & order items
            $order = $this->makeOrder();
            // make payment
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

            //            $user = Auth::user();
            //            $callBack = route('payment.verify', 'idPay');
            //            $full_user = $user->first_name . ' ' . $user->last_name;
            //            $params = array(
            //                'order_id' => $order->code,
            //                'amount' => $order->amount * 10,
            //                'name' => $full_user,
            //                'phone' => $user->mobile,
            //                'mail' => $user->email,
            //                'desc' => 'توضیحات پرداخت کننده',
            //                'callback' => $callBack,
            //            );
            //            $ch = curl_init();
            //            curl_setopt($ch, CURLOPT_URL, 'https://api.idpay.ir/v1.1/payment');
            //            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
            //            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            //            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            //                'Content-Type: application/json',
            //                'X-API-KEY: ' .  Config::get('services.gateways.id_pay.api_key')  . '',
            //                'X-SANDBOX: 1' // for real gateway comment the sandbox line
            //            ));
            //            $result = curl_exec($ch);
            //            curl_close($ch);
            //            $send_result = json_decode($result, true);
            //            if (isset($send_result['error_code'])) {
            //                throw  new \InvalidArgumentException($send_result['error_message']);
            //            }
            //            return redirect()->away($send_result['link']);

        } catch (\Exception $ex) {

            DB::rollBack();
            return $ex->getMessage();

        }
    }


    public function verify(Request $request)
    {
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
