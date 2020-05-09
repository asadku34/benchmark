<?php

namespace Asad\Bench;

use Illuminate\Support\ServiceProvider;

class BenchmarkServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Register the main class to use with the facade
        $this->app->singleton('benchmark', function () {
            return new Benchmark;
        });
    }
}
