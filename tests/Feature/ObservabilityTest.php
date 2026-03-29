<?php

use App\Models\Role;
use App\Models\User;
use Database\Seeders\BlockedItemsTableSeeder;
use Database\Seeders\BlockedTypeTableSeeder;
use Database\Seeders\PermissionsTableSeeder;
use Database\Seeders\RolesTableSeeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Blade;
use Jeremykenedy\LaravelObservability\Health\HealthChecker;
use Jeremykenedy\LaravelObservability\Livewire\HealthDashboard;
use Jeremykenedy\LaravelObservability\Services\ProviderDetector;
use Jeremykenedy\LaravelObservability\Services\UptimeService;
use Livewire\Livewire;

beforeEach(function () {
    $this->seed(BlockedTypeTableSeeder::class);
    $this->seed(BlockedItemsTableSeeder::class);
    $this->seed(RolesTableSeeder::class);
    $this->seed(PermissionsTableSeeder::class);

    $this->user = User::factory()->create(['email_verified_at' => now()]);
    $this->user->attachRole(Role::where('slug', 'user')->first());
});

// ========================================================================
// ServiceProvider: register()
// ========================================================================

it('registers ProviderDetector as singleton', function () {
    $a = app(ProviderDetector::class);
    $b = app(ProviderDetector::class);
    expect($a)->toBe($b);
});

it('registers HealthChecker as singleton', function () {
    $a = app(HealthChecker::class);
    $b = app(HealthChecker::class);
    expect($a)->toBe($b);
});

it('registers UptimeService as singleton', function () {
    $a = app(UptimeService::class);
    $b = app(UptimeService::class);
    expect($a)->toBe($b);
});

it('merges default config', function () {
    expect(config('observability.enabled'))->toBeTrue();
    expect(config('observability.providers'))->toBeArray();
    expect(config('observability.uptime'))->toBeArray();
    expect(config('observability.health'))->toBeArray();
    expect(config('observability.context'))->toBeArray();
});

// ========================================================================
// ServiceProvider: boot() - routes
// ========================================================================

it('registers health route when enabled', function () {
    $routes = collect(app('router')->getRoutes()->getRoutes())
        ->pluck('uri')->toArray();
    expect($routes)->toContain('health');
});

it('registers providers route', function () {
    $routes = collect(app('router')->getRoutes()->getRoutes())
        ->pluck('uri')->toArray();
    expect($routes)->toContain('health/providers');
});

it('registers uptime route', function () {
    $routes = collect(app('router')->getRoutes()->getRoutes())
        ->pluck('uri')->toArray();
    expect($routes)->toContain('health/uptime');
});

// ========================================================================
// ServiceProvider: boot() - Blade directive
// ========================================================================

it('registers observabilityScripts blade directive', function () {
    $compiled = Blade::compileString('@observabilityScripts');
    expect($compiled)->toContain('getFrontendSnippets');
    expect($compiled)->toContain('LaravelObservability');
});

// ========================================================================
// ServiceProvider: boot() - commands
// ========================================================================

it('registers observability:install command', function () {
    expect(array_keys(Artisan::all()))->toContain('observability:install');
});

it('registers observability:update command', function () {
    expect(array_keys(Artisan::all()))->toContain('observability:update');
});

// ========================================================================
// Config: all 22 providers present
// ========================================================================

it('config has all 22 provider entries', function () {
    $expected = [
        'sentry', 'bugsnag', 'flare', 'rollbar', 'raygun', 'honeybadger',
        'airbrake', 'new_relic', 'datadog', 'appsignal', 'loggly',
        'logrocket', 'instabug', 'gleap', 'crashlytics', 'memfault',
        'ghost_inspector', 'lighthouse', 'link_checker', 'ssl_checker',
        'visual_tests', 'exception_notifier',
    ];

    foreach ($expected as $name) {
        expect(config('observability.providers'))->toHaveKey($name);
    }
});

// ========================================================================
// Config: each provider has required fields
// ========================================================================

it('every provider has type field with valid value', function () {
    foreach (config('observability.providers') as $name => $cfg) {
        expect($cfg)->toHaveKey('type');
        expect($cfg['type'])->toBeIn(['backend', 'frontend', 'both', 'testing']);
    }
});

it('every provider has docs field', function () {
    foreach (config('observability.providers') as $name => $cfg) {
        expect($cfg)->toHaveKey('docs');
        expect($cfg['docs'])->toBeString();
        expect(strlen($cfg['docs']))->toBeGreaterThan(5);
    }
});

