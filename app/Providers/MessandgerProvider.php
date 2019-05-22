<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MessandgerProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Messandger', function(){
            return new \App\Helpers\Messandger\Realisation\Messandger;
        });
    }
}
