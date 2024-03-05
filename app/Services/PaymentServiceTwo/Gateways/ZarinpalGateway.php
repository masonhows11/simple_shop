<?php


namespace App\Services\PaymentServiceTwo\Gateways;


use App\Services\PaymentServiceTwo\Contracts\AbstractProviderConstructor;
use App\Services\PaymentServiceTwo\Contracts\PayableInterface;
use App\Services\PaymentServiceTwo\Contracts\VerifyInterface;

class ZarinpalGateway extends AbstractProviderConstructor implements PayableInterface , VerifyInterface
{


    public function pay()
    {

    }

    public function verify()
    {

    }
}
