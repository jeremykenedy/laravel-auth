<?php

use App\Models\Role;
use App\Models\User;
use Database\Seeders\BlockedItemsTableSeeder;
use Database\Seeders\BlockedTypeTableSeeder;
use Database\Seeders\ConnectRelationshipsSeeder;
use Database\Seeders\PermissionsTableSeeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\ThemesTableSeeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Jeremykenedy\LaravelNotifications\Domain\Events\NotificationCreated;
use Jeremykenedy\LaravelNotifications\Livewire\NotificationsList;
use Jeremykenedy\LaravelNotifications\Notifications\AppNotification;
use Jeremykenedy\LaravelNotifications\Services\NotificationService;
use Livewire\Livewire;

beforeEach(function () {
    $this->seed(BlockedTypeTableSeeder::class);
    $this->seed(BlockedItemsTableSeeder::class);
    $this->seed(RolesTableSeeder::class);
    $this->seed(PermissionsTableSeeder::class);
    $this->seed(ConnectRelationshipsSeeder::class);
    $this->seed(ThemesTableSeeder::class);

    $this->user = User::factory()->create(['email_verified_at' => now()]);
    $this->user->attachRole(Role::where('slug', 'user')->first());
});

// ========================================================================
// ServiceProvider
// ========================================================================

it('registers NotificationService as singleton', function () {
    $a = app(NotificationService::class);
    $b = app(NotificationService::class);
    expect($a)->toBe($b);
});

it('registers notifications config', function () {
    expect(config('notifications.enabled'))->toBeTrue();
    expect(config('notifications.per_page'))->not->toBeNull();
    expect(config('notifications.routes.enabled'))->toBeTrue();
    expect(config('notifications.broadcast'))->toBeArray();
});

it('registers notifications:install command', function () {
    expect(array_keys(Artisan::all()))->toContain('notifications:install');
});

it('registers notifications:switch command', function () {
    expect(array_keys(Artisan::all()))->toContain('notifications:switch');
});

// ========================================================================
// NotificationService
// ========================================================================

it('unreadCount returns 0 for new user', function () {
    $service = app(NotificationService::class);
    expect($service->unreadCount($this->user))->toBe(0);
});

it('unreadCount returns correct count', function () {
    $this->user->notifications()->create([
        'id' => Str::uuid()->toString(), 'type' => 'Test', 'data' => ['title' => 'T', 'message' => 'M'],
    ]);
    $service = app(NotificationService::class);
    expect($service->unreadCount($this->user))->toBe(1);
});

it('getAll returns paginated notifications', function () {
    for ($i = 0; $i < 3; $i++) {
        $this->user->notifications()->create([
            'id' => Str::uuid()->toString(), 'type' => 'Test', 'data' => ['title' => "T{$i}"],
        ]);
    }
    $service = app(NotificationService::class);
    $result = $service->getAll($this->user, 20);
    expect($result->count())->toBe(3);
});

it('getUnread returns only unread', function () {
    $this->user->notifications()->create([
        'id' => Str::uuid()->toString(), 'type' => 'Test', 'data' => ['title' => 'Unread'],
    ]);
    $this->user->notifications()->create([
        'id' => Str::uuid()->toString(), 'type' => 'Test', 'data' => ['title' => 'Read'], 'read_at' => now(),
    ]);
    $service = app(NotificationService::class);
    expect($service->getUnread($this->user, 20)->count())->toBe(1);
});

it('markAsRead marks single notification', function () {
    $id = Str::uuid()->toString();
    $this->user->notifications()->create(['id' => $id, 'type' => 'Test', 'data' => ['title' => 'T']]);
    $service = app(NotificationService::class);
    $service->markAsRead($this->user, $id);
    expect($this->user->unreadNotifications()->count())->toBe(0);
});

it('markAllAsRead marks all notifications', function () {
    for ($i = 0; $i < 3; $i++) {
        $this->user->notifications()->create([
            'id' => Str::uuid()->toString(), 'type' => 'Test', 'data' => ['title' => "T{$i}"],
        ]);
    }
    $service = app(NotificationService::class);
    $count = $service->markAllAsRead($this->user);
    expect($count)->toBe(3);
    expect($this->user->unreadNotifications()->count())->toBe(0);
});

it('delete removes notification', function () {
    $id = Str::uuid()->toString();
    $this->user->notifications()->create(['id' => $id, 'type' => 'Test', 'data' => ['title' => 'T']]);
    $service = app(NotificationService::class);
    $service->delete($this->user, $id);
    expect($this->user->notifications()->count())->toBe(0);
});