it('every provider has enabled field defaulting to false', function () {
    foreach (config('observability.providers') as $name => $cfg) {
        expect($cfg['enabled'])->toBeFalse();
    }
});

// ========================================================================
// Config: uptime providers
// ========================================================================

it('config has uptimerobot and statuscake', function () {
    expect(config('observability.uptime'))->toHaveKey('uptimerobot');
    expect(config('observability.uptime'))->toHaveKey('statuscake');
    expect(config('observability.uptime.uptimerobot'))->toHaveKey('api_key');
    expect(config('observability.uptime.statuscake'))->toHaveKey('api_key');
});

// ========================================================================
// Config: health checks
// ========================================================================

it('config has health check settings', function () {
    expect(config('observability.health.enabled'))->toBeTrue();
    expect(config('observability.health.route'))->toBe('/health');
    expect(config('observability.health.checks'))->toContain('database');
    expect(config('observability.health.checks'))->toContain('cache');
    expect(config('observability.health.checks'))->toContain('storage');
    expect(config('observability.health.checks'))->toContain('queue');
});

// ========================================================================
// Config: context enrichment
// ========================================================================

it('config has context enrichment settings', function () {
    expect(config('observability.context.user'))->toBeTrue();
    expect(config('observability.context.request'))->toBeTrue();
    expect(config('observability.context.environment'))->toBeTrue();
});

// ========================================================================
// ProviderDetector: detect()
// ========================================================================

it('detect returns array', function () {
    expect((new ProviderDetector)->detect())->toBeArray();
});

it('detects testing providers without credentials', function () {
    $detected = (new ProviderDetector)->detect();
    expect($detected)->toContain('lighthouse');
    expect($detected)->toContain('ssl_checker');
    expect($detected)->toContain('visual_tests');
    expect($detected)->toContain('crashlytics');
});

it('does not detect sentry without dsn', function () {
    config(['observability.providers.sentry.dsn' => null]);
    expect((new ProviderDetector)->detect())->not->toContain('sentry');
});

it('does not detect bugsnag without api_key', function () {
    config(['observability.providers.bugsnag.api_key' => null]);
    expect((new ProviderDetector)->detect())->not->toContain('bugsnag');
});

it('does not detect flare without key', function () {
    config(['observability.providers.flare.key' => null]);
    expect((new ProviderDetector)->detect())->not->toContain('flare');
});

it('does not detect rollbar without access_token', function () {
    config(['observability.providers.rollbar.access_token' => null]);
    expect((new ProviderDetector)->detect())->not->toContain('rollbar');
});

it('does not detect logrocket without app_id', function () {
    config(['observability.providers.logrocket.app_id' => null]);
    expect((new ProviderDetector)->detect())->not->toContain('logrocket');
});

// ========================================================================
// ProviderDetector: getDetected()
// ========================================================================

it('getDetected returns empty before detect', function () {
    expect((new ProviderDetector)->getDetected())->toBeEmpty();
});

it('getDetected returns same as detect', function () {
    $d = new ProviderDetector;
    $result = $d->detect();
    expect($d->getDetected())->toBe($result);
});

// ========================================================================
// ProviderDetector: isActive()
// ========================================================================

it('isActive false for not-detected provider', function () {
    $d = new ProviderDetector;
    $d->detect();
    expect($d->isActive('sentry'))->toBeFalse();
});

it('isActive false for detected but disabled provider', function () {
    config(['observability.providers.lighthouse.enabled' => false]);
    $d = new ProviderDetector;
    $d->detect();
    expect($d->isActive('lighthouse'))->toBeFalse();
});

it('isActive true for detected and enabled provider', function () {
    config(['observability.providers.lighthouse.enabled' => true]);
    $d = new ProviderDetector;
    $d->detect();
    expect($d->isActive('lighthouse'))->toBeTrue();
});

it('isActive false for nonexistent provider', function () {
    $d = new ProviderDetector;
    $d->detect();
    expect($d->isActive('doesnotexist'))->toBeFalse();
});

// ========================================================================
// ProviderDetector: getActiveProviders()
// ========================================================================

it('getActiveProviders returns only active', function () {
    config(['observability.providers.lighthouse.enabled' => true]);
    config(['observability.providers.ssl_checker.enabled' => false]);
    $d = new ProviderDetector;
    $d->detect();
    $active = $d->getActiveProviders();
    expect($active)->toContain('lighthouse');
    expect($active)->not->toContain('ssl_checker');
});

