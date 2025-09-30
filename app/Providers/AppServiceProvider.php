<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
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
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // Mock the email by using env MAIL_MOCK_TO
        if (env('MAIL_MOCK')) {
            Mail::alwaysTo(env('MAIL_MOCK_TO'));
        }

        //Paginator::useBootstrapThree();
        Paginator::useBootstrap();
        Schema::defaultStringLength(191);
    }
}
