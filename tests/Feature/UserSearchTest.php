<?php

use App\Models\Role;
use App\Models\User;
use Database\Seeders\PermissionsTableSeeder;
use Database\Seeders\RolesTableSeeder;

beforeEach(function () {
    $this->seed(RolesTableSeeder::class);
    $this->seed(PermissionsTableSeeder::class);

    $this->admin = User::factory()->create(['name' => 'AdminSearcher']);
    $this->admin->attachRole(Role::where('slug', 'admin')->first());

    User::factory()->create(['name' => 'JohnDoe', 'email' => 'john@example.com']);
    User::factory()->create(['name' => 'JaneDoe', 'email' => 'jane@example.com']);
});

it('can search users by name', function () {
    $this->actingAs($this->admin)
        ->postJson('/search-users', ['user_search_box' => 'John'])
        ->assertOk()
        ->assertJsonFragment(['name' => 'JohnDoe']);
});

it('can search users by email', function () {
    $this->actingAs($this->admin)
        ->postJson('/search-users', ['user_search_box' => 'jane@'])
        ->assertOk()
        ->assertJsonFragment(['email' => 'jane@example.com']);
});

it('returns empty for no matches', function () {
    $this->actingAs($this->admin)
        ->postJson('/search-users', ['user_search_box' => 'nonexistent999'])
        ->assertOk()
        ->assertJsonCount(0);
});

it('requires search input', function () {
    $this->actingAs($this->admin)
        ->postJson('/search-users', [])
        ->assertUnprocessable();
});
