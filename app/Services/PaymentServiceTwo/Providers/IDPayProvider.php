<?php


namespace App\Services\PaymentService\Providers;


use App\Services\PaymentService\Contracts\AbstractProviderConstructor;
use App\Services\PaymentService\Contracts\PayableInterface;
use App\Services\PaymentService\Contracts\VerifyInterface;
use function Nette\Utils\data;

// this idpay provider is payment gateway like zarrinpal , mellat
class IDPayProvider extends AbstractProviderConstructor implements PayableInterface, VerifyInterface
{

    private $StatusOk = 100;
    private $StatusOKAlready = 101;

    public function pay()
    {
        // this request come from AbstractProviderConstructor class
        // $this->request;
        // $this->request is content info for payment operation
        // dd($this->request->getAmount());
        $info = $this->request;
        $full_user = $info->getUser()->first_name . ' ' . $info->getUser()->last_name;
        $params = array(
            'order_id' => $info->getOrderId(),
            'amount' => $info->getAmount(),
            'name' => $full_user,
            'phone' => $info->getUser()->mobile,
            'mail' => $info->getUser()->email,
            'desc' => 'توضیحات پرداخت کننده',
            'callback' => route('callback.pay'),
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.idpay.ir/v1.1/payment');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'X-API-KEY: ' . $info->getApiKey() . '',
            'X-SANDBOX: 1' // for real gateway comment the sandbox line
        ));

        $result = curl_exec($ch);
        curl_close($ch);
        $send_result = json_decode($result, true);
        //dd($send_result);
        if (isset($send_result['error_code'])) {
            throw  new \InvalidArgumentException($send_result['error_message']);
        }
        // redirect user to gateway
        return redirect()->away($send_result['link']);


    }

    public function verify()
    {
        //  dd($this->request);
        $params = array(
            'id' => $this->request->getId(),
            'order_id' => $this->request->getOrderId(),
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.idpay.ir/v1.1/payment/verify');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'X-API-KEY: ' . $this->request->getApiKey() . '',
            'X-SANDBOX: 1',
        ));

        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result, true);

        if (isset($result['error_code'])) {
            return [
                'status' => false,
                'statusCode' => $result['error_code'],
                'msg' => $result['error_message'],
            ];
        }
        if ($result['status'] == $this->StatusOk) {
            return [
                'status' => true,
                'order_id' => $result['order_id'],
                'statusCode' => $result['status'],
                'data' => $result,
            ];
        }
        return [
            'status' => true,
            'order_id' => $result['order_id'],
            'statusCode' => $result['status'],
            'data' => $result,
        ];

    }
}
