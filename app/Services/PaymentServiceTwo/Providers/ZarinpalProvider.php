<?php


namespace App\Services\PaymentService\Providers;


use App\Services\PaymentService\Contracts\AbstractProviderConstructor;
use App\Services\PaymentService\Contracts\PayableInterface;
use App\Services\PaymentService\Contracts\RequestInterface;
use App\Services\PaymentService\Contracts\VerifyInterface;

class ZarinpalProvider extends AbstractProviderConstructor implements PayableInterface , VerifyInterface
{


    public function pay()
    {

    }

    public function verify()
    {

    }
}
