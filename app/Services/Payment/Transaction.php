<?php


namespace App\Services\Payment;


use App\Events\OrderRegisteredEvent;
use App\Models\Order;
use App\Models\Payment;
use App\Services\Basket\Basket;
use App\Services\Payment\Gateways\GatewayInterface;
use App\Services\Payment\Gateways\IdPay;
use App\Services\Payment\Gateways\Zarinpal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Transaction
{
    //// this transaction for doing things for payment sequence

    private $request;
    private $basket;

    public function __construct(Request $request, Basket $basket)
    {
        $this->request = $request;
        $this->basket = $basket;
    }

    public function checkOut()
    {

        DB::beginTransaction();

        try {
            $order = $this->makeOrder();
            $payment = $this->makePayment($order);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }

        if ($payment->isOnline()) {
            // dd($this->gatewayFactory());
            return $this->gatewayFactory()->pay($order);
        }

        $this->completeOrder($order);
        return $order;

        // Decreasing the number of products the user has purchased
        // $this->normalizeQuantity($order);

        // call event send email for send order detail email
       // event(new OrderRegisteredEvent($order));

       // $this->basket->clear();
    }


    private function gatewayFactory()
    {
        //// return gateway class based on request
        $gateway = ['zarinpal' => Zarinpal::class, 'idPay' => IdPay::class][$this->request->gateway];
        // dd($gateway);
        //// make once new instance gateway with resolve() method container laravel
        return resolve($gateway);
    }

    private function makePayment($order)
    {

        return Payment::create([
            'order_id' => $order->id,
            'method' => $this->request->method,
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

    public function verify()
    {
        $result = $this->gatewayFactory()->veriy($this->request);
        //////// if payment failed ////////
        if ($result['status'] == GatewayInterface::TRANSACTION_FAILED) return false;
        //////// if payment success ////////
        // confirm current payment record
        $this->confirmPayment($result);

        $this->completeOrder($result['order']);
        return true;

        // Decreasing the number of products the user has purchased
        // $this->normalizeQuantity($result['order']);

        // call event send email for send order detail email
        // event(new OrderRegisteredEvent($result['order']));

        // clear all session  basket items
        // $this->basket->clear();
    }
    public function confirmPayment($result)
    {
        return $result['order']->payment()->confirm($result['refNum'], $result['gateway']);
    }
    private function normalizeQuantity($order)
    {

        foreach ($order->products as $product) {
            $product->decrementStock($product->pivot->quantity);
        }
    }

    private function completeOrder($order)
    {
        // Decreasing the number of products the user has purchased
        $this->normalizeQuantity($order);
        // call event send email for send order detail email
        event(new OrderRegisteredEvent($order));
        // clear all session  basket items
        $this->basket->clear();
    }
}
