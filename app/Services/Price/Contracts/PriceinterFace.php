<?php

namespace App\Services\Price\Contracts;



interface PriceInterface
{


        public function getPrice();
        public function getTotalPrices();
        public function persianDescription();
        public function getSummary();
}
