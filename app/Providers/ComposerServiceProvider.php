<?php

namespace App\Providers;

use App\Http\ViewComposers\ThemeComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     */
    public function boot(): void
    {
        View::composer(
            '*',
            ThemeComposer::class
        );
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        //
    }
}