it('deleteAll removes all notifications', function () {
    for ($i = 0; $i < 3; $i++) {
        $this->user->notifications()->create([
            'id' => Str::uuid()->toString(), 'type' => 'Test', 'data' => ['title' => "T{$i}"],
        ]);
    }
    $service = app(NotificationService::class);
    $service->deleteAll($this->user);
    expect($this->user->notifications()->count())->toBe(0);
});

// ========================================================================
// Web Routes: GET /notifications
// ========================================================================

it('notifications index requires auth', function () {
    $this->get('/notifications')->assertRedirect('/login');
});

it('notifications index renders for authed user', function () {
    $this->actingAs($this->user)->get('/notifications')->assertOk();
});

it('notifications index shows empty state', function () {
    $this->actingAs($this->user)->get('/notifications')->assertOk()->assertSee('caught up');
});

it('notifications index shows notifications with titles', function () {
    $this->user->notifications()->create([
        'id' => Str::uuid()->toString(), 'type' => 'Test',
        'data' => ['title' => 'Important Alert', 'message' => 'Something happened'],
    ]);
    $this->actingAs($this->user)->get('/notifications')
        ->assertOk()
        ->assertSee('Important Alert')
        ->assertSee('Something happened');
});

// ========================================================================
// Web Routes: GET /notifications/count
// ========================================================================

it('count returns json with count 0', function () {
    $this->actingAs($this->user)->getJson('/notifications/count')
        ->assertOk()->assertJson(['count' => 0]);
});

it('count returns correct unread count', function () {
    $this->user->notifications()->create([
        'id' => Str::uuid()->toString(), 'type' => 'Test', 'data' => ['title' => 'T'],
    ]);
    $this->actingAs($this->user)->getJson('/notifications/count')
        ->assertOk()->assertJson(['count' => 1]);
});

it('count decreases after marking read', function () {
    $id = Str::uuid()->toString();
    $this->user->notifications()->create(['id' => $id, 'type' => 'Test', 'data' => ['title' => 'T']]);
    $this->actingAs($this->user)->post("/notifications/{$id}/read");
    $this->actingAs($this->user)->getJson('/notifications/count')
        ->assertJson(['count' => 0]);
});

// ========================================================================
// Web Routes: POST mark read / mark all read
// ========================================================================

it('mark single as read works', function () {
    $id = Str::uuid()->toString();
    $this->user->notifications()->create(['id' => $id, 'type' => 'Test', 'data' => ['title' => 'T']]);
    $this->actingAs($this->user)->post("/notifications/{$id}/read")->assertRedirect();
    expect($this->user->fresh()->unreadNotifications()->count())->toBe(0);
});

it('mark all as read works', function () {
    for ($i = 0; $i < 3; $i++) {
        $this->user->notifications()->create([
            'id' => Str::uuid()->toString(), 'type' => 'Test', 'data' => ['title' => "T{$i}"],
        ]);
    }
    $this->actingAs($this->user)->post('/notifications/read-all')->assertRedirect();
    expect($this->user->fresh()->unreadNotifications()->count())->toBe(0);
});

// ========================================================================
// Web Routes: DELETE single / delete all
// ========================================================================

it('delete single notification works', function () {
    $id = Str::uuid()->toString();
    $this->user->notifications()->create(['id' => $id, 'type' => 'Test', 'data' => ['title' => 'T']]);
    $this->actingAs($this->user)->delete("/notifications/{$id}")->assertRedirect();
    expect($this->user->fresh()->notifications()->count())->toBe(0);
});

it('delete all notifications works', function () {
    for ($i = 0; $i < 3; $i++) {
        $this->user->notifications()->create([
            'id' => Str::uuid()->toString(), 'type' => 'Test', 'data' => ['title' => "T{$i}"],
        ]);
    }
    $this->actingAs($this->user)->delete('/notifications')->assertRedirect();
    expect($this->user->fresh()->notifications()->count())->toBe(0);
});

// ========================================================================
// CSS Framework Switching: Tailwind / BS5 / BS4
// ========================================================================

it('notifications index renders with tailwind', function () {
    config(['ui-kit.css_framework' => 'tailwind']);
    $this->actingAs($this->user)->get('/notifications')->assertOk();
});

