<?php


namespace App\Services\Basket;


use App\Exceptions\QuantityExceededException;
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
        $this->update($product, $quantity);
    }

    public function update(Product $product, int $quantity)
    {
        if (!$product->hasStock($quantity)) {
            throw new QuantityExceededException();
        }
        if($quantity == 0){
          return   $this->storage->remove($product->id);
        }
        $this->storage->set($product->id, ['quantity' => $quantity]);
    }

    public function itemCount()
    {
        return $this->storage->count();
    }


    public function all()
    {

        $products = Product::find(array_keys($this->storage->all()));
        foreach ($products as $product) {
            //// $this-> is refer to current session basket
            ///  add attr name stock into product attr for show
            /// quantity in basket for each product
            $product->stock = $this->get($product)['quantity'];
        }
        return $products;
    }


    public function subTotal()
    {
        $total = 0;
        //// $this-> is refer to current session basket
        foreach ($this->all() as $item) {
            $total += $item->price * $item->stock;
        }

        return $total;
    }


}
