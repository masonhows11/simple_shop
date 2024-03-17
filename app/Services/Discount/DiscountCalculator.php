<?php


namespace App\Services\Discount;


use App\Models\Coupon;

class DiscountCalculator
{

    public function discountAmount(Coupon $coupon, int $amount)
    {

        $discountAmount = (int)(($coupon->percent / 100) * $amount);
        return $this->isExceeded($discountAmount,$coupon->limit) ? $coupon->limit  : $discountAmount;

    }

    private function isExceeded(int $amount, int $limit)
    {
        return $amount > $limit;
    }
}