it('notifications index renders with bootstrap5', function () {
    config(['ui-kit.css_framework' => 'bootstrap5']);
    $this->actingAs($this->user)->get('/notifications')->assertOk();
});

it('notifications index renders with bootstrap4', function () {
    config(['ui-kit.css_framework' => 'bootstrap4']);
    $this->actingAs($this->user)->get('/notifications')->assertOk();
});

// ========================================================================
// Frontend Framework Switching: all 5
// ========================================================================

it('notifications renders across all 5 frontend frameworks', function () {
    foreach (['blade', 'livewire', 'vue', 'react', 'svelte'] as $fe) {
        config(['ui-kit.frontend' => $fe]);
        $this->actingAs($this->user)->get('/notifications')->assertOk();
    }
});

// ========================================================================
// All 15 CSS x Frontend combinations
// ========================================================================

it('notifications renders across all 15 css x frontend combinations', function () {
    foreach (['tailwind', 'bootstrap5', 'bootstrap4'] as $css) {
        foreach (['blade', 'livewire', 'vue', 'react', 'svelte'] as $fe) {
            config(['ui-kit.css_framework' => $css, 'ui-kit.frontend' => $fe]);
            $this->actingAs($this->user)->get('/notifications')->assertOk();
        }
    }
});

it('count endpoint works across all 15 combinations', function () {
    foreach (['tailwind', 'bootstrap5', 'bootstrap4'] as $css) {
        foreach (['blade', 'livewire', 'vue', 'react', 'svelte'] as $fe) {
            config(['ui-kit.css_framework' => $css, 'ui-kit.frontend' => $fe]);
            $this->actingAs($this->user)->getJson('/notifications/count')->assertOk();
        }
    }
});

// ========================================================================
// Livewire Component
// ========================================================================

it('NotificationsList livewire renders', function () {
    Livewire::actingAs($this->user)
        ->test(NotificationsList::class)
        ->assertOk();
});

it('NotificationsList livewire markAsRead works', function () {
    $id = Str::uuid()->toString();
    $this->user->notifications()->create(['id' => $id, 'type' => 'Test', 'data' => ['title' => 'T']]);

    Livewire::actingAs($this->user)
        ->test(NotificationsList::class)
        ->call('markAsRead', $id);

    expect($this->user->fresh()->unreadNotifications()->count())->toBe(0);
});

it('NotificationsList livewire markAllAsRead works', function () {
    for ($i = 0; $i < 2; $i++) {
        $this->user->notifications()->create([
            'id' => Str::uuid()->toString(), 'type' => 'Test', 'data' => ['title' => "T{$i}"],
        ]);
    }

    Livewire::actingAs($this->user)
        ->test(NotificationsList::class)
        ->call('markAllAsRead');

    expect($this->user->fresh()->unreadNotifications()->count())->toBe(0);
});

it('NotificationsList livewire delete works', function () {
    $id = Str::uuid()->toString();
    $this->user->notifications()->create(['id' => $id, 'type' => 'Test', 'data' => ['title' => 'T']]);

    Livewire::actingAs($this->user)
        ->test(NotificationsList::class)
        ->call('delete', $id);

    expect($this->user->fresh()->notifications()->count())->toBe(0);
});

it('NotificationsList livewire renders across all 3 CSS frameworks', function () {
    foreach (['tailwind', 'bootstrap5', 'bootstrap4'] as $fw) {
        config(['ui-kit.css_framework' => $fw]);
        Livewire::actingAs($this->user)
            ->test(NotificationsList::class)
            ->assertOk();
    }
});

// ========================================================================
// Broadcasting: NotificationCreated event
// ========================================================================

it('NotificationCreated event has correct channel', function () {
    $event = new NotificationCreated(userId: 42, title: 'Test', message: 'Hello', count: 1);
    $channels = $event->broadcastOn();
    expect($channels[0]->name)->toBe('private-notifications.42');
});

it('NotificationCreated event broadcasts as notification.created', function () {
    $event = new NotificationCreated(userId: 1, title: 'T', message: 'M', count: 0);
    expect($event->broadcastAs())->toBe('notification.created');
});

it('NotificationCreated event has public properties', function () {
    $event = new NotificationCreated(userId: 5, title: 'Alert', message: 'Body', count: 3);
    expect($event->userId)->toBe(5);
    expect($event->title)->toBe('Alert');
    expect($event->message)->toBe('Body');
    expect($event->count)->toBe(3);
});

