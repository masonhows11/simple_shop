<?php


namespace App\Services\Discount\Coupon\Validator\Contracts;


use App\Models\Coupon;

interface CouponValidatorInterface
{

    //// set next validate function
    /// CouponValidatorInterface this is instance of self interface
    public function setNextValidator(CouponValidatorInterface $couponValidator);
    //// Coupon this is parameter must be validate
    public function validate(Coupon $coupon);
}
