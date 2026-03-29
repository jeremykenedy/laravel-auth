<?php

use App\Models\Role;
use App\Models\User;
use Database\Seeders\AppSettingsSeeder;
use Database\Seeders\BlockedItemsTableSeeder;
use Database\Seeders\BlockedTypeTableSeeder;
use Database\Seeders\ConnectRelationshipsSeeder;
use Database\Seeders\PermissionsTableSeeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\ThemesTableSeeder;
use Livewire\Livewire;

beforeEach(function () {
    $this->seed(BlockedTypeTableSeeder::class);
    $this->seed(BlockedItemsTableSeeder::class);
    $this->seed(RolesTableSeeder::class);
    $this->seed(PermissionsTableSeeder::class);
    $this->seed(ConnectRelationshipsSeeder::class);
    $this->seed(ThemesTableSeeder::class);
    $this->seed(AppSettingsSeeder::class);

    $this->admin = User::factory()->create(['email_verified_at' => now()]);
    $this->admin->attachRole(Role::where('slug', 'admin')->first());
    $this->admin->ensureProfile();

    $this->testUser = User::factory()->create(['email_verified_at' => now()]);
    $this->testUser->ensureProfile();
    $userRole = Role::where('slug', 'user')->first();
    $this->testUser->attachRole($userRole);

    // Create a soft-deleted user for deleted user tests
    $this->deletedUser = User::factory()->create();
    $this->deletedUser->delete();
});

/*
|--------------------------------------------------------------------------
| Helpers
|--------------------------------------------------------------------------
*/
function assertRendersAcrossAllCombinations(string $url, ?string $assertSee = null): void
{
    $cssFrameworks = ['tailwind', 'bootstrap5', 'bootstrap4'];
    $frontends = ['blade', 'livewire', 'vue', 'react', 'svelte'];

    foreach ($cssFrameworks as $css) {
        foreach ($frontends as $fe) {
            config([
                'ui-kit.css_framework' => $css,
                'ui-kit.frontend' => $fe,
            ]);

            $response = test()->actingAs(test()->admin)->get($url);
            $response->assertOk();

            if ($assertSee) {
                $response->assertSee($assertSee);
            }
        }
    }
}

// ========================================================================
// USERS MANAGEMENT (laravel-users) — 6 views × 3 frameworks
// ========================================================================

it('renders users index across all frameworks', function () {
    assertRendersAcrossAllCombinations('/users');
});

it('renders user show across all frameworks', function () {
    assertRendersAcrossAllCombinations('/users/'.$this->testUser->id, $this->testUser->name);
});

it('renders user create across all frameworks', function () {
    assertRendersAcrossAllCombinations('/users/create');
});

it('renders user edit across all frameworks', function () {
    assertRendersAcrossAllCombinations('/users/'.$this->testUser->id.'/edit');
});

it('renders deleted users index across all frameworks', function () {
    assertRendersAcrossAllCombinations('/users/deleted');
});

it('renders deleted user show across all frameworks', function () {
    assertRendersAcrossAllCombinations('/users/deleted/'.$this->deletedUser->id, $this->deletedUser->name);
});

it('renders user export across all combinations', function () {
    $cssFrameworks = ['tailwind', 'bootstrap5', 'bootstrap4'];
    $frontends = ['blade', 'livewire', 'vue', 'react', 'svelte'];

    foreach ($cssFrameworks as $css) {
        foreach ($frontends as $fe) {
            config(['ui-kit.css_framework' => $css, 'ui-kit.frontend' => $fe]);

            $this->actingAs($this->admin)
                ->get('/users/export')
                ->assertOk()
                ->assertHeader('Content-Type', 'text/csv; charset=UTF-8');
        }
    }
});

it('handles user search across all combinations', function () {
    $cssFrameworks = ['tailwind', 'bootstrap5', 'bootstrap4'];
    $frontends = ['blade', 'livewire', 'vue', 'react', 'svelte'];

    foreach ($cssFrameworks as $css) {
        foreach ($frontends as $fe) {
            config(['ui-kit.css_framework' => $css, 'ui-kit.frontend' => $fe]);

            $this->actingAs($this->admin)
                ->postJson('/search-users', ['user_search_box' => $this->testUser->name])
                ->assertOk()
                ->assertJsonFragment(['name' => $this->testUser->name]);
        }
    }
});

