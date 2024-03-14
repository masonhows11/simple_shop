<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'method',
        'gateway',
        'bank_ref_number',
        'amount',
        'status'
    ];

    //  set default values for model attributes / properties
    protected $attributes = [
        'status' => 0
    ];


    public function isOnline()
    {
        return $this->method == 'online';
    }


    // for confirm the order  and fill the require field in database
    public function confirm(string $refNum, string $gateway = null)
    {
        // below code means
        // refer to property of payment model and save new value
        $this->bank_ref_number = $refNum;
        $this->gateway = $gateway;
        // 0 on process
        // 1 paid
        // 2 unpaid
        $this->status = 1;
        $this->save();

    }
}
