<?php


namespace App\Services\Payment;


use App\Models\Order;
use App\Services\Basket\Basket;
use Illuminate\Http\Request;

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
        // dd('hello transaction');
        $order = $this->makeOrder();
    }


    private function makeOrder()
    {
        Order::create([

        ]);
    }

}
