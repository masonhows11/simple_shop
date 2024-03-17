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
        try {
            //// validate coupon code
            $request->validate([
                'code' => ['required','exists:coupons,code']
            ]);

            //// check coupon belong to user


            //// save coupon to session user
            $coupon = Coupon::where('code',$request->code)->firstOrFail();
            session()->put(['coupon' => $coupon]);

            //// redirect to same view
           return redirect()->back()->with('success',__('messages.coupon_applied_successful'));
        }catch (\Exception $ex){
            return redirect()->back()->withErrors(__('messages.invalid_coupon'));
        }
    }

    public function delete(Request $request)
    {
        session()->forget('coupon');
        return redirect()->back();
    }
}
