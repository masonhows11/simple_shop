<?php


namespace App\Services\Payment\Gateways;


use App\Models\Order;
use Illuminate\Http\Request;

class IdPay implements GatewayInterface
{
    const IdPay = 'zarinpal';
    public function pay(Order $order)
    {

    }

    public function verify(Request $request)
    {

    }

    public function getName(): string
    {
        return self::IdPay;
    }
}
