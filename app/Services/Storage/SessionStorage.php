<?php


namespace App\Services\Storage;


use App\Services\Storage\Contracts\StorageInterface;
use Countable;

class SessionStorage implements StorageInterface , Countable
{

    private $basket;

    public function __construct($basket = 'default')
    {
        $this->basket = $basket;
    }

    public function get($index)
    {

    }

    public function set($index, $value)
    {
        return session()->put('items.id','4');
    }

    public function all()
    {

    }

    public function exists($index)
    {

    }

    public function remove($index)
    {

    }

    public function clearAll()
    {

    }

    // for count the value of item
    public function count()
    {

    }
}
