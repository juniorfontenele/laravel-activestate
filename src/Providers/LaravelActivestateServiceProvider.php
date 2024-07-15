<?php

namespace JuniorFontenele\LaravelActivestate\Providers;

use Illuminate\Support\ServiceProvider;

class LaravelActivestateServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/activestate.php',
            'activestate'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/activestate.php' => config_path('activestate.php'),
            ], 'config');
        }
    }
}
