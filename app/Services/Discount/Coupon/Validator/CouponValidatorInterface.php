<?php


namespace App\Services\Discount\Coupon\Validator;


use App\Models\Coupon;

interface CouponValidatorInterface
{

    //// set next validate function
    public function setNextValidator(CouponValidatorInterface $couponValidator);

    public function validate(Coupon $coupon);
}
