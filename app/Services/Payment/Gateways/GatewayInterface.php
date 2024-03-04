<?php


namespace App\Services\Payment\Gateways;


use App\Models\Order;
use Illuminate\Http\Request;

interface GatewayInterface
{
    const TRANSACTION_FAILED = 'messages.payment_failed';
    const TRANSACTION_SUCCESS = 'messages.payment_successfully';


    public function payment(Order $order);

    public function verify(Request $request);

    public function getName(): string;

}