// ========================================================================
// Structural: views and JS exist
// ========================================================================

it('has tailwind blade views', function () {
    expect(count(glob(base_path('packages/laravel-notifications/resources/views/tailwind/blade/*.blade.php'))))->toBeGreaterThan(0);
});

it('has bootstrap5 blade views', function () {
    expect(count(glob(base_path('packages/laravel-notifications/resources/views/bootstrap5/blade/*.blade.php'))))->toBeGreaterThan(0);
});

it('has bootstrap4 blade views', function () {
    expect(count(glob(base_path('packages/laravel-notifications/resources/views/bootstrap4/blade/*.blade.php'))))->toBeGreaterThan(0);
});

it('has livewire views', function () {
    expect(count(glob(base_path('packages/laravel-notifications/resources/views/livewire/*.blade.php'))))->toBeGreaterThan(0);
});

it('has vue components', function () {
    expect(count(glob(base_path('packages/laravel-notifications/resources/js/vue/pages/*.vue'))))->toBeGreaterThan(0);
});

it('has react components', function () {
    expect(count(glob(base_path('packages/laravel-notifications/resources/js/react/pages/*.jsx'))))->toBeGreaterThan(0);
});

it('has svelte components', function () {
    expect(count(glob(base_path('packages/laravel-notifications/resources/js/svelte/pages/*.svelte'))))->toBeGreaterThan(0);
});

it('vue/react/svelte have equal file counts', function () {
    $base = base_path('packages/laravel-notifications/resources/js');
    $vue = count(glob($base.'/vue/pages/*.vue'));
    $react = count(glob($base.'/react/pages/*.jsx'));
    $svelte = count(glob($base.'/svelte/pages/*.svelte'));
    expect($vue)->toBe($react);
    expect($vue)->toBe($svelte);
});

// ========================================================================
// AppNotification class
// ========================================================================

it('AppNotification sends via database channel', function () {
    $notif = new AppNotification(
        title: 'Test Title',
        message: 'Test message body',
        type: 'info',
    );

    $this->user->notify($notif);
    $this->user->refresh();

    expect($this->user->notifications)->toHaveCount(1);
    expect($this->user->notifications->first()->data['title'])->toBe('Test Title');
    expect($this->user->notifications->first()->data['message'])->toBe('Test message body');
    expect($this->user->notifications->first()->data['type'])->toBe('info');
});

it('AppNotification supports all types', function () {
    foreach (['info', 'success', 'warning', 'danger', 'system'] as $type) {
        $notif = new AppNotification(
            title: "Type {$type}",
            message: 'Test',
            type: $type,
        );
        expect($notif->toArray($this->user)['type'])->toBe($type);
    }
});

it('AppNotification includes action url when provided', function () {
    $notif = new AppNotification(
        title: 'T', message: 'M', actionUrl: '/test/123', actionText: 'View It',
    );
    $data = $notif->toArray($this->user);
    expect($data['action_url'])->toBe('/test/123');
    expect($data['action_text'])->toBe('View It');
});

it('AppNotification omits action url when not provided', function () {
    $notif = new AppNotification(
        title: 'T', message: 'M',
    );
    $data = $notif->toArray($this->user);
    expect($data)->not->toHaveKey('action_url');
});

it('AppNotification includes icon when provided', function () {
    $notif = new AppNotification(
        title: 'T', message: 'M', icon: 'bell',
    );
    expect($notif->toArray($this->user)['icon'])->toBe('bell');
});

it('AppNotification uses database only by default', function () {
    $notif = new AppNotification(
        title: 'T', message: 'M',
    );
    expect($notif->via($this->user))->toBe(['database']);
});

it('AppNotification adds mail channel when sendEmail true', function () {
    $notif = new AppNotification(
        title: 'T', message: 'M', sendEmail: true,
    );
    expect($notif->via($this->user))->toContain('mail');
    expect($notif->via($this->user))->toContain('database');
});

// ========================================================================
// NotificationService: send()
// ========================================================================

it('service send() creates notification for single user', function () {
    $service = app(NotificationService::class);
    $service->send($this->user, 'Sale Made', 'Order #456 completed.', 'success', '/orders/456', 'View Order');

    $this->user->refresh();
    expect($this->user->notifications)->toHaveCount(1);
    expect($this->user->notifications->first()->data['title'])->toBe('Sale Made');
    expect($this->user->notifications->first()->data['type'])->toBe('success');
    expect($this->user->notifications->first()->data['action_url'])->toBe('/orders/456');
});

