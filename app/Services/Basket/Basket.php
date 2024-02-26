<?php


namespace App\Services\Basket;


use App\Models\Product;
use App\Services\Storage\Contracts\StorageInterface;

class Basket
{

    private $storage;

    public function __construct(StorageInterface $storage)
    {
            $this->storage = $storage;
    }

    public function addToBasket(Product $product,int $quantity)
    {
            $this->storage->set($product->id,['quantity' => $quantity ]);
    }




}
