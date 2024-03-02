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
        /// send payment request may differ depending on ype of payment gateway
        //  dd(self::IdPay);

        //// send payment to idPay
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

    private function redirectToBank(Order $order)
    {
        return 'redirect user to bank';
    }

    public function verify(Request $request)
    {

        //// check input response from bank for verify payment if success or not
        //        if (!$request->has('State') || $request->has('State') !== 'OK') {
        //            return $this->transactionFailed();
        //        }

        //// for verify payment after payment success
        /// payment confirmation may differ depending on ype of payment gateway
        /// .... in soapClient is route for verify depend on payment gateway
        /// this code for saman payment gateway
        /// ResNum code generate from app
        /// RefNum code generate from bank / gateway
        //        $soapClient = new \SoapClient(" route for verify payment to saman gateway");
        //        $response = $soapClient->verifyTransaction($request->input('RefNum'), $this->merchantID);
        //        $order = $this->getOrder($request->input('ResNum'));

        //// 1000 is price fir shipment for example
        /// total amount + shipment amount user must be pay
        //        return $response == ($order->amount + 1000 ) ?
        //            $this->transactionSuccess($order,$request->input('ResNum')) :
        //            $this->transactionFailed();

        //// verify payment from idPay

    }

    private function getOrder($resNum)
    {
        return Order::where('code',$resNum)->firstOrFailed();
    }
    private function transactionSuccess($order,$refNum)
    {
        return [
            'status' => self::TRANSACTION_SUCCESS,
            'order' => $order,
            'refNum' => $refNum,
            'gateway' => $this->getName()
        ];
    }


    private function transactionFailed()
    {
        return [
            'status' => self::TRANSACTION_FAILED,
            ''
        ];
    }

    public function getName(): string
    {
        return self::IdPay;
    }
}
