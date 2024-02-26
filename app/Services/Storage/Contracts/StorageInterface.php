<?php


namespace App\Services\Storage\Contracts;


interface StorageInterface
{

    public function get($index);

    public function set($index,$value);

    public function all();

    public function exists($index);

    public function remove($index);

    public function clearAll();


}