it('getActiveProviders returns empty when nothing enabled', function () {
    // All default to false
    $d = new ProviderDetector;
    $d->detect();
    expect($d->getActiveProviders())->toBeEmpty();
});

// ========================================================================
// ProviderDetector: getProvidersByType()
// ========================================================================

it('getProvidersByType backend returns backend providers', function () {
    config(['observability.providers.sentry.enabled' => true]);
    config(['observability.providers.sentry.dsn' => 'test']);
    $d = new ProviderDetector;
    $d->detect();
    expect($d->getProvidersByType('backend'))->toContain('sentry');
});

it('getProvidersByType frontend returns frontend providers', function () {
    config(['observability.providers.logrocket.enabled' => true]);
    config(['observability.providers.logrocket.app_id' => 'test']);
    $d = new ProviderDetector;
    $d->detect();
    expect($d->getProvidersByType('frontend'))->toContain('logrocket');
    expect($d->getProvidersByType('backend'))->not->toContain('logrocket');
});

it('getProvidersByType testing returns testing providers', function () {
    config(['observability.providers.lighthouse.enabled' => true]);
    $d = new ProviderDetector;
    $d->detect();
    expect($d->getProvidersByType('testing'))->toContain('lighthouse');
});

it('getProvidersByType returns empty for nonexistent type', function () {
    expect((new ProviderDetector)->getProvidersByType('invalid'))->toBeEmpty();
});

// ========================================================================
// ProviderDetector: getFrontendSnippets()
// ========================================================================

it('getFrontendSnippets empty when nothing enabled', function () {
    expect((new ProviderDetector)->getFrontendSnippets())->toBeEmpty();
});

it('getFrontendSnippets returns snippet for logrocket', function () {
    config(['observability.providers.logrocket.enabled' => true]);
    config(['observability.providers.logrocket.app_id' => 'my-app-123']);
    $d = new ProviderDetector;
    $d->detect();
    $snippets = $d->getFrontendSnippets();
    expect($snippets)->toHaveKey('logrocket');
    expect($snippets['logrocket'])->toContain('my-app-123');
    expect($snippets['logrocket'])->not->toContain('{app_id}');
});

it('getFrontendSnippets returns snippet for gleap', function () {
    config(['observability.providers.gleap.enabled' => true]);
    config(['observability.providers.gleap.api_key' => 'gleap-key-456']);
    $d = new ProviderDetector;
    $d->detect();
    $snippets = $d->getFrontendSnippets();
    expect($snippets)->toHaveKey('gleap');
    expect($snippets['gleap'])->toContain('gleap-key-456');
});

it('getFrontendSnippets returns snippet for instabug', function () {
    config(['observability.providers.instabug.enabled' => true]);
    config(['observability.providers.instabug.token' => 'instabug-tok']);
    $d = new ProviderDetector;
    $d->detect();
    $snippets = $d->getFrontendSnippets();
    expect($snippets)->toHaveKey('instabug');
    expect($snippets['instabug'])->toContain('instabug-tok');
});

it('getFrontendSnippets excludes disabled frontend provider', function () {
    config(['observability.providers.logrocket.enabled' => false]);
    expect((new ProviderDetector)->getFrontendSnippets())->not->toHaveKey('logrocket');
});

it('getFrontendSnippets excludes backend-only providers', function () {
    config(['observability.providers.sentry.enabled' => true]);
    config(['observability.providers.sentry.dsn' => 'test']);
    $d = new ProviderDetector;
    $d->detect();
    expect($d->getFrontendSnippets())->not->toHaveKey('sentry');
});

// ========================================================================
// ProviderDetector: getUptimeProviders()
// ========================================================================

it('getUptimeProviders returns only enabled', function () {
    config(['observability.uptime.uptimerobot.enabled' => true]);
    config(['observability.uptime.statuscake.enabled' => false]);
    $result = (new ProviderDetector)->getUptimeProviders();
    expect($result)->toHaveKey('uptimerobot');
    expect($result)->not->toHaveKey('statuscake');
});

it('getUptimeProviders returns empty when none enabled', function () {
    config(['observability.uptime.uptimerobot.enabled' => false]);
    config(['observability.uptime.statuscake.enabled' => false]);
    expect((new ProviderDetector)->getUptimeProviders())->toBeEmpty();
});

