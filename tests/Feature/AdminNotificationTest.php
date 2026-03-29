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

it('shows the send notification form', function () {
    $this->actingAs($this->admin)
        ->get(route('notifications.send.create'))
        ->assertOk()
        ->assertSee('Send Notification')
        ->assertSee('Title');
});

it('can send notification to all users', function () {
    $users = User::factory()->count(3)->create();

    $this->actingAs($this->admin)
        ->post(route('notifications.send.store'), [
            'title' => 'Test Broadcast',
            'message' => 'This is a test broadcast notification.',
            'audience' => 'all',
        ])
        ->assertRedirect(route('notifications.send.create'));

    // All users (including admin + 3 created) should have the notification
    foreach ($users as $user) {
        $notification = $user->notifications->first();
        expect($notification)->not->toBeNull();
        expect($notification->data['title'])->toBe('Test Broadcast');
    }
});

it('can send notification to specific role', function () {
    $adminUser = User::factory()->create();
    $adminUser->attachRole(Role::where('slug', 'admin')->first());

    $regularUser = User::factory()->create();
    $regularUser->attachRole(Role::where('slug', 'user')->first());

    $adminRoleId = Role::where('slug', 'admin')->first()->id;

    $this->actingAs($this->admin)
        ->post(route('notifications.send.store'), [
            'title' => 'Admin Only Notice',
            'message' => 'For admins only.',
            'audience' => 'role',
            'role_id' => $adminRoleId,
        ])
        ->assertRedirect(route('notifications.send.create'));

    // Admin users should have notification
    expect($adminUser->fresh()->notifications)->toHaveCount(1);
    // Regular user should not
    expect($regularUser->fresh()->notifications)->toHaveCount(0);
});

it('includes action url in notification', function () {
    $user = User::factory()->create();

    $this->actingAs($this->admin)
        ->post(route('notifications.send.store'), [
            'title' => 'Update Available',
            'message' => 'Please check the changelog.',
            'audience' => 'all',
            'action_url' => 'https://example.com/changelog',
            'action_text' => 'View Changelog',
        ])
        ->assertRedirect();

    $notification = $user->fresh()->notifications->first();
    expect($notification->data['action_url'])->toBe('https://example.com/changelog');
    expect($notification->data['action_text'])->toBe('View Changelog');
});

it('validates notification input', function () {
    $this->actingAs($this->admin)
        ->post(route('notifications.send.store'), [])
        ->assertSessionHasErrors(['title', 'message', 'audience']);
});

it('denies regular users from sending notifications', function () {
    $user = User::factory()->create();
    $user->attachRole(Role::where('slug', 'user')->first());

    $this->actingAs($user)
        ->get(route('notifications.send.create'))
        ->assertStatus(403);
});
