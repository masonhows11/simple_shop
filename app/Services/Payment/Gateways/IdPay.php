<?php


namespace App\Services\Payment\Gateways;


use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class IdPay implements GatewayInterface
{
    const IdPay = 'idPay';

    // private $merchantID;
    private $apiKey;
    private $callBak;


    public function __construct()
    {
        // $this->merchantID = '1234656';
        $this->apiKey = config('services.gateways.id_pay.api_key');
        //// define call back route & set a gateway name
        /// with $this->getName() method
        $this->callBak = route('payment.verify', $this->getName());
    }


    public function pay(Order $order)
    {
        /// send payment request may differ depending on ype of payment gateway
        //  dd(self::IdPay);

        //// send payment to idPay gateway with redirectToBank($order) function and order parameter
        $this->redirectToBank($order);

    }

    private function redirectToBank(Order $order)
    {


        //// redirect user to bank
        $params = array(
            'order_id' => $order->code,
            'amount' => $order->amount,
            'name' => $order->user->name,
            'phone' => $order->user->mobile,
            'mail' => $order->user->email,
            'desc' => 'توضیحات پرداخت کننده',
            'callback' => $this->callBak,
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


        ///// if error code true means send request to gateway has error
        if (isset($result['error_code'])) {
            throw  new \InvalidArgumentException($result['error_message']);
        }


        //// if no error_code then redirect user to gateway
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

        // for test callback
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
