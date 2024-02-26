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

    public function has(Product $product)
    {
        return $this->storage->exists($product->id);
    }

    public function get(Product $product)
    {
        return $this->storage->get($product->id);
    }

    public function addToBasket(Product $product, int $quantity)
    {
        if ($this->has($product)) {
            $quantity = $this->get($product)['quantity'] + $quantity;
        }

        $this->storage->set($product->id, ['quantity' => $quantity]);
    }


}
