<?php

namespace Kaishiyoku\LaravelRecharts;

use Illuminate\Support\ServiceProvider;

class LaravelRechartsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/Views', 'recharts');

        $this->publishes([
            __DIR__ . '/../js/dist/' => public_path('vendor/recharts/'),
        ], 'assets');

        $this->publishes([
            __DIR__ . '/Views' => resource_path('views/vendor/recharts'),
        ], 'views');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
