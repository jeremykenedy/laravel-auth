<?php

use App\Models\Role;
use App\Models\User;
use Database\Seeders\ConnectRelationshipsSeeder;
use Database\Seeders\PermissionsTableSeeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\ThemesTableSeeder;

it('calculates profile completeness for new user', function () {
    $user = User::factory()->create([
        'first_name' => null,
        'last_name' => null,
        'email_verified_at' => null,
    ]);
    $user->ensureProfile();

    $result = $user->profileCompleteness();

    expect($result)->toHaveKeys(['steps', 'completed', 'total', 'percent']);
    expect($result['total'])->toBe(8);
    expect($result['percent'])->toBeLessThan(100);
    expect($result['steps']['name']['done'])->toBeTrue();
    expect($result['steps']['email']['done'])->toBeTrue();
    expect($result['steps']['email_verified']['done'])->toBeFalse();
    expect($result['steps']['first_name']['done'])->toBeFalse();
    expect($result['steps']['last_name']['done'])->toBeFalse();
});

it('calculates higher completeness with filled fields', function () {
    $user = User::factory()->create([
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email_verified_at' => now(),
    ]);
    $user->ensureProfile();

    $result = $user->profileCompleteness();

    expect($result['steps']['first_name']['done'])->toBeTrue();
    expect($result['steps']['last_name']['done'])->toBeTrue();
    expect($result['steps']['email_verified']['done'])->toBeTrue();
    expect($result['percent'])->toBeGreaterThan(50);
});

it('shows profile completion on user dashboard', function () {
    $user = User::factory()->create([
        'first_name' => null,
        'last_name' => null,
        'email_verified_at' => now(),
    ]);
    $user->ensureProfile();
    $user->attachRole(Role::where('slug', 'user')->first());

    $this->seed(RolesTableSeeder::class);
    $this->seed(PermissionsTableSeeder::class);
    $this->seed(ThemesTableSeeder::class);

    $this->actingAs($user)
        ->get('/home')
        ->assertOk()
        ->assertSee('Complete Your Profile');
});

it('hides completion card when profile is 100% complete', function () {
    $this->seed(RolesTableSeeder::class);
    $this->seed(PermissionsTableSeeder::class);
    $this->seed(ThemesTableSeeder::class);
    $this->seed(ConnectRelationshipsSeeder::class);

    $user = User::factory()->create([
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email_verified_at' => now(),
    ]);
    $user->ensureProfile();
    $user->profile->theme_id = 1;
    $user->profile->save();
    $user->load('profile');

    $result = $user->profileCompleteness();
    // name, email, email_verified, first_name, last_name, theme = 6 done
    // avatar and two_factor not done
    expect($result['completed'])->toBe(6);
    expect($result['total'])->toBe(8);
    expect($result['percent'])->toBe(75);
});
