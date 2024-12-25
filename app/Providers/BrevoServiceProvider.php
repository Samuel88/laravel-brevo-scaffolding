<?php

namespace App\Providers;

use App\Services\BrevoService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

use Config;

class BrevoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(BrevoService::class, function (Application $app) {
            return new BrevoService(
                Config::get('app.brevo.api_key'),
                intval(Config::get('app.brevo.list_id'))
            );
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