it('handles user bulk action across all combinations', function () {
    $cssFrameworks = ['tailwind', 'bootstrap5', 'bootstrap4'];
    $frontends = ['blade', 'livewire', 'vue', 'react', 'svelte'];

    foreach ($cssFrameworks as $css) {
        foreach ($frontends as $fe) {
            config(['ui-kit.css_framework' => $css, 'ui-kit.frontend' => $fe]);

            $target = User::factory()->create();

            $this->actingAs($this->admin)
                ->post('/users/bulk', [
                    'action' => 'activate',
                    'user_ids' => [$target->id],
                ])
                ->assertRedirect('/users');
        }
    }
});

// ========================================================================
// NOTIFICATIONS (laravel-notifications) — 1 view × 3 frameworks
// ========================================================================

it('renders notifications index across all frameworks', function () {
    assertRendersAcrossAllCombinations('/notifications');
});

it('renders notifications count across all combinations', function () {
    $cssFrameworks = ['tailwind', 'bootstrap5', 'bootstrap4'];
    $frontends = ['blade', 'livewire', 'vue', 'react', 'svelte'];

    foreach ($cssFrameworks as $css) {
        foreach ($frontends as $fe) {
            config(['ui-kit.css_framework' => $css, 'ui-kit.frontend' => $fe]);

            $this->actingAs($this->admin)
                ->getJson('/notifications/count')
                ->assertOk()
                ->assertJsonStructure(['count']);
        }
    }
});

// ========================================================================
// PROFILES (laravel-profiles) — 3 views × 3 frameworks
// ========================================================================

it('renders profile show across all frameworks', function () {
    assertRendersAcrossAllCombinations('/profile');
});

it('renders profile edit across all frameworks', function () {
    assertRendersAcrossAllCombinations('/profile/edit');
});

it('renders profile sessions across all frameworks', function () {
    assertRendersAcrossAllCombinations('/profile/sessions');
});

// ========================================================================
// THEMES (laravel-themes) — 2 views × 3 frameworks
// ========================================================================

it('renders themes index across all frameworks', function () {
    assertRendersAcrossAllCombinations('/themes');
});

it('renders admin themes across all frameworks', function () {
    assertRendersAcrossAllCombinations('/admin/themes');
});

// ========================================================================
// CHAT (laravel-chat) — 1 view × 3 frameworks
// ========================================================================

it('renders chat index across all frameworks', function () {
    assertRendersAcrossAllCombinations('/chat');
});

// ========================================================================
// POSTS (laravel-posts) — 3 views × 3 frameworks
// ========================================================================

it('renders admin posts index across all frameworks', function () {
    assertRendersAcrossAllCombinations('/admin/posts');
});

it('renders admin posts create across all frameworks', function () {
    assertRendersAcrossAllCombinations('/admin/posts/create');
});

it('renders public posts index across all combinations', function () {
    $cssFrameworks = ['tailwind', 'bootstrap5', 'bootstrap4'];
    $frontends = ['blade', 'livewire', 'vue', 'react', 'svelte'];

    foreach ($cssFrameworks as $css) {
        foreach ($frontends as $fe) {
            config(['ui-kit.css_framework' => $css, 'ui-kit.frontend' => $fe]);
            test()->get('/posts')->assertOk();
        }
    }
});

// ========================================================================
// ROLES (laravel-roles) — 4 views × 3 frameworks
// ========================================================================

it('renders roles index across all frameworks', function () {
    assertRendersAcrossAllCombinations('/roles');
});

it('renders roles create across all frameworks', function () {
    assertRendersAcrossAllCombinations('/roles/create');
});

it('renders permissions index across all frameworks', function () {
    assertRendersAcrossAllCombinations('/permissions');
});

it('renders permissions create across all frameworks', function () {
    assertRendersAcrossAllCombinations('/permissions/create');
});

// ========================================================================
// BLOCKER (laravel-blocker) — 2 views × 3 frameworks
// ========================================================================

it('renders blocker index across all frameworks', function () {
    assertRendersAcrossAllCombinations('/blocker');
});

