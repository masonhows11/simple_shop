<?php


namespace App\Services\Discount;


use App\Services\Price\BasketPrice;

class DiscountManager
{

    private BasketPrice $basketPrice;
    private DiscountCalculator $calculator;

    /**
     * DiscountManager constructor.
     * @param BasketPrice $basketPrice
     * @param DiscountCalculator $calculator
     */
    public function __construct(BasketPrice $basketPrice, DiscountCalculator $calculator)
    {
        $this->basketPrice = $basketPrice;
        $this->calculator = $calculator;
    }


    public function calculateUserDiscount()
    {
       if(!session()->has('coupon')) return 0 ;
       return $this->calculator->discountAmount(session()->get('coupon'),$this->basketPrice->getTotalPrices());
    }

}
