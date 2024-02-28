<?php


namespace App\Services\Payment;


use App\Models\Order;
use App\Models\Payment;
use App\Services\Basket\Basket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Transaction
{

    private $request;
    private $basket;

    public function __construct(Request $request, Basket $basket)
    {
        $this->request = $request;
        $this->basket = $basket;
    }

    public function checkOut()
    {

        $order = $this->makeOrder();
        $payment = $this->makePayment($order);

        if ($payment->isOnline()) {
            dd('is online');
        }

        $this->basket->clear();
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

}