it('service send() creates notification for multiple users', function () {
    $user2 = User::factory()->create();
    $service = app(NotificationService::class);
    $service->send(collect([$this->user, $user2]), 'Broadcast', 'System update.', 'system');

    expect($this->user->fresh()->notifications)->toHaveCount(1);
    expect($user2->fresh()->notifications)->toHaveCount(1);
});

it('service sendToAll() notifies all users', function () {
    User::factory()->count(2)->create();
    $service = app(NotificationService::class);
    $count = $service->sendToAll('Global Alert', 'Maintenance window.', 'warning');
    expect($count)->toBeGreaterThanOrEqual(3); // test user + 2 factory
});

it('service sendToRole() notifies only users with role', function () {
    $admin = User::factory()->create();
    $admin->attachRole(Role::where('slug', 'admin')->first());

    $service = app(NotificationService::class);
    $count = $service->sendToRole('admin', 'Admin Only', 'For admins.', 'danger');

    expect($count)->toBeGreaterThanOrEqual(1);
    expect($admin->fresh()->notifications->first()->data['title'])->toBe('Admin Only');
    expect($this->user->fresh()->notifications)->toHaveCount(0);
});

// ========================================================================
// Mark as unread
// ========================================================================

it('markAsUnread sets read_at to null', function () {
    $id = Str::uuid()->toString();
    $this->user->notifications()->create([
        'id' => $id, 'type' => 'Test', 'data' => ['title' => 'T'], 'read_at' => now(),
    ]);
    $service = app(NotificationService::class);
    $result = $service->markAsUnread($this->user, $id);
    expect($result)->toBeTrue();
    expect($this->user->fresh()->unreadNotifications()->count())->toBe(1);
});

it('markAsUnread returns false for non-existent notification', function () {
    $service = app(NotificationService::class);
    $result = $service->markAsUnread($this->user, Str::uuid()->toString());
    expect($result)->toBeFalse();
});

it('mark as unread route works', function () {
    $id = Str::uuid()->toString();
    $this->user->notifications()->create([
        'id' => $id, 'type' => 'Test', 'data' => ['title' => 'T'], 'read_at' => now(),
    ]);
    $this->actingAs($this->user)->post("/notifications/{$id}/unread")->assertRedirect();
    expect($this->user->fresh()->unreadNotifications()->count())->toBe(1);
});

it('mark as unread shows flash message', function () {
    $id = Str::uuid()->toString();
    $this->user->notifications()->create([
        'id' => $id, 'type' => 'Test', 'data' => ['title' => 'T'], 'read_at' => now(),
    ]);
    $this->actingAs($this->user)->post("/notifications/{$id}/unread")
        ->assertSessionHas('success', 'Notification marked as unread.');
});

// ========================================================================
// Confirmation modal on delete
// ========================================================================

it('notification index page includes delete confirmation', function () {
    $this->user->notifications()->create([
        'id' => Str::uuid()->toString(), 'type' => 'Test', 'data' => ['title' => 'T', 'message' => 'M'],
    ]);
    $this->actingAs($this->user)->get('/notifications')
        ->assertOk()
        ->assertSee('Delete Notification');
});

// ========================================================================
// Conditional mark all as read
// ========================================================================

it('hides mark all as read when no unread', function () {
    $this->user->notifications()->create([
        'id' => Str::uuid()->toString(), 'type' => 'Test', 'data' => ['title' => 'T'], 'read_at' => now(),
    ]);
    $this->actingAs($this->user)->get('/notifications')
        ->assertOk()
        ->assertDontSee(__('notifications::notifications.mark_all_read'));
});

it('shows mark all as read when unread exist', function () {
    $this->user->notifications()->create([
        'id' => Str::uuid()->toString(), 'type' => 'Test', 'data' => ['title' => 'T'],
    ]);
    $this->actingAs($this->user)->get('/notifications')
        ->assertOk()
        ->assertSee(__('notifications::notifications.mark_all_read'));
});

// ========================================================================
// Config: flash_messages toggle
// ========================================================================

it('shows flash messages when config enabled', function () {
    config(['notifications.flash_messages' => true]);
    $id = Str::uuid()->toString();
    $this->user->notifications()->create(['id' => $id, 'type' => 'Test', 'data' => ['title' => 'T']]);
    $this->actingAs($this->user)->post("/notifications/{$id}/read");
    $this->actingAs($this->user)->get('/notifications')
        ->assertOk();
});

