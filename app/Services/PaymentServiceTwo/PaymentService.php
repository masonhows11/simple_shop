<?php


namespace App\Services\PaymentService;

use App\Services\PaymentService\Contracts\RequestInterface;
use App\Services\PaymentService\Exceptions\ProviderNotFoundException;

class PaymentService
{

    public const IDPAY = 'IDPayProvider';
    public const ZARRINPAL = 'ZarinpalProvider';

    private $provider_name;
    // RequestInterface $request  means that request is type of payment gateway we used for pay
    private RequestInterface $request;

    // RequestInterface $request  means that request is type of payment gateway we used for pay
    public function __construct($provider_name, RequestInterface $request)
    {
        $this->provider_name = $provider_name;
        $this->request = $request;
    }

    // for find payment provider like zarinpal or idpay or mellat
    private function findProvider()
    {
        // find provider
        $providerClassName = 'App\\Services\\PaymentService\\Providers\\' . $this->provider_name;
        if (!class_exists($providerClassName)) {
            throw new ProviderNotFoundException(__('messages.the_selected_payment_gateway_could_not_be_found'));
        }
        // create an instance founded class
        // give request to construct that made as abstract class for gateway providers
        // $this->request is type of payment provider we used and when we call construct method
        // we should give data  , these data is request type of payment provider
        return new $providerClassName($this->request);
    }


    public function pay()
    {
        try {
            // the pay() method is defined in interface
            return $this->findProvider()->pay();
        } catch (ProviderNotFoundException $e) {
            return $e->getMessage();
        }
    }


    public function verify()
    {
        try {
            // the pay() method is defined in interface
            return $this->findProvider()->verify();
        } catch (ProviderNotFoundException $e) {
            return $e->getMessage();
        }
    }

}
