<?php

use App\Models\Role;
use App\Models\User;
use Database\Seeders\BlockedItemsTableSeeder;
use Database\Seeders\BlockedTypeTableSeeder;
use Database\Seeders\ConnectRelationshipsSeeder;
use Database\Seeders\PermissionsTableSeeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\ThemesTableSeeder;
use jeremykenedy\LaravelBlocker\Livewire\BlockerIndex;
use jeremykenedy\LaravelLogger\Livewire\ActivityLog;
use Jeremykenedy\LaravelNotifications\Livewire\NotificationsList;
use jeremykenedy\LaravelPhpInfo\Livewire\PhpInfoDisplay;
use jeremykenedy\LaravelRoles\Livewire\RolesIndex;
use Jeremykenedy\LaravelUiKit\Livewire\UiAlert;
use Jeremykenedy\LaravelUiKit\Livewire\UiBadge;
use Jeremykenedy\LaravelUiKit\Livewire\UiButton;
use Jeremykenedy\LaravelUiKit\Livewire\UiCard;
use Jeremykenedy\LaravelUiKit\Livewire\UiInput;
use Jeremykenedy\LaravelUiKit\Livewire\UiModal;
use Jeremykenedy\LaravelUiKit\Livewire\UiStatCard;
use Jeremykenedy\LaravelUiKit\Livewire\UiToggle;
use jeremykenedy\laravelusers\Livewire\UserForm;
use jeremykenedy\laravelusers\Livewire\UserShow;
use jeremykenedy\laravelusers\Livewire\UsersIndex;
use Livewire\Livewire;

beforeEach(function () {
    $this->seed(BlockedTypeTableSeeder::class);
    $this->seed(BlockedItemsTableSeeder::class);
    $this->seed(RolesTableSeeder::class);
    $this->seed(PermissionsTableSeeder::class);
    $this->seed(ConnectRelationshipsSeeder::class);
    $this->seed(ThemesTableSeeder::class);

    $this->admin = User::factory()->create(['email_verified_at' => now()]);
    $this->admin->attachRole(Role::where('slug', 'admin')->first());
    $this->admin->ensureProfile();

    $this->testUser = User::factory()->create(['email_verified_at' => now()]);
    $userRole = Role::where('slug', 'user')->first();
    $this->testUser->attachRole($userRole);
    $this->testUser->ensureProfile();

    $this->cssFrameworks = ['tailwind', 'bootstrap5', 'bootstrap4'];
});

// ========================================================================
// laravel-users: UsersIndex x 3 CSS frameworks
// ========================================================================

it('renders UsersIndex livewire across all css frameworks', function () {
    foreach ($this->cssFrameworks as $fw) {
        config(['ui-kit.css_framework' => $fw]);

        Livewire::actingAs($this->admin)
            ->test(UsersIndex::class)
            ->assertOk()
            ->assertSee($this->testUser->name);
    }
});

it('UsersIndex livewire search works across all css frameworks', function () {
    foreach ($this->cssFrameworks as $fw) {
        config(['ui-kit.css_framework' => $fw]);

        Livewire::actingAs($this->admin)
            ->test(UsersIndex::class)
            ->set('search', $this->testUser->name)
            ->assertSee($this->testUser->name);
    }
});

it('UsersIndex livewire bulk activate across all css frameworks', function () {
    foreach ($this->cssFrameworks as $fw) {
        config(['ui-kit.css_framework' => $fw]);
        $user = User::factory()->create(['activated' => 0]);

        Livewire::actingAs($this->admin)
            ->test(UsersIndex::class)
            ->set('selected', [$user->id])
            ->set('bulkAction', 'activate')
            ->call('bulkApply');

        expect($user->fresh()->activated)->toBeTrue();
    }
});

it('UsersIndex livewire bulk deactivate across all css frameworks', function () {
    foreach ($this->cssFrameworks as $fw) {
        config(['ui-kit.css_framework' => $fw]);
        $user = User::factory()->create(['activated' => 1]);

        Livewire::actingAs($this->admin)
            ->test(UsersIndex::class)
            ->set('selected', [$user->id])
            ->set('bulkAction', 'deactivate')
            ->call('bulkApply');

        expect($user->fresh()->activated)->toBeFalse();
    }
});

it('UsersIndex livewire delete across all css frameworks', function () {
    foreach ($this->cssFrameworks as $fw) {
        config(['ui-kit.css_framework' => $fw]);
        $user = User::factory()->create();

        Livewire::actingAs($this->admin)
            ->test(UsersIndex::class)
            ->call('deleteUser', $user->id);

        $this->assertSoftDeleted('users', ['id' => $user->id]);
    }
});

