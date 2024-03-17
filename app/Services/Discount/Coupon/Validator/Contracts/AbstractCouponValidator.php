<?php


namespace App\Services\Discount\Coupon\Validator\Contracts;


use App\Models\Coupon;

abstract class AbstractCouponValidator implements CouponValidatorInterface
{

    //// for set next validator
    private $nextValidator;

    //// set next validate function for validate coupon code
    public function setNextValidator(CouponValidatorInterface $validator){

        //// set next validator into nextValidator variable
        $this->nextValidator = $validator;
    }

    public function validate(Coupon $coupon){

        //// the chain of validators is finished
        /// and there is not next validator function
        if($this->nextValidator === null){
            return true;
        }
        //// else
        /// below line means create instance of this interface in setNextValidator()
        /// and with nextValidator variable access to validate() function that make in setNextValidator()
        /// for set next validate and check it
        return  $this->nextValidator->validate($coupon);
    }
}