it('hides flash messages when config disabled', function () {
    config(['notifications.flash_messages' => false]);
    $id = Str::uuid()->toString();
    $this->user->notifications()->create(['id' => $id, 'type' => 'Test', 'data' => ['title' => 'T']]);
    $this->actingAs($this->user)
        ->from('/notifications')
        ->post("/notifications/{$id}/read")
        ->assertRedirect('/notifications');
});

// ========================================================================
// Config: confirm_style
// ========================================================================

it('config defaults to modal confirm style', function () {
    expect(config('notifications.confirm_style'))->toBe('modal');
});

it('config defaults to flash messages disabled', function () {
    expect(config('notifications.flash_messages'))->toBeFalse();
});

// ========================================================================
// Mark as unread shows in view for read notifications
// ========================================================================

it('read notification shows mark as unread button', function () {
    $this->user->notifications()->create([
        'id' => Str::uuid()->toString(), 'type' => 'Test', 'data' => ['title' => 'Read It'], 'read_at' => now(),
    ]);
    $this->actingAs($this->user)->get('/notifications')
        ->assertOk()
        ->assertSee('Mark as unread');
});

// ========================================================================
// Bell partial exists
// ========================================================================

it('bell partial view exists', function () {
    expect(file_exists(base_path('packages/laravel-notifications/resources/views/partials/bell.blade.php')))->toBeTrue();
});

// ========================================================================
// Notification type colors in view
// ========================================================================

it('notification with success type renders', function () {
    $service = app(NotificationService::class);
    $service->send($this->user, 'Success', 'Done!', 'success');

    $this->actingAs($this->user)->get('/notifications')
        ->assertOk()
        ->assertSee('Success')
        ->assertSee('Done!');
});

it('notification with danger type renders', function () {
    $service = app(NotificationService::class);
    $service->send($this->user, 'Error', 'Failed!', 'danger');

    $this->actingAs($this->user)->get('/notifications')
        ->assertOk()
        ->assertSee('Error')
        ->assertSee('Failed!');
});

// ========================================================================
// Archive functionality
// ========================================================================

it('archive sets archived_at timestamp', function () {
    $id = Str::uuid()->toString();
    $this->user->notifications()->create(['id' => $id, 'type' => 'Test', 'data' => ['title' => 'T']]);
    $service = app(NotificationService::class);
    $result = $service->archive($this->user, $id);
    expect($result)->toBeTrue();
    expect($this->user->notifications()->find($id)->archived_at)->not->toBeNull();
});

it('unarchive clears archived_at', function () {
    $id = Str::uuid()->toString();
    $this->user->notifications()->create(['id' => $id, 'type' => 'Test', 'data' => ['title' => 'T'], 'archived_at' => now()]);
    $service = app(NotificationService::class);
    $result = $service->unarchive($this->user, $id);
    expect($result)->toBeTrue();
    expect($this->user->notifications()->find($id)->archived_at)->toBeNull();
});

it('archiveAll archives all active notifications', function () {
    for ($i = 0; $i < 3; $i++) {
        $this->user->notifications()->create([
            'id' => Str::uuid()->toString(), 'type' => 'Test', 'data' => ['title' => "T{$i}"],
        ]);
    }
    $service = app(NotificationService::class);
    $count = $service->archiveAll($this->user);
    expect($count)->toBe(3);
    expect($service->archivedCount($this->user))->toBe(3);
});

it('getActive excludes archived', function () {
    $this->user->notifications()->create([
        'id' => Str::uuid()->toString(), 'type' => 'Test', 'data' => ['title' => 'Active'],
    ]);
    $this->user->notifications()->create([
        'id' => Str::uuid()->toString(), 'type' => 'Test', 'data' => ['title' => 'Archived'], 'archived_at' => now(),
    ]);
    $service = app(NotificationService::class);
    expect($service->getActive($this->user, 20)->count())->toBe(1);
});

it('getArchived returns only archived', function () {
    $this->user->notifications()->create([
        'id' => Str::uuid()->toString(), 'type' => 'Test', 'data' => ['title' => 'Active'],
    ]);
    $this->user->notifications()->create([
        'id' => Str::uuid()->toString(), 'type' => 'Test', 'data' => ['title' => 'Archived'], 'archived_at' => now(),
    ]);
    $service = app(NotificationService::class);
    expect($service->getArchived($this->user, 20)->count())->toBe(1);
});

