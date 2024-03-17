<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Services\Discount\Coupon\Validator\CouponValidator;
use Illuminate\Http\Request;

class CouponsController extends Controller
{


    private $validator;

    public function __construct(CouponValidator $validator)
    {
        $this->validator = $validator;
    }

    //
    public function store(Request $request)
    {
        try {
            //// validate coupon code
            $request->validate([
                'code' => ['required', 'exists:coupons,code']
            ]);


            //// find Coupon
            $coupon = Coupon::where('code', $request->code)->firstOrFail();

            //// check coupon belong to user
            dd($this->validator->isValid($coupon));

            //// save coupon to session user
            session()->put(['coupon' => $coupon]);

            //// redirect to same view
            return redirect()->back()->with('success', __('messages.coupon_applied_successful'));
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors(__('messages.invalid_coupon'));
        }
    }

    public function delete(Request $request)
    {
        session()->forget('coupon');
        return redirect()->back();
    }
}
