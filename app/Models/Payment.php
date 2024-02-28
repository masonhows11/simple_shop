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
}
