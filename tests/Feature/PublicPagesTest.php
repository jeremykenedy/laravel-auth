<?php

it('renders the welcome page', function () {
    $this->get('/')->assertOk();
});

it('renders the terms page', function () {
    $this->get('/terms')->assertOk();
});

it('renders the login page', function () {
    $this->get('/login')->assertOk()->assertSee('Log in');
});

it('renders the register page', function () {
    $this->get('/register')->assertOk()->assertSee('Create your account');
});

it('renders the forgot password page', function () {
    $this->get('/forgot-password')->assertOk();
});

it('renders social login buttons on login page', function () {
    $this->get('/login')->assertOk()->assertSee('Or continue with');
});

it('renders the blog index', function () {
    $this->get('/posts')->assertOk()->assertSee('Blog');
});

it('redirects php to phpinfo', function () {
    $this->get('/php')->assertRedirect('/phpinfo');
});

it('redirects unauthenticated users from home', function () {
    $this->get('/home')->assertRedirect('/login');
});

it('redirects unauthenticated users from admin pages', function () {
    $this->get('/users')->assertRedirect('/login');
    $this->get('/routes')->assertRedirect('/login');
    $this->get('/settings')->assertRedirect('/login');
});

it('returns health check', function () {
    $this->get('/health')->assertOk();
});
