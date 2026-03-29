<?php

use Illuminate\Support\Facades\Artisan;

// ========================================================================
// Install commands exist and run for all frontend packages
// ========================================================================

it('ui:switch command exists and runs', function () {
    $this->artisan('ui:switch --css=tailwind')
        ->assertSuccessful();
});

it('ui:switch rejects invalid css', function () {
    $this->artisan('ui:switch --css=invalid')
        ->assertFailed();
});

it('ui:switch rejects invalid frontend', function () {
    $this->artisan('ui:switch --frontend=invalid')
        ->assertFailed();
});

it('ui:switch requires at least one option', function () {
    $this->artisan('ui:switch')
        ->assertFailed();
});

it('every package has an install command', function () {
    $commands = [
        '2step:install',
        'auth-api:install',
        'avatar:install',
        'blocker:install',
        'captcha:install',
        'chat:install',
        'darkmode:install',
        'email-log:install',
        'exception-notifier:install',
        'face-auth:install',
        'logger:install',
        'native-kit:install',
        'notifications:install',
        'observability:install',
        'phpinfo:install',
        'posts:install',
        'profiles:install',
        'roles:install',
        'simple-search:install',
        'socialite-kit:install',
        'themes:install',
        'toast:install',
        'ui-kit:install',
        'users:install',
    ];

    $registered = array_keys(Artisan::all());

    foreach ($commands as $cmd) {
        expect($registered)->toContain($cmd);
    }
});

// ========================================================================
// Each install command runs without error
// ========================================================================

it('blocker:install runs successfully', function () {
    $this->artisan('blocker:install --css=tailwind --frontend=blade')->assertSuccessful();
});

it('captcha:install runs successfully', function () {
    $this->artisan('captcha:install --css=tailwind --frontend=blade')->assertSuccessful();
});

it('face-auth:install runs successfully', function () {
    $this->artisan('face-auth:install --css=tailwind --frontend=blade')->assertSuccessful();
});

it('logger:install runs successfully', function () {
    $this->artisan('logger:install --css=tailwind --frontend=blade')->assertSuccessful();
});

it('phpinfo:install runs successfully', function () {
    $this->artisan('phpinfo:install --css=tailwind --frontend=blade')->assertSuccessful();
});

it('roles:install runs successfully', function () {
    $this->artisan('roles:install --css=tailwind --frontend=blade')->assertSuccessful();
});

it('simple-search:install runs successfully', function () {
    $this->artisan('simple-search:install --css=tailwind --frontend=blade')->assertSuccessful();
});

it('users:install runs successfully', function () {
    $this->artisan('users:install --css=tailwind --frontend=blade')->assertSuccessful();
});

it('2step:install runs successfully', function () {
    $this->artisan('2step:install --css=tailwind --frontend=blade')->assertSuccessful();
});

it('avatar:install runs successfully', function () {
    $this->artisan('avatar:install --css=tailwind --frontend=blade')->assertSuccessful();
});

it('auth-api:install runs successfully', function () {
    $this->artisan('auth-api:install')->assertSuccessful();
});

it('email-log:install runs successfully', function () {
    $this->artisan('email-log:install')->assertSuccessful();
});

it('exception-notifier:install runs successfully', function () {
    $this->artisan('exception-notifier:install')->assertSuccessful();
});

it('native-kit:install runs successfully', function () {
    $this->artisan('native-kit:install')->assertSuccessful();
});

it('observability:install command is registered', function () {
    expect(array_keys(Artisan::all()))->toContain('observability:install');
});

it('observability:update command is registered', function () {
    expect(array_keys(Artisan::all()))->toContain('observability:update');
});

it('ui-kit:install runs successfully', function () {
    $this->artisan('ui-kit:install')->assertSuccessful();
});

// ========================================================================
// CSS framework switching via ui:switch
// ========================================================================

it('can switch to bootstrap5', function () {
    $this->artisan('ui:switch --css=bootstrap5')->assertSuccessful();
});

it('can switch to bootstrap4', function () {
    $this->artisan('ui:switch --css=bootstrap4')->assertSuccessful();
});

it('can switch to tailwind', function () {
    $this->artisan('ui:switch --css=tailwind')->assertSuccessful();
});

// ========================================================================
// Frontend framework switching via ui:switch
// ========================================================================

it('can switch frontend to livewire', function () {
    $this->artisan('ui:switch --frontend=livewire')->assertSuccessful();
});

it('can switch frontend to vue', function () {
    $this->artisan('ui:switch --frontend=vue')->assertSuccessful();
});

it('can switch frontend to react', function () {
    $this->artisan('ui:switch --frontend=react')->assertSuccessful();
});

it('can switch frontend to svelte', function () {
    $this->artisan('ui:switch --frontend=svelte')->assertSuccessful();
});

it('can switch frontend to blade', function () {
    $this->artisan('ui:switch --frontend=blade')->assertSuccessful();
});

// ========================================================================
// Combined CSS + frontend switch
// ========================================================================

it('can switch both css and frontend at once', function () {
    $this->artisan('ui:switch --css=bootstrap5 --frontend=livewire')->assertSuccessful();
});
