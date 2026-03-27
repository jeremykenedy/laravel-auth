<?php

use App\Models\User;

it('can save dark mode preference via API', function () {
    $user = User::factory()->create();
    $user->ensureProfile();

    $this->actingAs($user)
        ->putJson('/profile/dark-mode', ['dark_mode' => 'dark'])
        ->assertOk()
        ->assertJson(['dark_mode' => 'dark']);

    expect($user->fresh()->profile->dark_mode)->toBe('dark');
});

it('rejects invalid dark mode values', function () {
    $user = User::factory()->create();
    $user->ensureProfile();

    $this->actingAs($user)
        ->putJson('/profile/dark-mode', ['dark_mode' => 'invalid'])
        ->assertUnprocessable();
});

it('can set dark mode to system', function () {
    $user = User::factory()->create();
    $user->ensureProfile();
    $user->profile->update(['dark_mode' => 'dark']);

    $this->actingAs($user)
        ->putJson('/profile/dark-mode', ['dark_mode' => 'system'])
        ->assertOk();

    expect($user->fresh()->profile->dark_mode)->toBe('system');
});

it('can set dark mode to light', function () {
    $user = User::factory()->create();
    $user->ensureProfile();

    $this->actingAs($user)
        ->putJson('/profile/dark-mode', ['dark_mode' => 'light'])
        ->assertOk();

    expect($user->fresh()->profile->dark_mode)->toBe('light');
});
