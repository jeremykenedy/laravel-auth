<?php

use App\Models\Role;
use App\Models\User;
use Database\Seeders\ConnectRelationshipsSeeder;
use Database\Seeders\PermissionsTableSeeder;
use Database\Seeders\RolesTableSeeder;

beforeEach(function () {
    $this->seed(RolesTableSeeder::class);
    $this->seed(PermissionsTableSeeder::class);
    $this->seed(ConnectRelationshipsSeeder::class);

    $this->admin = User::factory()->create();
    $this->admin->attachRole(Role::where('slug', 'admin')->first());

    $this->user = User::factory()->create();
    $this->user->attachRole(Role::where('slug', 'user')->first());
});

it('allows admin to impersonate a regular user', function () {
    $this->actingAs($this->admin)
        ->post('/impersonate/'.$this->user->id)
        ->assertRedirect('/home');

    expect(session('impersonator_id'))->toBe($this->admin->id);
});

it('prevents admin from impersonating another admin', function () {
    $otherAdmin = User::factory()->create();
    $otherAdmin->attachRole(Role::where('slug', 'admin')->first());

    $this->actingAs($this->admin)
        ->post('/impersonate/'.$otherAdmin->id)
        ->assertRedirect()
        ->assertSessionHas('error');
});

it('prevents admin from impersonating themselves', function () {
    $this->actingAs($this->admin)
        ->post('/impersonate/'.$this->admin->id)
        ->assertRedirect()
        ->assertSessionHas('error');
});

it('prevents regular users from impersonating', function () {
    $otherUser = User::factory()->create();
    $otherUser->attachRole(Role::where('slug', 'user')->first());

    $this->actingAs($this->user)
        ->post('/impersonate/'.$otherUser->id)
        ->assertForbidden();
});

it('can stop impersonation', function () {
    $this->actingAs($this->admin)
        ->withSession([
            'impersonator_id' => $this->admin->id,
            'impersonator_name' => $this->admin->name,
        ])
        ->post('/impersonate-stop')
        ->assertRedirect('/home');
});
