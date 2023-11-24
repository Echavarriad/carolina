<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ShopServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('cart', function ($app){
            return new \App\Shop\Cart(
                $app->make('\App\Models\Cart'),
                $app->make('\App\Models\CartItem'),
                $app->make('\App\Models\Product'),
                $app->make('\App\Models\Variation')
            );
        });

        $this->app->singleton('favorite', function ($app){
            return new \App\Shop\Favorite(
                $app->make('\App\Models\Favorite')
            );
        });

        $this->app->singleton('siigo', function ($app){
            return new \App\Api\Siigo();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
