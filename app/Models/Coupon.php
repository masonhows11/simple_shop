<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'percent',
        'limit',
        'expire_time',
        'couponable_id',
        'couponable_type'
    ];


    public function isExpired()
    {
        return Carbon::now()->isAfter(Carbon::parse($this->expire_time));
    }
}
