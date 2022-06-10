<?php

namespace App\Providers;

use App\Services\GoogleClient;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('google', function ($app) {
            return new GoogleClient($app['config']['google']);
        });
    }
}