it('getUptimeProviders returns both when both enabled', function () {
    config(['observability.uptime.uptimerobot.enabled' => true]);
    config(['observability.uptime.statuscake.enabled' => true]);
    $result = (new ProviderDetector)->getUptimeProviders();
    expect($result)->toHaveKey('uptimerobot');
    expect($result)->toHaveKey('statuscake');
});

// ========================================================================
// HealthChecker: run()
// ========================================================================

it('health checker runs all 4 checks', function () {
    config(['observability.health.checks' => ['database', 'cache', 'storage', 'queue']]);
    $result = (new HealthChecker)->run();
    expect($result)->toHaveKeys(['status', 'checks', 'timestamp']);
    expect($result['checks'])->toHaveKeys(['database', 'cache', 'storage', 'queue']);
});

it('health checker runs with empty checks', function () {
    config(['observability.health.checks' => []]);
    $result = (new HealthChecker)->run();
    expect($result['status'])->toBe('healthy');
    expect($result['checks'])->toBeEmpty();
});

it('health checker runs single database check', function () {
    config(['observability.health.checks' => ['database']]);
    $result = (new HealthChecker)->run();
    expect($result['checks'])->toHaveKey('database');
    expect($result['checks']['database'])->toHaveKeys(['status', 'message']);
});

it('health checker runs single cache check', function () {
    config(['observability.health.checks' => ['cache']]);
    $result = (new HealthChecker)->run();
    expect($result['checks']['cache']['status'])->toBeIn(['ok', 'error']);
});

it('health checker runs single storage check', function () {
    config(['observability.health.checks' => ['storage']]);
    $result = (new HealthChecker)->run();
    expect($result['checks']['storage']['status'])->toBeIn(['ok', 'error']);
});

it('health checker runs single queue check', function () {
    config(['observability.health.checks' => ['queue']]);
    $result = (new HealthChecker)->run();
    expect($result['checks']['queue']['status'])->toBe('ok');
    expect($result['checks']['queue']['message'])->toContain('Queue driver');
});

it('health checker handles unknown check type', function () {
    config(['observability.health.checks' => ['nonexistent']]);
    $result = (new HealthChecker)->run();
    expect($result['checks']['nonexistent']['status'])->toBe('unknown');
});

it('health checker returns healthy when all pass', function () {
    config(['observability.health.checks' => ['cache', 'queue']]);
    $result = (new HealthChecker)->run();
    expect($result['status'])->toBe('healthy');
});

it('health checker timestamp is ISO format string', function () {
    $result = (new HealthChecker)->run();
    expect($result['timestamp'])->toBeString();
    expect(strlen($result['timestamp']))->toBeGreaterThan(15);
});

// ========================================================================
// UptimeService
// ========================================================================

it('getUptimeRobotStatus returns null without api key', function () {
    config(['observability.uptime.uptimerobot.api_key' => null]);
    expect((new UptimeService)->getUptimeRobotStatus())->toBeNull();
});

it('getUptimeRobotStatus returns null with empty api key', function () {
    config(['observability.uptime.uptimerobot.api_key' => '']);
    expect((new UptimeService)->getUptimeRobotStatus())->toBeNull();
});

it('getStatusCakeStatus returns null without api key', function () {
    config(['observability.uptime.statuscake.api_key' => null]);
    expect((new UptimeService)->getStatusCakeStatus())->toBeNull();
});

it('getStatusCakeStatus returns null with empty api key', function () {
    config(['observability.uptime.statuscake.api_key' => '']);
    expect((new UptimeService)->getStatusCakeStatus())->toBeNull();
});

// ========================================================================
// HTTP: GET /health
// ========================================================================

it('GET /health returns 200 with json structure', function () {
    $this->getJson('/health')
        ->assertOk()
        ->assertJsonStructure(['status', 'checks', 'timestamp']);
});

it('GET /health includes database check', function () {
    $this->getJson('/health')
        ->assertOk()
        ->assertJsonStructure(['checks' => ['database' => ['status', 'message']]]);
});

it('GET /health includes cache check', function () {
    $this->getJson('/health')
        ->assertOk()
        ->assertJsonStructure(['checks' => ['cache' => ['status', 'message']]]);
});

it('GET /health includes storage check', function () {
    $this->getJson('/health')
        ->assertOk()
        ->assertJsonStructure(['checks' => ['storage' => ['status', 'message']]]);
});

