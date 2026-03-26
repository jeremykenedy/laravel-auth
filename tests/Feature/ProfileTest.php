<?php

use App\Models\User;

it('renders the profile show page', function () {
    $user = User::factory()->create();
    $user->ensureProfile();
    $user->profile->update(['bio' => 'Test bio']);

    $this->actingAs($user)
        ->get('/profile')
        ->assertOk()
        ->assertSee('Test bio');
});

it('renders the profile edit page', function () {
    $user = User::factory()->create();
    $user->ensureProfile();

    $this->actingAs($user)
        ->get('/profile/edit')
        ->assertOk()
        ->assertSee('Edit Profile');
});

it('can update profile', function () {
    $user = User::factory()->create();
    $user->ensureProfile();

    $this->actingAs($user)
        ->put('/profile/update', [
            'bio' => 'Test bio content',
            'location' => 'Portland, OR',
        ])
        ->assertRedirect();

    expect($user->fresh()->profile->bio)->toBe('Test bio content');
    expect($user->fresh()->profile->location)->toBe('Portland, OR');
});

it('can update account name and email', function () {
    $user = User::factory()->create();
    $user->ensureProfile();

    $this->actingAs($user)
        ->put('/profile/account', [
            'name' => 'updatedname',
            'email' => 'updated@example.com',
        ])
        ->assertRedirect();

    expect($user->fresh()->name)->toBe('updatedname');
    expect($user->fresh()->email)->toBe('updated@example.com');
});

it('can update password', function () {
    $user = User::factory()->create();
    $user->ensureProfile();

    $this->actingAs($user)
        ->put('/profile/password', [
            'password' => 'NewPassword123!',
            'password_confirmation' => 'NewPassword123!',
        ])
        ->assertRedirect();
});

it('can export user data', function () {
    $user = User::factory()->create();
    $user->ensureProfile();

    $this->actingAs($user)
        ->get('/profile/export')
        ->assertOk()
        ->assertJsonStructure(['user', 'profile', 'exported_at']);
});

it('renders the sessions page', function () {
    $user = User::factory()->create();
    $user->ensureProfile();

    $this->actingAs($user)
        ->get('/profile/sessions')
        ->assertOk()
        ->assertSee('Active Sessions');
});

it('can save dark mode preference', function () {
    $user = User::factory()->create();
    $user->ensureProfile();

    $this->actingAs($user)
        ->putJson('/profile/dark-mode', ['dark_mode' => 'dark'])
        ->assertOk()
        ->assertJson(['dark_mode' => 'dark']);

    expect($user->fresh()->profile->dark_mode)->toBe('dark');
});

it('renders the notifications page', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/notifications')
        ->assertOk();
});
