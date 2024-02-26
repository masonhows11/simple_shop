<?php

namespace App\Providers;

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
    }
}
