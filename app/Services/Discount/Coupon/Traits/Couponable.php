<?php


namespace App\Services\Discount\Coupon\Traits;


use App\Models\Coupon;

trait Couponable
{

    public function coupons()
    {
        return $this->morphMany(Coupon::class,'couponable');
    }

}
