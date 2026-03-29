<?php

use App\Models\User;

it('welcome page renders successfully', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee(config('app.name'));
});

it('welcome page has dark mode init script', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('localStorage.getItem(key)', false)
        ->assertSee('classList.add(cls)', false);
});

it('welcome page has x-cloak style', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('[x-cloak]', false);
});

it('welcome page has csrf meta tag', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('csrf-token', false);
});

it('welcome page has theme toggle component', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('Toggle theme', false);
});

it('welcome page shows login and register links for guests', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('Log in')
        ->assertSee('Register');
});

it('welcome page shows home link for authenticated users', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/')
        ->assertOk()
        ->assertSee('Home');
});

it('welcome page has dark mode body class', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('dark:bg-[#0a0a0a]', false)
        ->assertSee('dark:text-[#EDEDEC]', false);
});