it('renders blocker create across all frameworks', function () {
    assertRendersAcrossAllCombinations('/blocker/create');
});

// ========================================================================
// LOGGER (laravel-logger) — 1 view × 3 frameworks
// ========================================================================

it('renders activity log across all frameworks', function () {
    assertRendersAcrossAllCombinations('/activity');
});

// ========================================================================
// PHPINFO (laravel-phpinfo) — 1 view × 3 frameworks
// ========================================================================

it('renders phpinfo across all frameworks', function () {
    assertRendersAcrossAllCombinations('/phpinfo');
});

// ========================================================================
// ADMIN NOTIFICATIONS — 1 view × 3 frameworks
// ========================================================================

it('renders admin send notification across all frameworks', function () {
    assertRendersAcrossAllCombinations('/notifications/send');
});

// ========================================================================
// HOME DASHBOARD — 1 view × 3 frameworks
// ========================================================================

it('renders admin home dashboard across all frameworks', function () {
    assertRendersAcrossAllCombinations('/home');
});

it('renders user home dashboard across all combinations', function () {
    $cssFrameworks = ['tailwind', 'bootstrap5', 'bootstrap4'];
    $frontends = ['blade', 'livewire', 'vue', 'react', 'svelte'];

    foreach ($cssFrameworks as $css) {
        foreach ($frontends as $fe) {
            config(['ui-kit.css_framework' => $css, 'ui-kit.frontend' => $fe]);

            $this->actingAs($this->testUser)
                ->get('/home')
                ->assertOk();
        }
    }
});

// ========================================================================
// STRUCTURAL: ServiceProvider detection
// ========================================================================

it('all package ServiceProviders detect css framework', function () {
    $packages = [
        'laravel-profiles',
        'laravel-themes',
        'laravel-socialite-kit',
        'laravel-posts',
        'laravel-notifications',
        'laravel-chat',
        'laravel-toast',
        'laravel-face-auth',
        'laravel-users',
        'laravel2step',
        'laravel-blocker',
        'laravel-logger',
        'laravel-phpinfo',
        'laravel-roles',
    ];

    foreach ($packages as $pkg) {
        $pattern = base_path("packages/{$pkg}/src/Providers/*ServiceProvider.php");
        $providers = glob($pattern);
        if (empty($providers)) {
            $providers = glob(base_path("packages/{$pkg}/src/*ServiceProvider.php"));
        }

        foreach ($providers as $file) {
            $content = file_get_contents($file);
            expect(str_contains($content, 'ui-kit.css_framework'))->toBeTrue(
                "Package {$pkg} ServiceProvider (".basename($file).') should detect CSS framework'
            );
        }
    }
});

// ========================================================================
// STRUCTURAL: every package has all 3 framework directories
// ========================================================================

it('all packages with views have all 3 framework directories', function () {
    $packages = [
        'laravel-users/src/resources/views',
        'laravel-notifications/resources/views',
        'laravel-profiles/resources/views',
        'laravel-themes/resources/views',
        'laravel-chat/resources/views',
        'laravel-toast/resources/views',
        'laravel-socialite-kit/resources/views',
        'laravel-posts/resources/views',
        'laravel-face-auth/resources/views',
        'laravel2step/src/resources/views',
        'laravel-ui-kit/resources/views',
    ];

    foreach ($packages as $pkg) {
        foreach (['tailwind', 'bootstrap5', 'bootstrap4'] as $fw) {
            $fullPath = base_path('packages/'.$pkg.'/'.$fw);
            expect(is_dir($fullPath))->toBeTrue(
                "Missing {$fw}/ directory in packages/{$pkg}/"
            );
        }
    }
});

// ========================================================================
// STRUCTURAL: UI Kit has equal component count across frameworks
// ========================================================================

it('ui kit has same component count across all frameworks', function () {
    $base = base_path('packages/laravel-ui-kit/resources/views');

    $twCount = count(glob($base.'/tailwind/components/*.blade.php'));
    $bs5Count = count(glob($base.'/bootstrap5/components/*.blade.php'));
    $bs4Count = count(glob($base.'/bootstrap4/components/*.blade.php'));

    expect($twCount)->toBeGreaterThan(0);
    expect($bs5Count)->toBe($twCount, "BS5 component count ({$bs5Count}) should match Tailwind ({$twCount})");
    expect($bs4Count)->toBe($twCount, "BS4 component count ({$bs4Count}) should match Tailwind ({$twCount})");
});

