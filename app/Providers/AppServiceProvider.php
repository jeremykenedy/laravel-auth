<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        if (env('MAIL_MOCK')) {
            Mail::alwaysTo(env('MAIL_MOCK_TO'));
        }

        Paginator::useBootstrap();
        Schema::defaultStringLength(191);

        // Register HTML macros (icon_link, image_link, icon_btn, show_username)
        require base_path('app/Logic/Macros/HtmlMacros.php');
    }
}
