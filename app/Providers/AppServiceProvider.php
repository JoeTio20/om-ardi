<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS di production (Railway, dll)
    if (config('app.env') === 'production' || 
        str_contains(request()->getHttpHost(), 'railway') ||
        str_contains(request()->getHttpHost(), 'ngrok')) {
        \URL::forceScheme('https');//
    }
}
}