it('GET /health includes queue check', function () {
    $this->getJson('/health')
        ->assertOk()
        ->assertJsonStructure(['checks' => ['queue' => ['status', 'message']]]);
});

it('GET /health status is healthy or degraded', function () {
    $response = $this->getJson('/health')->assertOk();
    expect($response->json('status'))->toBeIn(['healthy', 'degraded']);
});

// ========================================================================
// HTTP: GET /health/providers
// ========================================================================

it('GET /health/providers returns categorized lists', function () {
    $this->getJson('/health/providers')
        ->assertOk()
        ->assertJsonStructure(['detected', 'active', 'backend', 'frontend', 'testing', 'uptime']);
});

it('GET /health/providers detected includes testing providers', function () {
    $response = $this->getJson('/health/providers')->assertOk();
    expect($response->json('detected'))->toContain('lighthouse');
});

it('GET /health/providers active is empty by default', function () {
    $response = $this->getJson('/health/providers')->assertOk();
    expect($response->json('active'))->toBeEmpty();
});

// ========================================================================
// HTTP: GET /health/uptime
// ========================================================================

it('GET /health/uptime requires auth', function () {
    $this->getJson('/health/uptime')->assertUnauthorized();
});

it('GET /health/uptime returns json for authenticated user', function () {
    $this->actingAs($this->user)->getJson('/health/uptime')->assertOk();
});

// ========================================================================
// Cross-framework: CSS
// ========================================================================

it('health works across all 3 CSS frameworks', function () {
    foreach (['tailwind', 'bootstrap5', 'bootstrap4'] as $fw) {
        config(['ui-kit.css_framework' => $fw]);
        $this->getJson('/health')->assertOk();
        $this->getJson('/health/providers')->assertOk();
    }
});

// ========================================================================
// Cross-framework: Frontend
// ========================================================================

it('health works across all 5 frontend frameworks', function () {
    foreach (['blade', 'livewire', 'vue', 'react', 'svelte'] as $fe) {
        config(['ui-kit.frontend' => $fe]);
        $this->getJson('/health')->assertOk();
    }
});

// ========================================================================
// Cross-framework: CSS x Frontend (15 combinations)
// ========================================================================

it('health endpoint works across all 15 css x frontend combinations', function () {
    foreach (['tailwind', 'bootstrap5', 'bootstrap4'] as $css) {
        foreach (['blade', 'livewire', 'vue', 'react', 'svelte'] as $fe) {
            config(['ui-kit.css_framework' => $css, 'ui-kit.frontend' => $fe]);
            $this->getJson('/health')->assertOk();
        }
    }
});

it('providers endpoint works across all 15 combinations', function () {
    foreach (['tailwind', 'bootstrap5', 'bootstrap4'] as $css) {
        foreach (['blade', 'livewire', 'vue', 'react', 'svelte'] as $fe) {
            config(['ui-kit.css_framework' => $css, 'ui-kit.frontend' => $fe]);
            $this->getJson('/health/providers')->assertOk();
        }
    }
});

// ========================================================================
// HTTP: GET /health/dashboard (frontend view)
// ========================================================================

it('GET /health/dashboard requires auth', function () {
    $this->get('/health/dashboard')->assertRedirect('/login');
});

it('GET /health/dashboard renders for authenticated user', function () {
    $this->actingAs($this->user)->get('/health/dashboard')->assertOk();
});

it('dashboard renders across all 3 CSS frameworks', function () {
    foreach (['tailwind', 'bootstrap5', 'bootstrap4'] as $fw) {
        config(['ui-kit.css_framework' => $fw]);
        $this->actingAs($this->user)->get('/health/dashboard')->assertOk();
    }
});

it('dashboard renders across all 5 frontend frameworks', function () {
    foreach (['blade', 'livewire', 'vue', 'react', 'svelte'] as $fe) {
        config(['ui-kit.frontend' => $fe]);
        $this->actingAs($this->user)->get('/health/dashboard')->assertOk();
    }
});

it('dashboard renders across all 15 css x frontend combinations', function () {
    foreach (['tailwind', 'bootstrap5', 'bootstrap4'] as $css) {
        foreach (['blade', 'livewire', 'vue', 'react', 'svelte'] as $fe) {
            config(['ui-kit.css_framework' => $css, 'ui-kit.frontend' => $fe]);
            $this->actingAs($this->user)->get('/health/dashboard')->assertOk();
        }
    }
});

