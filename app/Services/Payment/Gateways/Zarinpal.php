<?php


namespace App\Services\Payment\Gateways;


use App\Models\Order;
use Illuminate\Http\Request;

class Zarinpal  implements GatewayInterface
{
    const ZARINPAL = 'zarinpal';

    public function pay(Order $order)
    {
        dd(self::ZARINPAL);
    }

    public function verify(Request $request)
    {

    }

    public function getName(): string
    {
       return self::ZARINPAL;
    }
}
