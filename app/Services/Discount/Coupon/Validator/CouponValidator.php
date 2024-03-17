<?php


namespace App\Services\Discount\Coupon\Validator;


use App\Models\Coupon;

class CouponValidator
{

    public function isValid(Coupon $coupon)
    {

        $isExpired = resolve(IsExpired::class);
        $canUsedIt = resolve(CanUserUseCoupon::class);

        //// set next validator for our steps
        $isExpired->setNextValidator($canUsedIt);

        return $isExpired->validate($coupon);

    }
}
