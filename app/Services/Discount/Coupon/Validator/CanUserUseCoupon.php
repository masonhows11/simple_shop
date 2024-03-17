<?php


namespace App\Services\Discount\Coupon\Validator;


use App\Services\Discount\Coupon\Validator\Contracts\AbstractCouponValidator;
use App\Models\Coupon;

class CanUserUseCoupon extends AbstractCouponValidator
{
    public function validate(Coupon $coupon)
    {

        dd("can use it class");

    }
}
