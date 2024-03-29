<?php

namespace App\Providers;

use App\Services\Basket\Basket;
use App\Services\Discount\DiscountManager;
use App\Services\Price\BasketPrice;
use App\Services\Price\Contracts\PriceInterface;
use App\Services\Price\DiscountPrice;
use App\Services\Price\ShippingPrice;
use App\Services\Storage\Contracts\StorageInterface;
use App\Services\Storage\SessionStorage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        // dd('hello app service provider');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // in this code when we call  StorageInterface interface return to us
        // new instance  SessionStorage class with construct parameter like 'cart'
        $this->app->bind(StorageInterface::class, function ($app) {
            return new SessionStorage('cart');
        });


        // in this code when we call  PriceInterface interface return to us
        // new instance  BasketPrice class with construct parameter like 'cart'
        $this->app->bind(PriceInterface::class, function ($app) {
            $basketPrice = new BasketPrice($app->make(Basket::class));
            $shippingPrice = new ShippingPrice($basketPrice);
            return $discountPrice = new DiscountPrice($shippingPrice, app()->make(DiscountManager::class));
        });
    }
}
