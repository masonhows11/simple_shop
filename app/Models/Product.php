<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'image',
        'quantity'
    ];


    public function hasStock(int $quantity)
    {
        return $this->quantity >= $quantity;
    }

    public function orders()
    {
        return $this->BelongsToMany(Order::class);
    }


    public function decrementStock(int $count)
    {
        // $this refer to this current model
        // for decrement count of product
        //  a user has buy
        return $this->decrement('quantity',$count);
    }
}