it('UsersIndex livewire prevents self-delete across all css frameworks', function () {
    foreach ($this->cssFrameworks as $fw) {
        config(['ui-kit.css_framework' => $fw]);

        Livewire::actingAs($this->admin)
            ->test(UsersIndex::class)
            ->call('deleteUser', $this->admin->id);

        expect(User::find($this->admin->id))->not->toBeNull();
    }
});

// ========================================================================
// laravel-users: UserShow x 3 CSS frameworks
// ========================================================================

it('renders UserShow livewire across all css frameworks', function () {
    foreach ($this->cssFrameworks as $fw) {
        config(['ui-kit.css_framework' => $fw]);

        Livewire::actingAs($this->admin)
            ->test(UserShow::class, ['userId' => $this->testUser->id])
            ->assertOk()
            ->assertSee($this->testUser->name)
            ->assertSee($this->testUser->email);
    }
});

// ========================================================================
// laravel-users: UserForm x 3 CSS frameworks
// ========================================================================

it('renders UserForm create across all css frameworks', function () {
    foreach ($this->cssFrameworks as $fw) {
        config(['ui-kit.css_framework' => $fw]);

        Livewire::actingAs($this->admin)
            ->test(UserForm::class)
            ->assertOk()
            ->assertSee('Create User');
    }
});

it('renders UserForm edit across all css frameworks', function () {
    foreach ($this->cssFrameworks as $fw) {
        config(['ui-kit.css_framework' => $fw]);

        Livewire::actingAs($this->admin)
            ->test(UserForm::class, ['userId' => $this->testUser->id])
            ->assertOk()
            ->assertSee('Edit User');
    }
});

it('UserForm livewire creates user across all css frameworks', function () {
    $role = Role::where('slug', 'user')->first();

    foreach ($this->cssFrameworks as $i => $fw) {
        config(['ui-kit.css_framework' => $fw]);

        Livewire::actingAs($this->admin)
            ->test(UserForm::class)
            ->set('name', "lwuser{$i}")
            ->set('email', "lw{$i}@test.com")
            ->set('password', 'Password123!')
            ->set('password_confirmation', 'Password123!')
            ->set('role', $role->id)
            ->call('save');

        $this->assertDatabaseHas('users', ['email' => "lw{$i}@test.com"]);
    }
});

it('UserForm livewire validates across all css frameworks', function () {
    foreach ($this->cssFrameworks as $fw) {
        config(['ui-kit.css_framework' => $fw]);

        Livewire::actingAs($this->admin)
            ->test(UserForm::class)
            ->set('name', '')
            ->set('email', '')
            ->call('save')
            ->assertHasErrors(['name', 'email', 'password', 'role']);
    }
});

// ========================================================================
// laravel-roles: RolesIndex x 3 CSS frameworks
// ========================================================================

it('renders RolesIndex livewire across all css frameworks', function () {
    foreach ($this->cssFrameworks as $fw) {
        config(['ui-kit.css_framework' => $fw]);

        Livewire::actingAs($this->admin)
            ->test(RolesIndex::class)
            ->assertOk()
            ->assertSee('Admin');
    }
});

// ========================================================================
// laravel-blocker: BlockerIndex x 3 CSS frameworks
// ========================================================================

it('renders BlockerIndex livewire across all css frameworks', function () {
    foreach ($this->cssFrameworks as $fw) {
        config(['ui-kit.css_framework' => $fw]);

        Livewire::actingAs($this->admin)
            ->test(BlockerIndex::class)
            ->assertOk();
    }
});

// ========================================================================
// laravel-logger: ActivityLog x 3 CSS frameworks
// ========================================================================

it('renders ActivityLog livewire across all css frameworks', function () {
    foreach ($this->cssFrameworks as $fw) {
        config(['ui-kit.css_framework' => $fw]);

        Livewire::actingAs($this->admin)
            ->test(ActivityLog::class)
            ->assertOk();
    }
});

it('ActivityLog livewire search across all css frameworks', function () {
    foreach ($this->cssFrameworks as $fw) {
        config(['ui-kit.css_framework' => $fw]);

        Livewire::actingAs($this->admin)
            ->test(ActivityLog::class)
            ->set('search', 'test')
            ->assertOk();
    }
});

// ========================================================================
// laravel-phpinfo: PhpInfoDisplay x 3 CSS frameworks
// ========================================================================

