<?php


namespace App\Services\Price;


use App\Services\Price\Contracts\PriceInterface;

class ShippingPrice implements PriceInterface
{
    private PriceInterface $price;
    const SHIPPING_COST = 20000;

    ////  when PriceInterface $price is call
    //// basketPrice is returned then we used it
    public function __construct(PriceInterface $price)
    {
        //// in price variable we have previous price values from basketPrice
        $this->price = $price;
    }

    public function getPrice()
    {
        return self::SHIPPING_COST;
    }

    public function getTotalPrices()
    {
        //// price->getTotalPrices() is from basketPrice
        return $this->price->getTotalPrices() + $this->getPrice();
    }

    public function persianDescription()
    {
        return 'هزینه حمل';
    }

    public function getSummary()
    {
        //// merge old info into array for display in summary view
        return array_merge($this->price->getSummary(), [$this->persianDescription() => $this->getPrice()]);
    }
}
