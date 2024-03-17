<?php


namespace App\Services\Price;


use App\Services\Discount\DiscountManager;
use App\Services\Price\Contracts\PriceInterface;

class DiscountPrice implements PriceInterface
{

    private PriceInterface $price;
    private DiscountManager $discountManager;
    public function __construct(PriceInterface $price,DiscountManager $discountManager)
    {
        $this->price = $price;
        $this->discountManager = $discountManager;
    }

    public function getPrice()
    {
       return $this->discountManager->calculateUserDiscount();
    }

    public function getTotalPrices()
    {
        //// for calculate the final price when we use the coupon
        return $this->price->getTotalPrices() - $this->getPrice();
    }

    public function persianDescription()
    {
        return 'میزان تخفیف';
    }

    public function getSummary()
    {
        //// merge old info into array for display in summary view
        return array_merge($this->price->getSummary(), [$this->persianDescription() => $this->getPrice()]);
    }
}
