<?php


namespace App\Services\Price;


use App\Services\Price\Contracts\PriceInterface;

class ShippingPrice implements PriceInterface
{
    private $price;
    const SHIPPING_COST = 20000;

    public function __construct(PriceInterface $price)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
      return  self::SHIPPING_COST;
    }

    public function getTotalPrices()
    {
        return $this->price->getTotalPrices() + $this->getPrice();
    }

    public function persianDescription()
    {
       return 'هزینه حمل';
    }

    public function getSummary()
    {
       return array_merge($this->price->getSummary(),[$this->persianDescription() => $this->getPrice()]);
    }
}
