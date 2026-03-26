<?php

use App\Models\User;

it('can render the login page', function () {
    $this->get('/login')->assertOk();
});

it('can authenticate a user', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
});

it('rejects invalid credentials', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

it('can register a new user', function () {
    $this->post('/register', [
        'name' => 'testuser',
        'email' => 'test@example.com',
        'password' => 'Password123!',
        'password_confirmation' => 'Password123!',
    ])->assertRedirect('/home');

    $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
});

it('creates a profile on registration', function () {
    $this->post('/register', [
        'name' => 'profiletest',
        'email' => 'profile@example.com',
        'password' => 'Password123!',
        'password_confirmation' => 'Password123!',
    ]);

    $user = User::where('email', 'profile@example.com')->first();
    expect($user->profile)->not->toBeNull();
});

it('can log out', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post('/logout');

    $this->assertGuest();
});

it('redirects unverified users to verification page', function () {
    $user = User::factory()->unverified()->create();

    $this->actingAs($user)
        ->get('/home')
        ->assertRedirect('/verify-email');
});

it('renders the verify email page for unverified users', function () {
    $user = User::factory()->unverified()->create();

    $this->actingAs($user)
        ->get('/verify-email')
        ->assertOk()
        ->assertSee('Verify Your Email');
});

it('allows verified users to access home', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/home')
        ->assertOk()
        ->assertSee('Welcome');
});
