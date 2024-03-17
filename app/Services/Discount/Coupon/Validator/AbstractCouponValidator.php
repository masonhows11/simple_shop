<?php


namespace App\Services\Discount\Coupon\Validator;


use App\Models\Coupon;

abstract class AbstractCouponValidator implements CouponValidatorInterface
{

    //// for set next validator
    private $nextValidator;

    //// set next validate function for validate coupon code
    public function setNextValidator(CouponValidatorInterface $couponValidator){

        $this->nextValidator = $couponValidator;
    }

    public function validate(Coupon $coupon){

        //// the chain of validator is end
        /// and there is not next validator function
        if($this->nextValidator == null){
            return true;
        }
    }
}
