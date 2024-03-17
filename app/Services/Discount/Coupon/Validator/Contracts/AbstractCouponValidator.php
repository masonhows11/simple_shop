<?php


namespace App\Services\Discount\Coupon\Validator\Contracts;


use App\Models\Coupon;

abstract class AbstractCouponValidator implements CouponValidatorInterface
{

    //// for set next validator
    private $nextValidator;

    //// set next validate function for validate coupon code
    public function setNextValidator(CouponValidatorInterface $couponValidator){

        //// set next validate function into nextValidator variable
        $this->nextValidator = $couponValidator;
    }

    public function validate(Coupon $coupon){

        //// the chain of validators is finished
        /// and there is not next validator function
        if($this->nextValidator === null){
            return true;
        }
        //// else
        return  $this->nextValidator->validate($coupon);
    }
}
