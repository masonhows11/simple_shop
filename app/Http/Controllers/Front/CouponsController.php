<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    //
    public function store(Request $request)
    {
       // dd($request->all());

        $request->validate([
           'code' => ['required','exists:coupons,code']
        ]);

    }
}
