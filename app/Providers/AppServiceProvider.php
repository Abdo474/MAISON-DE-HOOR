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
        if (app()->environment('production')) {
            $appUrl = config('app.url');

            if (is_string($appUrl) && $appUrl !== '') {
                if (!str_starts_with($appUrl, 'http://') && !str_starts_with($appUrl, 'https://')) {
                    $appUrl = 'https://' . $appUrl;
                }

                URL::forceRootUrl($appUrl);
            }

            URL::forceScheme('https');
        }
    }
}
