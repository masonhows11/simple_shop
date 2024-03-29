<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TestServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        dd('hello test app service provider');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
