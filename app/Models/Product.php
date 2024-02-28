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
    /**
     * @var mixed
     */
    // private $quantity;

    public function hasStock(int $quantity)
    {
        return $this->quantity >= $quantity;
    }

    public function orders()
    {
        return $this->BelongsToMany(Order::class);
    }
}