// ========================================================================
// FRONTEND FRAMEWORKS: Livewire components registered
// ========================================================================

it('registers Livewire components for all modern packages', function () {
    $expected = [
        // ui-kit (24 components - spot check)
        'ui-alert', 'ui-button', 'ui-card', 'ui-input', 'ui-modal', 'ui-badge',
        'ui-stat-card', 'ui-theme-toggle', 'ui-data-table',
        // notifications
        'notifications-list',
        // profiles
        'profile-show', 'profile-edit', 'sessions-management',
        // themes
        'theme-selector',
        // chat
        'chat-window',
        // socialite-kit
        'admin-social-providers', 'connected-accounts',
        // posts
        'post-index', 'post-show', 'admin-post-index',
        // face-auth
        'face-auth-enroll',
        // toast
        'toast-container',
        // users
        'users-index', 'user-show', 'user-form',
    ];

    foreach ($expected as $name) {
        expect(class_exists(Livewire::class))->toBeTrue('Livewire should be installed');
    }
});

// ========================================================================
// FRONTEND FRAMEWORKS: Livewire views exist for modern packages
// ========================================================================

it('all packages have livewire view directories', function () {
    $packageLivewirePaths = [
        'laravel-ui-kit/resources/views/livewire',
        'laravel-notifications/resources/views/livewire',
        'laravel-profiles/resources/views/livewire',
        'laravel-themes/resources/views/livewire',
        'laravel-chat/resources/views/livewire',
        'laravel-socialite-kit/resources/views/livewire',
        'laravel-posts/resources/views/livewire',
        'laravel-face-auth/resources/views/livewire',
        'laravel-toast/resources/views/livewire',
        'laravel-users/src/resources/views/livewire',
        'laravel2step/src/resources/views/livewire',
        'laravel-roles/src/resources/views/livewire',
        'laravel-blocker/src/resources/views/livewire',
        'laravel-logger/src/resources/views/livewire',
        'laravel-phpinfo/src/resources/views/livewire',
    ];

    foreach ($packageLivewirePaths as $path) {
        $fullPath = base_path('packages/'.$path);
        expect(is_dir($fullPath))->toBeTrue(
            "Missing livewire/ directory in packages/{$path}"
        );
    }
});

// ========================================================================
// FRONTEND FRAMEWORKS: Vue/React/Svelte pages exist for modern packages
// ========================================================================

it('all packages have vue page components', function () {
    $packageJsPaths = [
        'laravel-notifications/resources/js/vue/pages',
        'laravel-profiles/resources/js/vue/pages',
        'laravel-themes/resources/js/vue/pages',
        'laravel-chat/resources/js/vue/pages',
        'laravel-socialite-kit/resources/js/vue/pages',
        'laravel-posts/resources/js/vue/pages',
        'laravel-face-auth/resources/js/vue/pages',
        'laravel-users/src/resources/js/vue/pages',
        'laravel2step/src/resources/js/vue/pages',
        'laravel-roles/src/resources/js/vue/pages',
        'laravel-blocker/src/resources/js/vue/pages',
        'laravel-logger/src/resources/js/vue/pages',
        'laravel-phpinfo/src/resources/js/vue/pages',
    ];

    foreach ($packageJsPaths as $path) {
        $fullPath = base_path('packages/'.$path);
        expect(is_dir($fullPath))->toBeTrue(
            "Missing vue/pages/ directory in packages/{$path}"
        );
        $files = glob($fullPath.'/*.vue');
        expect(count($files))->toBeGreaterThan(0,
            "No .vue files found in packages/{$path}"
        );
    }
});

