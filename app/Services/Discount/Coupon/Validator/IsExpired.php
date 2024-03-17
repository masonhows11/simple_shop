<?php


namespace App\Services\Discount\Coupon\Validator;


use App\Exceptions\CouponHasExpiredException;
use App\Services\Discount\Coupon\Validator\Contracts\AbstractCouponValidator;
use App\Models\Coupon;

class IsExpired extends AbstractCouponValidator
{
    public function validate(Coupon $coupon)
    {
        if ($coupon->isExpired()) {
            throw  new CouponHasExpiredException();
        }
        //// for execute next validator
        //// parent is  AbstractCouponValidator class and validate() is function
        //// for set new validator function
        return parent::validate($coupon);

    }
}
