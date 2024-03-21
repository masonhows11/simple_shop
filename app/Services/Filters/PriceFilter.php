<?php


namespace App\Services\Filters;


use App\Models\Product;

class PriceFilter
{

    public function price_filter($request)
    {
        $result = null;
        if ($request->min_price && $request->max_price) {
            $result = Product::whereBetween('price', [$request->min_price, $request->max_price])->paginate(3);
        } elseif ($request->min_price) {
            $result = Product::where('price', '>=', $request->min_price)->paginate(3);
        } elseif ($request->max_price) {
            $result = Product::where('price', '<=', $request->max_price)->paginate(3);
        } else {
            $result = Product::paginate(10);
        }
        return $result->appends($request->query());
    }

}
