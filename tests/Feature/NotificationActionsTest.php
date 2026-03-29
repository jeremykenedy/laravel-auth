<?php

use App\Models\User;
use Database\Seeders\PermissionsTableSeeder;
use Database\Seeders\RolesTableSeeder;
use Illuminate\Support\Str;

beforeEach(function () {
    $this->seed(RolesTableSeeder::class);
    $this->seed(PermissionsTableSeeder::class);

    $this->user = User::factory()->create();
});

it('displays notifications index page', function () {
    $this->actingAs($this->user)
        ->get('/notifications')
        ->assertOk()
        ->assertSee('All caught up');
});

it('displays notifications with titles and messages', function () {
    $this->user->notifications()->create([
        'id' => Str::uuid()->toString(),
        'type' => 'App\\Notifications\\WelcomeNotification',
        'data' => ['title' => 'Welcome Aboard', 'message' => 'Thanks for joining us'],
    ]);

    $this->actingAs($this->user)
        ->get('/notifications')
        ->assertOk()
        ->assertSee('Welcome Aboard')
        ->assertSee('Thanks for joining us');
});

it('marks a single notification as read', function () {
    $notifId = Str::uuid()->toString();
    $this->user->notifications()->create([
        'id' => $notifId,
        'type' => 'App\\Notifications\\TestNotification',
        'data' => ['title' => 'Test', 'message' => 'Test'],
    ]);

    expect($this->user->unreadNotifications()->count())->toBe(1);

    $this->actingAs($this->user)
        ->post("/notifications/{$notifId}/read")
        ->assertRedirect();

    expect($this->user->refresh()->unreadNotifications()->count())->toBe(0);
});

it('marks all notifications as read', function () {
    for ($i = 0; $i < 3; $i++) {
        $this->user->notifications()->create([
            'id' => Str::uuid()->toString(),
            'type' => 'App\\Notifications\\TestNotification',
            'data' => ['title' => "Test {$i}", 'message' => "Msg {$i}"],
        ]);
    }

    expect($this->user->unreadNotifications()->count())->toBe(3);

    $this->actingAs($this->user)
        ->post('/notifications/read-all')
        ->assertRedirect();

    expect($this->user->refresh()->unreadNotifications()->count())->toBe(0);
});

it('deletes a single notification', function () {
    $notifId = Str::uuid()->toString();
    $this->user->notifications()->create([
        'id' => $notifId,
        'type' => 'App\\Notifications\\TestNotification',
        'data' => ['title' => 'Delete me', 'message' => 'Gone soon'],
    ]);

    expect($this->user->notifications()->count())->toBe(1);

    $this->actingAs($this->user)
        ->delete("/notifications/{$notifId}")
        ->assertRedirect();

    expect($this->user->refresh()->notifications()->count())->toBe(0);
});

it('deletes all notifications', function () {
    for ($i = 0; $i < 3; $i++) {
        $this->user->notifications()->create([
            'id' => Str::uuid()->toString(),
            'type' => 'App\\Notifications\\TestNotification',
            'data' => ['title' => "Test {$i}", 'message' => "Msg {$i}"],
        ]);
    }

    expect($this->user->notifications()->count())->toBe(3);

    $this->actingAs($this->user)
        ->delete('/notifications')
        ->assertRedirect();

    expect($this->user->refresh()->notifications()->count())->toBe(0);
});

it('returns notification count as json', function () {
    $this->user->notifications()->create([
        'id' => Str::uuid()->toString(),
        'type' => 'App\\Notifications\\TestNotification',
        'data' => ['title' => 'Test', 'message' => 'Test'],
    ]);

    $this->actingAs($this->user)
        ->getJson('/notifications/count')
        ->assertOk()
        ->assertJson(['count' => 1]);
});

it('count decreases after marking notification as read', function () {
    $notifId = Str::uuid()->toString();
    $this->user->notifications()->create([
        'id' => $notifId,
        'type' => 'App\\Notifications\\TestNotification',
        'data' => ['title' => 'Test', 'message' => 'Test'],
    ]);

    $this->actingAs($this->user)
        ->getJson('/notifications/count')
        ->assertJson(['count' => 1]);

    $this->actingAs($this->user)
        ->post("/notifications/{$notifId}/read");

    $this->actingAs($this->user)
        ->getJson('/notifications/count')
        ->assertJson(['count' => 0]);
});

it('requires authentication to access notifications', function () {
    $this->get('/notifications')
        ->assertRedirect('/login');
});
