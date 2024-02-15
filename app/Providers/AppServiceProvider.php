<?php

namespace App\Providers;

use App\Services\GIFSearcherI;
use App\Services\GIPHYClient;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(GIFSearcherI::class, GIPHYClient::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
