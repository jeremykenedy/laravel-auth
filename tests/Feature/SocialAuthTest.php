<?php

it('has social redirect route', function () {
    // Social redirect exists but will fail without OAuth credentials configured
    // Test that the route is registered and returns a redirect (to OAuth provider)
    // or an error (missing credentials), not a 404
    $response = $this->get('/social/redirect/github');
    expect($response->status())->not->toBe(404);
});

it('has social callback route', function () {
    $response = $this->get('/social/callback/github');
    expect($response->status())->not->toBe(404);
});

it('renders social buttons on login page', function () {
    $this->get('/login')
        ->assertOk()
        ->assertSee('Or continue with');
});

it('renders social buttons on register page', function () {
    $this->get('/register')
        ->assertOk()
        ->assertSee('Or continue with');
});
