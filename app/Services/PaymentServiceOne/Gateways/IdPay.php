<?php


namespace App\Services\PaymentServiceOne\Gateways;


use App\Models\Order;
use Illuminate\Http\Request;


class IdPay implements GatewayInterface
{
    const IdPay = 'idPay';

    // private $merchantID;
    private $apiKey;
    private $callBack;


    public function __construct()
    {
        // $this->merchantID = '1234656';
        $this->apiKey = config('services.gateways.id_pay.api_key');
        $this->callBack = route('payment.verify', $this->getName());
    }


    public function payment(Order $order)
    {

        $params = array(
            'order_id' => null,
            'amount' => null,
            'name' => $order->user->name,
            'phone' => $order->user->mobile,
            'mail' => $order->user->email,
            'desc' => 'توضیحات پرداخت کننده',
            'callback' => $this->callBack,
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.idpay.ir/v1.1/payment');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'X-API-KEY: ' . $this->apiKey . '',
            'X-SANDBOX: 1' // for real gateway comment the sandbox line
        ));

        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result, true);
        if (isset($result['error_code'])) {
            throw  new \InvalidArgumentException($result['error_message']);
        }
       // dd($result);
       return redirect()->away($result['link']);

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

        dd($request);

        //// verify payment from idPay
        $params = array(
            'id' => '',
            'order_id' => '',
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.idpay.ir/v1.1/payment/verify');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'X-API-KEY: ' . $this->apiKey . '',
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

    private function getOrder($resNum)
    {
        return Order::where('code', $resNum)->firstOrFailed();
    }

    private function transactionSuccess($order, $refNum)
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
