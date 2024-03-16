<?php

namespace App\Services\Price;

use App\Services\Basket\Basket;
use App\Services\Price\Contracts\PriceInterface;

class BasketPrice implements PriceInterface
{

    private $basket;

    public function __construct(Basket $basket)
    {
        $this->basket = $basket;
    }

    public function getPrice()
    {
        //// for return total price of basket
      return  $this->basket->subTotal();
    }

    public function getTotalPrices()
    {
        return $this->getPrice();
    }

    public function persianDescription()
    {
        return 'سبد خرید';
    }

    public function getSummary()
    {
        return [$this->persianDescription() , $this->getPrice()];
    }
}
