<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function invoice(Order $order)
    {
      return   $order->downloadInvoice();
    }

    public function pay(Order $order)
    {

    }
}