it('renders PhpInfoDisplay livewire across all css frameworks', function () {
    foreach ($this->cssFrameworks as $fw) {
        config(['ui-kit.css_framework' => $fw]);

        Livewire::actingAs($this->admin)
            ->test(PhpInfoDisplay::class)
            ->assertOk()
            ->assertSee('PHP');
    }
});

// ========================================================================
// Class existence: all Livewire component classes
// ========================================================================

it('all Livewire component classes exist', function () {
    $classes = [
        // laravel-users
        UsersIndex::class, UserShow::class, UserForm::class,
        // laravel-roles
        RolesIndex::class,
        // laravel-blocker
        BlockerIndex::class,
        // laravel-logger
        ActivityLog::class,
        // laravel-phpinfo
        PhpInfoDisplay::class,
        // laravel-notifications
        NotificationsList::class,
        // laravel-ui-kit (spot check)
        UiAlert::class, UiButton::class, UiCard::class, UiBadge::class,
        UiInput::class, UiModal::class, UiStatCard::class, UiToggle::class,
    ];

    foreach ($classes as $class) {
        expect(class_exists($class))->toBeTrue("Missing: {$class}");
    }
});

// ========================================================================
// Frontend config switching: layout renders differently per frontend
// ========================================================================

it('layout includes livewire scripts when frontend is blade', function () {
    config(['ui-kit.frontend' => 'blade']);

    $this->actingAs($this->admin)
        ->get('/home')
        ->assertOk()
        ->assertSee('livewire');
});

it('layout includes livewire scripts when frontend is livewire', function () {
    config(['ui-kit.frontend' => 'livewire']);

    $this->actingAs($this->admin)
        ->get('/home')
        ->assertOk()
        ->assertSee('livewire');
});

it('frontend config correctly switches between blade and livewire', function () {
    // Blade mode should work
    config(['ui-kit.frontend' => 'blade']);
    $this->actingAs($this->admin)->get('/home')->assertOk();

    // Livewire mode should work
    config(['ui-kit.frontend' => 'livewire']);
    $this->actingAs($this->admin)->get('/home')->assertOk();
});

it('frontend config is readable for vue/react/svelte', function () {
    // These modes set config but the Blade routes still render (Inertia would take over in real app)
    foreach (['vue', 'react', 'svelte'] as $fe) {
        config(['ui-kit.frontend' => $fe]);
        expect(config('ui-kit.frontend'))->toBe($fe);
    }
});

// ========================================================================
// CSS x Frontend config: all 6 server-renderable combinations
// ========================================================================

it('home renders across all css x blade/livewire combinations', function () {
    $cssFrameworks = ['tailwind', 'bootstrap5', 'bootstrap4'];
    $serverFrontends = ['blade', 'livewire'];

    foreach ($cssFrameworks as $css) {
        foreach ($serverFrontends as $fe) {
            config([
                'ui-kit.css_framework' => $css,
                'ui-kit.frontend' => $fe,
            ]);

            $this->actingAs($this->admin)
                ->get('/home')
                ->assertOk();
        }
    }
});

// ========================================================================
// Vue/React/Svelte: file parity across all packages
// ========================================================================

it('all packages have matching vue/react/svelte file counts', function () {
    $packages = [
        'laravel-users/src/resources/js',
        'laravel2step/src/resources/js',
        'laravel-roles/src/resources/js',
        'laravel-blocker/src/resources/js',
        'laravel-logger/src/resources/js',
        'laravel-phpinfo/src/resources/js',
        'laravel-notifications/resources/js',
        'laravel-profiles/resources/js',
        'laravel-themes/resources/js',
        'laravel-chat/resources/js',
        'laravel-socialite-kit/resources/js',
        'laravel-posts/resources/js',
        'laravel-face-auth/resources/js',
    ];

    foreach ($packages as $pkg) {
        $base = base_path('packages/'.$pkg);
        $vueCount = count(glob($base.'/vue/pages/*.vue'));
        $reactCount = count(glob($base.'/react/pages/*.jsx'));
        $svelteCount = count(glob($base.'/svelte/pages/*.svelte'));

        expect($vueCount)->toBeGreaterThan(0, "No Vue pages in {$pkg}");
        expect($reactCount)->toBe($vueCount, "React count ({$reactCount}) != Vue count ({$vueCount}) in {$pkg}");
        expect($svelteCount)->toBe($vueCount, "Svelte count ({$svelteCount}) != Vue count ({$vueCount}) in {$pkg}");
    }
});
