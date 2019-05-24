<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GuidProvider extends ServiceProvider
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
        $this->app->bind('Guid', function(){
            return new \App\Helpers\Guid\Realisation\Guid;
        });
    }
}
