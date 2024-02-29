<?php


namespace App\Services\Payment\Gateways;


use App\Models\Order;
use Illuminate\Http\Request;

class IdPay implements GatewayInterface
{
    const IdPay = 'idPay';

    private $merchantID;
    private $callBak;


    public function __construct()
    {
        $this->merchantID = '123456789';
        //// define call back route & set a gateway name
        /// with $this->getName() method
        $this->callBak = route('payment.verify', $this->getName());
    }


    public function pay(Order $order)
    {
        dd(self::IdPay);
    }

    private function redirectToBank(Order $order)
    {
        return 'redirect user to bank';
    }

    public function verify(Request $request)
    {

        //// check input response from bank
        if (!$request->has('State') || $request->has('State') !== 'OK') {
            return $this->transactionFailed();
        }
    }


    private function transactionFailed()
    {
        return [
                'status' =>  self::TRANSACTION_FAILED,
            ''
        ];
    }

    public function getName(): string
    {
        return self::IdPay;
    }
}
