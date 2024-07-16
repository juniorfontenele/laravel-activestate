<?php

namespace JuniorFontenele\LaravelActivestate\Providers;

use Illuminate\Database\Schema\Blueprint;
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

        Blueprint::macro('activeState', function () {
            return $this->boolean(config('activestate.column_name'))->default(true);
        });
    }
}
