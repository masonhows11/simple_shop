<?php


namespace App\Services\PaymentServiceOne\Gateways;


use App\Models\Order;
use Illuminate\Http\Request;

class Zarinpal  implements GatewayInterface
{
    const ZARINPAL = 'zarinpal';

    public function payment(Order $order)
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
