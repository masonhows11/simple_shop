<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    //
    public function store(Request $request)
    {
       // dd($request->all());

        try {
            $request->validate([
                'code' => ['required','exists:coupons,code']
            ]);

            $coupon = Coupon::where('code',$request->code)->firstOrFail();
            session()->put(['coupon' => $coupon]);
           return redirect()->back()->with('success',__('messages.coupon_applied_successful'));
        }catch (\Exception $ex){
            return redirect()->back()->withErrors(__('messages.invalid_coupon'));
        }


    }
}
