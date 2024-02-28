<?php


namespace App\Services\Payment\Gateways;


use App\Models\Order;
use Illuminate\Http\Request;

class IdPay implements GatewayInterface
{
    const IdPay = 'idPay';
    public function pay(Order $order)
    {
        dd(self::IdPay);
    }

    public function verify(Request $request)
    {

    }

    public function getName(): string
    {
        return self::IdPay;
    }
}
