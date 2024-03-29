<?php


namespace App\Services\PaymentServiceTwo\Contracts;


// make constructor for all payment providers
abstract class AbstractProviderConstructor
{
    // when set Access level this property as protected
    // the child class can access to
    protected $request;

    // this abstract class  initial value  gateway request like IdPayGateway
    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }
}
