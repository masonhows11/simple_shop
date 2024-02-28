<?php


namespace App\Services\Payment;


use App\Models\Order;
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
        dd($order);
    }


    private function makeOrder()
    {
        $order = Order::create([
            'user_id' => auth()->id(),
            'code' => bin2hex(Str::random(16)),
            'amount' => $this->basket->subTotal(),
        ]);

        $this->products();
        // $order->products->attach();


        return $order;
    }

    private function products()
    {

        foreach ($this->basket->all() as $product) {
            $products[$product->id] = ['quantity' => $product->stock];
        }

        dd($products);
    }

}
