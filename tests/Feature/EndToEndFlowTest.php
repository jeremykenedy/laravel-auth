<?php

use App\Models\Role;
use App\Models\User;
use Database\Seeders\ConnectRelationshipsSeeder;
use Database\Seeders\PermissionsTableSeeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\ThemesTableSeeder;

beforeEach(function () {
    $this->seed(RolesTableSeeder::class);
    $this->seed(PermissionsTableSeeder::class);
    $this->seed(ConnectRelationshipsSeeder::class);
    $this->seed(ThemesTableSeeder::class);
});

// Full registration -> verification redirect flow
it('registration creates user with profile and role then redirects to verify', function () {
    $this->post('/register', [
        'name' => 'newuser',
        'email' => 'newuser@test.com',
        'password' => 'Password123',
        'password_confirmation' => 'Password123',
    ])->assertRedirect('/home');

    $user = User::where('email', 'newuser@test.com')->first();
    expect($user)->not->toBeNull();
    expect($user->profile)->not->toBeNull();
    expect($user->roles)->toHaveCount(1);
    expect($user->roles->first()->slug)->toBe('user');
    expect($user->email_verified_at)->toBeNull();

    // Unverified user gets redirected to verify-email
    $this->actingAs($user)->get('/home')->assertRedirect('/verify-email');
    $this->actingAs($user)->get('/verify-email')->assertOk()->assertSee('Verify Your Email');
});

// Verified user can access home
it('verified user sees user dashboard', function () {
    $user = User::factory()->create();
    $userRole = Role::where('slug', 'user')->first();
    $user->attachRole($userRole);

    $this->actingAs($user)->get('/home')
        ->assertOk()
        ->assertSee('User Access')
        ->assertDontSee('Total Users')
        ->assertDontSee('Quick Actions');
});

// Admin sees admin dashboard with stats
it('admin sees admin dashboard with stats and quick actions', function () {
    $admin = User::factory()->create();
    $admin->attachRole(Role::where('slug', 'admin')->first());

    $this->actingAs($admin)->get('/home')
        ->assertOk()
        ->assertSee('Admin Access')
        ->assertSee('Total Users')
        ->assertSee('Quick Actions')
        ->assertSee('Recently Active');
});

// Superadmin can access all admin pages
it('superadmin can access all admin features', function () {
    $superadmin = User::factory()->create(['email_verified_at' => now()]);
    $superadmin->attachRole(Role::where('slug', 'admin')->first());

    $pages = ['/users', '/routes', '/settings', '/activity', '/roles', '/admin/posts', '/admin/themes'];

    foreach ($pages as $page) {
        $this->actingAs($superadmin)->get($page)->assertOk();
    }
});

// Regular user cannot access admin pages
it('regular user gets 403 on admin pages', function () {
    $user = User::factory()->create();
    $user->attachRole(Role::where('slug', 'user')->first());

    $this->actingAs($user)->get('/users')->assertForbidden();
    $this->actingAs($user)->get('/settings')->assertForbidden();
    $this->actingAs($user)->get('/routes')->assertForbidden();
});

// Login -> logout -> cannot access protected pages
it('logout revokes access to protected pages', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->get('/home')->assertOk();
    $this->actingAs($user)->post('/logout')->assertRedirect('/');
    $this->get('/home')->assertRedirect('/login');
});

// Impersonation flow
it('admin can impersonate then stop and return to admin', function () {
    $admin = User::factory()->create();
    $admin->attachRole(Role::where('slug', 'admin')->first());

    $user = User::factory()->create();
    $user->attachRole(Role::where('slug', 'user')->first());

    // Start impersonation
    $this->actingAs($admin)->post('/impersonate/'.$user->id)
        ->assertRedirect('/home');

    // Stop impersonation
    $this->withSession([
        'impersonator_id' => $admin->id,
        'impersonator_name' => $admin->name,
    ])->post('/impersonate-stop')
        ->assertRedirect('/home');
});