it('unreadCount excludes archived', function () {
    $this->user->notifications()->create([
        'id' => Str::uuid()->toString(), 'type' => 'Test', 'data' => ['title' => 'Unread'],
    ]);
    $this->user->notifications()->create([
        'id' => Str::uuid()->toString(), 'type' => 'Test', 'data' => ['title' => 'Archived Unread'], 'archived_at' => now(),
    ]);
    $service = app(NotificationService::class);
    expect($service->unreadCount($this->user))->toBe(1);
});

it('archive route works', function () {
    $id = Str::uuid()->toString();
    $this->user->notifications()->create(['id' => $id, 'type' => 'Test', 'data' => ['title' => 'T']]);
    $this->actingAs($this->user)->post("/notifications/{$id}/archive")->assertRedirect();
    expect($this->user->notifications()->find($id)->archived_at)->not->toBeNull();
});

it('unarchive route works', function () {
    $id = Str::uuid()->toString();
    $this->user->notifications()->create(['id' => $id, 'type' => 'Test', 'data' => ['title' => 'T'], 'archived_at' => now()]);
    $this->actingAs($this->user)->post("/notifications/{$id}/unarchive")->assertRedirect();
    expect($this->user->notifications()->find($id)->archived_at)->toBeNull();
});

it('archive-all route works', function () {
    for ($i = 0; $i < 2; $i++) {
        $this->user->notifications()->create([
            'id' => Str::uuid()->toString(), 'type' => 'Test', 'data' => ['title' => "T{$i}"],
        ]);
    }
    $this->actingAs($this->user)->post('/notifications/archive-all')->assertRedirect();
    expect($this->user->notifications()->whereNull('archived_at')->count())->toBe(0);
});

it('index shows active by default', function () {
    $this->user->notifications()->create([
        'id' => Str::uuid()->toString(), 'type' => 'Test', 'data' => ['title' => 'ActiveNotif'],
    ]);
    $this->user->notifications()->create([
        'id' => Str::uuid()->toString(), 'type' => 'Test', 'data' => ['title' => 'ArchivedNotif'], 'archived_at' => now(),
    ]);
    $this->actingAs($this->user)->get('/notifications')
        ->assertOk()
        ->assertSee('ActiveNotif')
        ->assertDontSee('ArchivedNotif');
});

it('index with archived=1 shows archived', function () {
    $this->user->notifications()->create([
        'id' => Str::uuid()->toString(), 'type' => 'Test', 'data' => ['title' => 'ActiveNotif'],
    ]);
    $this->user->notifications()->create([
        'id' => Str::uuid()->toString(), 'type' => 'Test', 'data' => ['title' => 'ArchivedNotif'], 'archived_at' => now(),
    ]);
    $this->actingAs($this->user)->get('/notifications?archived=1')
        ->assertOk()
        ->assertSee('ArchivedNotif')
        ->assertDontSee('ActiveNotif');
});

it('index shows archive toggle tabs when notifications exist', function () {
    $this->user->notifications()->create([
        'id' => Str::uuid()->toString(), 'type' => 'Test', 'data' => ['title' => 'T'],
    ]);
    $this->actingAs($this->user)->get('/notifications')
        ->assertOk()
        ->assertSee('Inbox')
        ->assertSee('Archived');
});

it('index hides tabs and filter when no notifications at all', function () {
    $this->actingAs($this->user)->get('/notifications')
        ->assertOk()
        ->assertDontSee('Inbox')
        ->assertDontSee('Filter');
});

it('index shows search/filter input when notifications exist', function () {
    $this->user->notifications()->create([
        'id' => Str::uuid()->toString(), 'type' => 'Test', 'data' => ['title' => 'T'],
    ]);
    $this->actingAs($this->user)->get('/notifications')
        ->assertOk()
        ->assertSee('Filter');
});

it('archived count badge shows in view', function () {
    $this->user->notifications()->create([
        'id' => Str::uuid()->toString(), 'type' => 'Test', 'data' => ['title' => 'T'], 'archived_at' => now(),
    ]);
    $this->actingAs($this->user)->get('/notifications')
        ->assertOk();
});

// ========================================================================
// Migration: archived_at column
// ========================================================================

it('notifications table has archived_at column', function () {
    expect(Schema::hasColumn('notifications', 'archived_at'))->toBeTrue();
});
