<?php

use App\Models\Role;
use App\Models\User;
use Database\Seeders\ConnectRelationshipsSeeder;
use Database\Seeders\PermissionsTableSeeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\ThemesTableSeeder;
use Illuminate\Support\Str;

beforeEach(function () {
    $this->seed(RolesTableSeeder::class);
    $this->seed(PermissionsTableSeeder::class);
    $this->seed(ConnectRelationshipsSeeder::class);
    $this->seed(ThemesTableSeeder::class);
});

it('shows user dashboard with stats for regular users', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);
    $userRole = Role::where('slug', 'user')->first();
    $user->attachRole($userRole);

    $this->actingAs($user)
        ->get('/home')
        ->assertOk()
        ->assertSee('Unread Notifications')
        ->assertSee('Active Sessions')
        ->assertSee('Account Security');
});

it('shows admin dashboard with system info for admins', function () {
    $admin = User::factory()->create(['email_verified_at' => now()]);
    $adminRole = Role::where('slug', 'admin')->first();
    $admin->attachRole($adminRole);

    $this->actingAs($admin)
        ->get('/home')
        ->assertOk()
        ->assertSee('Total Users')
        ->assertSee('System Information')
        ->assertSee('Recent Registrations')
        ->assertSee(PHP_VERSION);
});

it('shows recent notifications on user dashboard', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);
    $userRole = Role::where('slug', 'user')->first();
    $user->attachRole($userRole);

    $user->notifications()->create([
        'id' => Str::uuid()->toString(),
        'type' => 'App\\Notifications\\TestNotification',
        'data' => ['title' => 'Test Alert', 'message' => 'Something happened'],
    ]);

    $this->actingAs($user)
        ->get('/home')
        ->assertOk()
        ->assertSee('Test Alert')
        ->assertSee('Something happened');
});

it('shows empty state when user has no notifications', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);
    $userRole = Role::where('slug', 'user')->first();
    $user->attachRole($userRole);

    $this->actingAs($user)
        ->get('/home')
        ->assertOk()
        ->assertSee('No unread notifications');
});

it('shows quick links on user dashboard', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);
    $userRole = Role::where('slug', 'user')->first();
    $user->attachRole($userRole);

    $this->actingAs($user)
        ->get('/home')
        ->assertOk()
        ->assertSee('Quick Links')
        ->assertSee('My Profile')
        ->assertSee('Active Sessions')
        ->assertSee('Themes');
});

it('shows email verification status on user dashboard', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);
    $userRole = Role::where('slug', 'user')->first();
    $user->attachRole($userRole);

    $this->actingAs($user)
        ->get('/home')
        ->assertOk()
        ->assertSee('Email Verification')
        ->assertSee('Verified');
});

it('admin dashboard shows recently active users', function () {
    $admin = User::factory()->create(['email_verified_at' => now()]);
    $adminRole = Role::where('slug', 'admin')->first();
    $admin->attachRole($adminRole);

    $this->actingAs($admin)
        ->get('/home')
        ->assertOk()
        ->assertSee('Recently Active Users');
});

it('admin dashboard shows quick actions', function () {
    $admin = User::factory()->create(['email_verified_at' => now()]);
    $adminRole = Role::where('slug', 'admin')->first();
    $admin->attachRole($adminRole);

    $this->actingAs($admin)
        ->get('/home')
        ->assertOk()
        ->assertSee('Quick Actions')
        ->assertSee('New User')
        ->assertSee('Activity Log');
});
