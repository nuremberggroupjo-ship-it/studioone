<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // Force HTTPS URLs in production or when behind a proxy
        if (config('app.env') === 'production' || request()->isSecure() || request()->header('X-Forwarded-Proto') === 'https') {
            URL::forceScheme('https');
        }
        
        // Additional proxy handling for platforms like Render
        if (request()->header('X-Forwarded-Proto') === 'https') {
            request()->server->set('HTTPS', 'on');
        }
    }
}
