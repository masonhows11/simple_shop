<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function invoice(Order $order)
    {
      // for download invoice
      // check if invoice does not exist
      // create first then download
      // or if exists download it
        try {
            return   $order->downloadInvoice();
        }catch (\Exception $ex){
            return redirect()->back()->with(['error' => __('messages.an_error_occurred_in_receiving_the_file')]);
        }

    }

    public function pay(Order $order)
    {
        $re_paid = true;
        $info = Auth::user()->addresses;
        return view('front.payment.check_out')
            ->with(['info' => $info,'order' => $order ,'re_paid' => $re_paid]);
    }
}
