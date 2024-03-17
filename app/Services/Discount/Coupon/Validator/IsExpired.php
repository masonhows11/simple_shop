<?php


namespace App\Services\Discount\Coupon\Validator;


use App\Exceptions\CouponHasExpiredException;
use App\Models\Coupon;
use App\Services\Discount\Coupon\Validator\Contracts\AbstractCouponValidator;

class IsExpired extends AbstractCouponValidator
{

    public function validate(Coupon $coupon)
    {



        if($coupon->isExpired()){
            throw  new CouponHasExpiredException();
        }

        //// for execute next validator
        /// parent is class AbstractCouponValidator and validate is function
        /// for set new validator function
        return parent::validate($coupon);

    }
}
