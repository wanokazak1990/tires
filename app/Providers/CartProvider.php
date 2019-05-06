<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CartProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //return new App\Helpers\Cart\Realisation\Cart;
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Cart', function(){
            return new \App\Helpers\Cart\Realisation\Cart;
        });
    }
}
