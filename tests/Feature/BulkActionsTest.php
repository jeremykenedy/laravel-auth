<?php

use App\Models\Role;
use App\Models\User;
use Database\Seeders\BlockedItemsTableSeeder;
use Database\Seeders\BlockedTypeTableSeeder;
use Database\Seeders\ConnectRelationshipsSeeder;
use Database\Seeders\PermissionsTableSeeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\ThemesTableSeeder;

beforeEach(function () {
    $this->seed(BlockedTypeTableSeeder::class);
    $this->seed(BlockedItemsTableSeeder::class);
    $this->seed(RolesTableSeeder::class);
    $this->seed(PermissionsTableSeeder::class);
    $this->seed(ConnectRelationshipsSeeder::class);
    $this->seed(ThemesTableSeeder::class);

    $this->admin = User::factory()->create();
    $this->admin->attachRole(Role::where('slug', 'admin')->first());
});

it('can bulk delete users', function () {
    $users = User::factory()->count(3)->create();

    $this->actingAs($this->admin)
        ->post(route('users.bulk'), [
            'action' => 'delete',
            'user_ids' => $users->pluck('id')->toArray(),
        ])
        ->assertRedirect('/users');

    foreach ($users as $user) {
        $this->assertSoftDeleted('users', ['id' => $user->id]);
    }
});

it('prevents bulk deletion of current user', function () {
    $other = User::factory()->create();

    $this->actingAs($this->admin)
        ->post(route('users.bulk'), [
            'action' => 'delete',
            'user_ids' => [$this->admin->id, $other->id],
        ])
        ->assertRedirect('/users');

    // Admin should not be deleted
    expect(User::find($this->admin->id))->not->toBeNull();
    // Other user should be deleted
    $this->assertSoftDeleted('users', ['id' => $other->id]);
});

it('can bulk activate users', function () {
    $users = User::factory()->count(2)->create(['activated' => 0]);

    $this->actingAs($this->admin)
        ->post(route('users.bulk'), [
            'action' => 'activate',
            'user_ids' => $users->pluck('id')->toArray(),
        ])
        ->assertRedirect('/users');

    foreach ($users as $user) {
        expect($user->fresh()->activated)->toBeTrue();
    }
});

it('can bulk deactivate users', function () {
    $users = User::factory()->count(2)->create(['activated' => 1]);

    $this->actingAs($this->admin)
        ->post(route('users.bulk'), [
            'action' => 'deactivate',
            'user_ids' => $users->pluck('id')->toArray(),
        ])
        ->assertRedirect('/users');

    foreach ($users as $user) {
        expect($user->fresh()->activated)->toBeFalse();
    }
});

it('can bulk change user roles', function () {
    $users = User::factory()->count(2)->create();
    $userRole = Role::where('slug', 'user')->first();
    foreach ($users as $user) {
        $user->attachRole($userRole);
    }

    $adminRole = Role::where('slug', 'admin')->first();

    $this->actingAs($this->admin)
        ->post(route('users.bulk'), [
            'action' => 'change_role',
            'user_ids' => $users->pluck('id')->toArray(),
            'role' => $adminRole->id,
        ])
        ->assertRedirect('/users');

    foreach ($users as $user) {
        expect($user->fresh()->roles->first()->slug)->toBe('admin');
    }
});

it('validates bulk action input', function () {
    $this->actingAs($this->admin)
        ->post(route('users.bulk'), [
            'action' => 'invalid',
            'user_ids' => [],
        ])
        ->assertSessionHasErrors(['action', 'user_ids']);
});

it('requires admin access for bulk actions', function () {
    $user = User::factory()->create();
    $userRole = Role::where('slug', 'user')->first();
    $user->attachRole($userRole);

    $this->actingAs($user)
        ->post(route('users.bulk'), [
            'action' => 'delete',
            'user_ids' => [1],
        ])
        ->assertStatus(403);
});
