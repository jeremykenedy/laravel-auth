<?php

use App\Models\Role;
use App\Models\User;
use Database\Seeders\BlockedItemsTableSeeder;
use Database\Seeders\BlockedTypeTableSeeder;
use Database\Seeders\ConnectRelationshipsSeeder;
use Database\Seeders\PermissionsTableSeeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\ThemesTableSeeder;
use Illuminate\Support\Facades\Schema;
use Jeremykenedy\LaravelLoginHistory\Models\LoginHistory;
use Jeremykenedy\LaravelLoginHistory\Services\LoginHistoryService;

beforeEach(function () {
    $this->seed(BlockedTypeTableSeeder::class);
    $this->seed(BlockedItemsTableSeeder::class);
    $this->seed(RolesTableSeeder::class);
    $this->seed(PermissionsTableSeeder::class);
    $this->seed(ConnectRelationshipsSeeder::class);
    $this->seed(ThemesTableSeeder::class);

    $this->user = User::factory()->create(['email_verified_at' => now()]);
    $this->user->attachRole(Role::where('slug', 'user')->first());

    $this->admin = User::factory()->create(['email_verified_at' => now()]);
    $this->admin->attachRole(Role::where('slug', 'admin')->first());
});

it('registers login-history config', function () {
    expect(config('login-history.enabled'))->toBeTrue();
    expect(config('login-history.per_page'))->toBe(20);
});

it('login_histories table exists', function () {
    expect(Schema::hasTable('login_histories'))->toBeTrue();
});

it('service records a login', function () {
    $service = app(LoginHistoryService::class);
    $service->record($this->user, request(), true);

    expect(LoginHistory::where('user_id', $this->user->id)->count())->toBe(1);
});

it('service records a failed login', function () {
    $service = app(LoginHistoryService::class);
    $service->record($this->user, request(), false);

    $record = LoginHistory::where('user_id', $this->user->id)->first();
    expect($record->login_successful)->toBeFalse();
});

it('service gets user history', function () {
    $service = app(LoginHistoryService::class);
    $service->record($this->user, request());

    $history = $service->getForUser($this->user, 20);
    expect($history->count())->toBe(1);
});

it('service cleanup removes old records', function () {
    $service = app(LoginHistoryService::class);
    LoginHistory::create([
        'user_id' => $this->user->id,
        'login_at' => now()->subDays(100),
        'login_successful' => true,
    ]);

    $deleted = $service->cleanup(90);
    expect($deleted)->toBe(1);
    expect(LoginHistory::count())->toBe(0);
});

it('user can view own login history', function () {
    $service = app(LoginHistoryService::class);
    $service->record($this->user, request());

    $this->actingAs($this->user)
        ->get('/login-history')
        ->assertOk();
});

it('user login history requires auth', function () {
    $this->get('/login-history')->assertRedirect('/login');
});

it('admin can view all login history', function () {
    $this->actingAs($this->admin)
        ->get('/admin/login-history')
        ->assertOk();
});

it('regular user cannot view admin login history', function () {
    $this->actingAs($this->user)
        ->get('/admin/login-history')
        ->assertStatus(403);
});

it('admin login history supports filters', function () {
    $service = app(LoginHistoryService::class);
    $service->record($this->user, request());

    $this->actingAs($this->admin)
        ->get('/admin/login-history?search='.$this->user->name)
        ->assertOk();
});

it('parses browser from user agent', function () {
    $service = app(LoginHistoryService::class);
    $request = request();
    $request->headers->set('User-Agent', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36');
    $service->record($this->user, $request);

    $record = LoginHistory::where('user_id', $this->user->id)->first();
    expect($record->browser)->toBe('Chrome');
    expect($record->platform)->toBe('macOS');
    expect($record->device)->toBe('Desktop');
});

it('routes are registered', function () {
    $routes = collect(app('router')->getRoutes()->getRoutes())->pluck('action.as')->filter()->toArray();
    expect($routes)->toContain('login-history.index');
    expect($routes)->toContain('login-history.admin.index');
});