// ========================================================================
// Livewire: HealthDashboard component
// ========================================================================

it('HealthDashboard livewire component renders', function () {
    Livewire::actingAs($this->user)
        ->test(HealthDashboard::class)
        ->assertOk();
});

it('HealthDashboard livewire has health data', function () {
    Livewire::actingAs($this->user)
        ->test(HealthDashboard::class)
        ->assertSet('healthData.status', 'healthy');
});

it('HealthDashboard livewire refresh works', function () {
    Livewire::actingAs($this->user)
        ->test(HealthDashboard::class)
        ->call('refresh')
        ->assertOk();
});

it('HealthDashboard livewire renders across all 3 CSS frameworks', function () {
    foreach (['tailwind', 'bootstrap5', 'bootstrap4'] as $fw) {
        config(['ui-kit.css_framework' => $fw]);
        Livewire::actingAs($this->user)
            ->test(HealthDashboard::class)
            ->assertOk();
    }
});

// ========================================================================
// Commands: switch
// ========================================================================

it('observability:switch command is registered', function () {
    expect(array_keys(Artisan::all()))->toContain('observability:switch');
});

it('observability:switch runs with css option', function () {
    $this->artisan('observability:switch --css=tailwind')->assertSuccessful();
});

it('observability:switch runs with frontend option', function () {
    $this->artisan('observability:switch --frontend=blade')->assertSuccessful();
});

it('observability:switch fails without options', function () {
    $this->artisan('observability:switch')->assertFailed();
});

// ========================================================================
// Structural: frontend directories exist
// ========================================================================

it('observability has tailwind blade views', function () {
    expect(is_dir(base_path('vendor/jeremykenedy/laravel-observability/resources/views/tailwind/blade')))->toBeTrue();
    expect(count(glob(base_path('vendor/jeremykenedy/laravel-observability/resources/views/tailwind/blade/*.blade.php'))))->toBeGreaterThan(0);
});

it('observability has bootstrap5 blade views', function () {
    expect(is_dir(base_path('vendor/jeremykenedy/laravel-observability/resources/views/bootstrap5/blade')))->toBeTrue();
    expect(count(glob(base_path('vendor/jeremykenedy/laravel-observability/resources/views/bootstrap5/blade/*.blade.php'))))->toBeGreaterThan(0);
});

it('observability has bootstrap4 blade views', function () {
    expect(is_dir(base_path('vendor/jeremykenedy/laravel-observability/resources/views/bootstrap4/blade')))->toBeTrue();
    expect(count(glob(base_path('vendor/jeremykenedy/laravel-observability/resources/views/bootstrap4/blade/*.blade.php'))))->toBeGreaterThan(0);
});

it('observability has livewire views', function () {
    expect(is_dir(base_path('vendor/jeremykenedy/laravel-observability/resources/views/livewire')))->toBeTrue();
    expect(count(glob(base_path('vendor/jeremykenedy/laravel-observability/resources/views/livewire/*.blade.php'))))->toBeGreaterThan(0);
});

it('observability has vue page components', function () {
    expect(is_dir(base_path('vendor/jeremykenedy/laravel-observability/resources/js/vue/pages')))->toBeTrue();
    expect(count(glob(base_path('vendor/jeremykenedy/laravel-observability/resources/js/vue/pages/*.vue'))))->toBeGreaterThan(0);
});

it('observability has react page components', function () {
    expect(is_dir(base_path('vendor/jeremykenedy/laravel-observability/resources/js/react/pages')))->toBeTrue();
    expect(count(glob(base_path('vendor/jeremykenedy/laravel-observability/resources/js/react/pages/*.jsx'))))->toBeGreaterThan(0);
});

it('observability has svelte page components', function () {
    expect(is_dir(base_path('vendor/jeremykenedy/laravel-observability/resources/js/svelte/pages')))->toBeTrue();
    expect(count(glob(base_path('vendor/jeremykenedy/laravel-observability/resources/js/svelte/pages/*.svelte'))))->toBeGreaterThan(0);
});

it('observability has equal vue/react/svelte component counts', function () {
    $base = base_path('vendor/jeremykenedy/laravel-observability/resources/js');
    $vue = count(glob($base.'/vue/pages/*.vue'));
    $react = count(glob($base.'/react/pages/*.jsx'));
    $svelte = count(glob($base.'/svelte/pages/*.svelte'));
    expect($vue)->toBe($react);
    expect($vue)->toBe($svelte);
});
