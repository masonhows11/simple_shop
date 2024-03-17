<?php


namespace App\Services\Discount\Coupon\Validator;


use App\Models\Coupon;

class CouponValidator
{

    public function isValid(Coupon $coupon)
    {

        $isExpired = resolve(IsExpired::class);

        return $isExpired->validate($coupon);

    }
}
