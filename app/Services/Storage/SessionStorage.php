<?php


namespace App\Services\Storage;


use App\Services\Storage\Contracts\StorageInterface;
use Countable;

class SessionStorage implements StorageInterface, Countable
{

    private $basket;

    public function __construct($basket = 'default')
    {
        $this->basket = $basket;
    }

    public function get($index)
    {
        //// get item store in session
        return session()->get($this->basket . '.' . $index);
    }

    public function set($index, $value)
    {
        //// storage in session like array
        /// items with id & value 4
        /// items is array
        // return session()->put('items.id','4');
        return session()->put($this->basket . '.' . $index , $value);
    }

    public function all()
    {
        //// get all item store in session name like basket
        return session()->get($this->basket);
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
