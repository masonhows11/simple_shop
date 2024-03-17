<?php


namespace App\Services\Discount\Coupon\Validator;


use App\Exceptions\UserNotAllowedCouponException;
use App\Services\Discount\Coupon\Validator\Contracts\AbstractCouponValidator;
use App\Models\Coupon;

class CanUserUseCoupon extends AbstractCouponValidator
{
    public function validate(Coupon $coupon)
    {

        if (!auth()->user()->coupons->contains($coupon)) {
            throw  new UserNotAllowedCouponException();
        }
        //// for execute next validator
        //// parent is  AbstractCouponValidator class and validate is function
        //// for set new validator function
        return parent::validate($coupon);

    }
}
