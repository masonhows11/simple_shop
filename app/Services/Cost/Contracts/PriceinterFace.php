<?php

namespace App\Services\Cost\Contracts;



interface PriceInterface
{


        public function getPrice();
        public function getTotalPrices();
        public function persianDescription();
        public function getSummary();
}
