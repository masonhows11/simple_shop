<?php


namespace App\Services\Filters;


use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderbyFilter
{

    public function newest()
    {
            return DB::table('products')->orderBy('created_at','desc')->paginate(10);
    }

    public function most_visited()
    {
        return DB::table('products')->orderBy('views','desc')->paginate(10);
    }

    public function low_to_high()
    {
        return DB::table('products')->orderBy('price','asc')->paginate(10);
    }

    public function high_to_low()
    {
        return DB::table('products')->orderBy('price','desc')->paginate(10);
    }

    public function best_selling(){
        return DB::table('products')->orderBy('sale','desc')->paginate(10);
    }

}
