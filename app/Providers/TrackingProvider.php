<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Classes\Tracking;

class TrackingProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('TrackingClass', function (){
            return new Tracking;
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
