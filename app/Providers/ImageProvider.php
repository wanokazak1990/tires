<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ImageProvider extends ServiceProvider
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
        $this->app->bind('Image', function(){
            return new \App\Helpers\Image\Realisation\Image;
        });
    }
}
