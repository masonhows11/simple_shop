<?php


namespace App\Services\Discount\Coupon\Validator;


use App\Models\Coupon;

abstract class AbstractCouponValidator implements CouponValidatorInterface
{

    //// for set next validator
    private $nextValidator;

    //// set next validate function
    public function setNextValidator(CouponValidatorInterface $couponValidator){

    }

    public function validate(Coupon $coupon){

    }
}
