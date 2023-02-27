<?php

namespace App\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class LocalEnvironmentServiceProvider extends ServiceProvider
{
    /**
     * List of Local Environment Providers.
     *
     * @var array
     */
    protected $localProviders = [
        \Barryvdh\Debugbar\ServiceProvider::class,
    ];

    /**
     * List of only Local Environment Facade Aliases.
     *
     * @var array
     */
    protected $facadeAliases = [
        'Debugbar' => \Barryvdh\Debugbar\Facade::class,
    ];

    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        if (\App::environment(config('debugbar.enabled_environment'))) {
            $this->registerServiceProviders();
            $this->registerFacadeAliases();
        }
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Load local service providers.
     */
    protected function registerServiceProviders(): void
    {
        foreach ($this->localProviders as $provider) {
            $this->app->register($provider);
        }
    }

    /**
     * Load additional Aliases.
     */
    public function registerFacadeAliases(): void
    {
        $loader = AliasLoader::getInstance();
        foreach ($this->facadeAliases as $alias => $facade) {
            $loader->alias($alias, $facade);
        }
    }
}
