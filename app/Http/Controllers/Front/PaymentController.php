<?php

namespace App\Http\Controllers\Front;

use App\Events\OrderRegisteredEvent;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Services\Price\Contracts\PriceInterface;
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
    private PriceInterface $price;

    public function __construct(Transaction $transaction, Request $request, Basket $basket,PriceInterface $price)
    {
        $this->transaction = $transaction;
        $this->request = $request;
        $this->basket = $basket;
        $this->price = $price;
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

            // id condition true
            if($request->missing('order_id')){
                 $order = $this->makeOrder();
                 $order->generateInvoice();
                // dd('invoice created');
                $payment = $this->makePayment($order);
                DB::commit();
            // if condition false
            }else{
                $order = Order::where('id',$request->order_id)->first();
                $payment = $order->payment;
            }

            if ($payment->isOnline()) {

                $gateway = $this->request->gateway;
                if ($gateway == 'idPay') {
                    $idPayRequest = new IDPayRequest([
                        //// $this->price->getTotalPrices() this total price means =  cart price + shipping price
                        'amount' => $this->price->getTotalPrices(),
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

        $idPayVerifyRequest = new  IDPayVerifyRequest([
            'apiKey' => config('services.gateways.id_pay.api_key'),
            'id' => $paymentInfo['id'],
            'orderId' => $paymentInfo['order_id'],
            'gateway' => 'idPay',
        ]);

        $paymentService = new PaymentService(PaymentService::IDPAY, $idPayVerifyRequest);
        $result = $paymentService->verify();

        if ($result['status'] == false) {
            return redirect()->route('payment.failed.result')->with('result',$result);
        }
        if ($result['status'] == true) {
            return $this->sendSuccessResponse($result);
        }
        return null;
    }

    private function makeOrder()
    {
        $order = Order::updateOrCreate(
            ['user_id' => auth()->id(), 'status' => 0],
            ['code' => bin2hex(Str::random(16)),
                'amount' => $this->basket->subTotal()]
        );
        //        $order = Order::create([
        //            'user_id' => auth()->id(),
        //            'code' => bin2hex(Str::random(16)),
        //            'amount' => $this->basket->subTotal(),
        //        ]);
        $order->products()->attach($this->products());
        return $order;
    }

    private function makePayment($order)
    {
        return Payment::updateOrCreate(
            ['order_id' => $order->id, 'status' => 0],
            ['method' => $this->request['method'],
                'amount' => $this->price->getTotalPrices(),]
        );

        //        return Payment::updateOrCreate(
        //            ['order_id' => $order->id, 'status' => 0],
        //            ['method' => $this->request['method'],
        //             'amount' => $order->amount,]
        //        );

        //        return Payment::create([
        //            'order_id' => $order->id,
        //            'method' => $this->request['method'],
        //            'amount' => $order->amount,
        //        ]);
    }

    //// Add the number of each product
    private function products()
    {
        $products = [];
        foreach ($this->basket->all() as $product) {
            $products[$product->id] = ['quantity' => $product->stock];
        }
        return $products;
    }

    private function sendErrorResponse($result = null, $message = null)
    {
        session()->flash('error', $message ? $message : __('messages.payment_failed'));
        return redirect()->route('home');
    }

    private function sendSuccessResponse($result = null, $message = null)
    {
        // update order
        $order = Order::where('code', $result['order_id'])->first();
        $order->status = 1;
        $order->save();
        // update payment
        $this->completeOrder($order);
        $this->confirmPayment($result, $order);
        session()->flash('success', $message ? $message : __('messages.payment_successfully'));
        return redirect()->route('home');
    }

    public function confirmPayment($result, Order $order)
    {
        return $order->payment->confirm($result['data']['track_id'], $result['gateway']);
    }

    private function normalizeQuantity($order)
    {

        foreach ($order->products as $product) {
            $product->decrementStock($product->pivot->quantity);
        }
    }

    private function completeOrder($order)
    {

        //// Decreasing the number of products the user has purchased
         $this->normalizeQuantity($order);

        //// call event send email for send order detail email
          event(new OrderRegisteredEvent($order));

        //// clear all session  basket items
        $this->basket->clear();
    }

    public function failedPaymentResult()
    {
        $user = Auth::id();


        // update order
        $currentOrder = Order::where('user_id', $user)->where('status', '=', 0)->first();
        // 0 on process
        // 1 paid
        // 2 unpaid
        $currentOrder->status = 2;
        $currentOrder->save();


        // update payment
        $currentPayment = Payment::where('order_id', '=', $currentOrder->id)->first();
        $currentPayment->update([
            'status' => 2,
            'bank_id' => null,
        ]);
        // Returning cart items
        $items = Order::find($currentOrder->id)->products()->get();
        foreach ($items as $item){
            $this->basket->addToBasket( Product::find($item->pivot->product_id), $item->pivot->quantity);
        }
         return  $this->sendErrorResponse();
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
