<?php


namespace App\Services\Discount;


use App\Services\Price\BasketPrice;

class DiscountManager
{

    private BasketPrice $basketPrice;
    public function __construct(BasketPrice $basketPrice)
    {
        $this->basketPrice = $basketPrice;
    }


    public function calculateUserDiscount()
    {
        return 10000;
    }

}
