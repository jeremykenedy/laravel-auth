<?php

use App\Models\Role;
use App\Models\User;
use Database\Seeders\PermissionsTableSeeder;
use Database\Seeders\RolesTableSeeder;
use Illuminate\Support\Str;

beforeEach(function () {
    $this->seed(RolesTableSeeder::class);
    $this->seed(PermissionsTableSeeder::class);
});

it('sends welcome notification on registration', function () {
    $this->post('/register', [
        'name' => 'notiftest',
        'email' => 'notif@test.com',
        'password' => 'Password123',
        'password_confirmation' => 'Password123',
    ]);

    $user = User::where('email', 'notif@test.com')->first();
    expect($user->notifications)->toHaveCount(1);
    expect($user->notifications->first()->data['title'])->toContain('Welcome');
});

it('notifies admins when new user registers', function () {
    // Create an admin first
    $admin = User::factory()->create();
    $admin->attachRole(Role::where('slug', 'admin')->first());

    // Register a new user
    $this->post('/register', [
        'name' => 'newreg',
        'email' => 'newreg@test.com',
        'password' => 'Password123',
        'password_confirmation' => 'Password123',
    ]);

    // Admin should have a notification
    $admin->refresh();
    $notification = $admin->notifications->first();
    expect($notification)->not->toBeNull();
    expect($notification->data['title'])->toBe('New User Registered');
    expect($notification->data['message'])->toContain('newreg');
});

it('notification count reflects unread notifications', function () {
    $user = User::factory()->create();

    // No notifications
    $this->actingAs($user)
        ->getJson('/notifications/count')
        ->assertJson(['count' => 0]);

    // Create a notification
    $user->notifications()->create([
        'id' => Str::uuid()->toString(),
        'type' => 'App\\Notifications\\TestNotification',
        'data' => ['title' => 'Test', 'message' => 'Test notification'],
    ]);

    // Now count should be 1
    $this->actingAs($user)
        ->getJson('/notifications/count')
        ->assertJson(['count' => 1]);
});
