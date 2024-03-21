<?php


namespace App\Services\Filters;


use Illuminate\Support\Facades\DB;

class TypeFilter
{

    public function free_products()
    {
        return DB::table('products')->where('type','=',0)->paginate(10);
    }

    public function cash_products()
    {
        return DB::table('products')->where('type','=',1)->paginate(10);
    }
}
