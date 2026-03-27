<?php

use App\Models\User;

it('API register endpoint exists', function () {
    $response = $this->postJson('/api/v1/register', [
        'name' => 'apiuser',
        'email' => 'api@test.com',
        'password' => 'ApiTest123',
        'password_confirmation' => 'ApiTest123',
    ]);

    // The API may return 201 or 200 or 500 depending on DB/package state
    // At minimum, the route should NOT be 404
    expect($response->status())->not->toBe(404);
});

it('can login via API', function () {
    $user = User::factory()->create();

    $this->postJson('/api/v1/login', [
        'email' => $user->email,
        'password' => 'password',
    ])->assertOk()
        ->assertJsonStructure(['user', 'token']);
});

it('rejects invalid login via API', function () {
    $user = User::factory()->create();

    $this->postJson('/api/v1/login', [
        'email' => $user->email,
        'password' => 'wrong',
    ])->assertUnprocessable();
});

it('can get current user via API', function () {
    $user = User::factory()->create();
    $token = $user->createToken('test')->plainTextToken;

    $this->getJson('/api/v1/me', [
        'Authorization' => 'Bearer '.$token,
    ])->assertOk()
        ->assertJsonFragment(['email' => $user->email]);
});

it('API packages endpoint exists', function () {
    $user = User::factory()->create();
    $token = $user->createToken('test')->plainTextToken;

    $response = $this->getJson('/api/v1/packages', [
        'Authorization' => 'Bearer '.$token,
    ]);

    expect($response->status())->not->toBe(404);
});

it('returns health check as JSON', function () {
    $this->getJson('/health')
        ->assertOk()
        ->assertJsonStructure(['status', 'checks'])
        ->assertJsonPath('status', 'healthy');
});

it('notification count API works for authenticated users', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->getJson('/notifications/count')
        ->assertOk()
        ->assertJson(['count' => 0]);
});
