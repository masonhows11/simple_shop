<?php


namespace App\Services\Discount\Coupon\Validator;


use App\Models\Coupon;
use App\Services\Discount\Coupon\Validator\Contracts\AbstractCouponValidator;

class IsExpired extends AbstractCouponValidator
{

    public function validate(Coupon $coupon){

        dd($coupon);
    }
}