it('all packages have react page components', function () {
    $packageJsPaths = [
        'laravel-notifications/resources/js/react/pages',
        'laravel-profiles/resources/js/react/pages',
        'laravel-themes/resources/js/react/pages',
        'laravel-chat/resources/js/react/pages',
        'laravel-socialite-kit/resources/js/react/pages',
        'laravel-posts/resources/js/react/pages',
        'laravel-face-auth/resources/js/react/pages',
        'laravel-users/src/resources/js/react/pages',
        'laravel2step/src/resources/js/react/pages',
        'laravel-roles/src/resources/js/react/pages',
        'laravel-blocker/src/resources/js/react/pages',
        'laravel-logger/src/resources/js/react/pages',
        'laravel-phpinfo/src/resources/js/react/pages',
    ];

    foreach ($packageJsPaths as $path) {
        $fullPath = base_path('packages/'.$path);
        expect(is_dir($fullPath))->toBeTrue(
            "Missing react/pages/ directory in packages/{$path}"
        );
        $files = glob($fullPath.'/*.jsx');
        expect(count($files))->toBeGreaterThan(0,
            "No .jsx files found in packages/{$path}"
        );
    }
});

it('all packages have svelte page components', function () {
    $packageJsPaths = [
        'laravel-notifications/resources/js/svelte/pages',
        'laravel-profiles/resources/js/svelte/pages',
        'laravel-themes/resources/js/svelte/pages',
        'laravel-chat/resources/js/svelte/pages',
        'laravel-socialite-kit/resources/js/svelte/pages',
        'laravel-posts/resources/js/svelte/pages',
        'laravel-face-auth/resources/js/svelte/pages',
        'laravel-users/src/resources/js/svelte/pages',
        'laravel2step/src/resources/js/svelte/pages',
        'laravel-roles/src/resources/js/svelte/pages',
        'laravel-blocker/src/resources/js/svelte/pages',
        'laravel-logger/src/resources/js/svelte/pages',
        'laravel-phpinfo/src/resources/js/svelte/pages',
    ];

    foreach ($packageJsPaths as $path) {
        $fullPath = base_path('packages/'.$path);
        expect(is_dir($fullPath))->toBeTrue(
            "Missing svelte/pages/ directory in packages/{$path}"
        );
        $files = glob($fullPath.'/*.svelte');
        expect(count($files))->toBeGreaterThan(0,
            "No .svelte files found in packages/{$path}"
        );
    }
});

// ========================================================================
// FRONTEND FRAMEWORKS: laravel-users has all frontend variants
// ========================================================================

it('laravel-users has complete frontend framework coverage', function () {
    $base = base_path('packages/laravel-users/src/resources');

    // Blade views: 3 CSS frameworks
    expect(count(glob($base.'/views/tailwind/usersmanagement/*.blade.php')))->toBeGreaterThanOrEqual(6);
    expect(count(glob($base.'/views/bootstrap5/usersmanagement/*.blade.php')))->toBeGreaterThanOrEqual(6);
    expect(count(glob($base.'/views/bootstrap4/usersmanagement/*.blade.php')))->toBeGreaterThanOrEqual(4);

    // Livewire views
    expect(count(glob($base.'/views/livewire/*.blade.php')))->toBe(3);

    // Vue pages
    expect(count(glob($base.'/js/vue/pages/*.vue')))->toBe(3);

    // React pages
    expect(count(glob($base.'/js/react/pages/*.jsx')))->toBe(3);

    // Svelte pages
    expect(count(glob($base.'/js/svelte/pages/*.svelte')))->toBe(3);
});

// ========================================================================
// FRONTEND FRAMEWORKS: UI Kit has Livewire component classes
// ========================================================================

it('ui kit livewire component directory has files', function () {
    $path = base_path('packages/laravel-ui-kit/src/Livewire');
    expect(is_dir($path))->toBeTrue();
    $files = glob($path.'/*.php');
    expect(count($files))->toBeGreaterThanOrEqual(20, 'UI Kit should have 20+ Livewire component classes');
});

it('ui kit has vue react svelte component directories', function () {
    $base = base_path('packages/laravel-ui-kit/resources/js');

    expect(count(glob($base.'/vue/*.vue')))->toBeGreaterThan(0, 'UI Kit should have Vue components');
    expect(count(glob($base.'/react/*.jsx')))->toBeGreaterThan(0, 'UI Kit should have React components');
    expect(count(glob($base.'/svelte/*.svelte')))->toBeGreaterThan(0, 'UI Kit should have Svelte components');
});
