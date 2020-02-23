<?php

namespace Dcblogdev\Eventbrite;

use Illuminate\Support\ServiceProvider;

class EventbriteServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {

            // Publishing the configuration file.
            $this->publishes([
                __DIR__.'/../config/eventbrite.php' => config_path('eventbrite.php'),
            ], 'config');
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/eventbrite.php', 'eventbrite');

        // Register the service the package provides.
        $this->app->singleton('eventbrite', function ($app) {
            return new Eventbrite;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['eventbrite'];
    }
}
