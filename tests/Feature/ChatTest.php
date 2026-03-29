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

    $this->user = User::factory()->create(['email_verified_at' => now(), 'chat_enabled' => true]);
    $this->user->attachRole(Role::where('slug', 'user')->first());

    $this->otherUser = User::factory()->create(['email_verified_at' => now(), 'chat_enabled' => true]);
    $this->otherUser->attachRole(Role::where('slug', 'user')->first());
});

// ========================================================================
// Chat enabled toggle
// ========================================================================

it('can toggle chat_enabled on via profile', function () {
    $user = User::factory()->create(['chat_enabled' => false]);

    $this->actingAs($user)
        ->putJson(route('profile.toggle-chat'), ['chat_enabled' => true])
        ->assertOk()
        ->assertJson(['chat_enabled' => true]);

    expect($user->fresh()->chat_enabled)->toBeTrue();
});

it('can toggle chat_enabled off via profile', function () {
    $user = User::factory()->create(['chat_enabled' => true]);

    $this->actingAs($user)
        ->putJson(route('profile.toggle-chat'), ['chat_enabled' => false])
        ->assertOk()
        ->assertJson(['chat_enabled' => false]);

    expect($user->fresh()->chat_enabled)->toBeFalse();
});

it('validates chat_enabled is boolean', function () {
    $this->actingAs($this->user)
        ->putJson(route('profile.toggle-chat'), ['chat_enabled' => 'invalid'])
        ->assertUnprocessable();
});

it('requires auth to toggle chat', function () {
    $this->putJson(route('profile.toggle-chat'), ['chat_enabled' => true])
        ->assertUnauthorized();
});

// ========================================================================
// Chatable users API
// ========================================================================

it('returns chatable users', function () {
    $this->actingAs($this->user)
        ->getJson(route('chat.users'))
        ->assertOk()
        ->assertJsonStructure(['data', 'next_cursor', 'has_more'])
        ->assertJsonPath('data.0.name', $this->otherUser->name);
});

it('excludes current user from chatable list', function () {
    $response = $this->actingAs($this->user)
        ->getJson(route('chat.users'))
        ->assertOk();

    $ids = collect($response->json('data'))->pluck('id')->toArray();
    expect($ids)->not->toContain($this->user->id);
});

it('excludes users with chat_enabled false', function () {
    $disabledUser = User::factory()->create(['chat_enabled' => false]);

    $response = $this->actingAs($this->user)
        ->getJson(route('chat.users'))
        ->assertOk();

    $ids = collect($response->json('data'))->pluck('id')->toArray();
    expect($ids)->not->toContain($disabledUser->id);
    expect($ids)->toContain($this->otherUser->id);
});

it('searches chatable users by name', function () {
    $this->actingAs($this->user)
        ->getJson(route('chat.users', ['search' => $this->otherUser->name]))
        ->assertOk()
        ->assertJsonPath('data.0.name', $this->otherUser->name);
});

it('searches chatable users by email', function () {
    $this->actingAs($this->user)
        ->getJson(route('chat.users', ['search' => $this->otherUser->email]))
        ->assertOk()
        ->assertJsonPath('data.0.email', $this->otherUser->email);
});

it('returns empty when search has no matches', function () {
    $this->actingAs($this->user)
        ->getJson(route('chat.users', ['search' => 'zzzznonexistent']))
        ->assertOk()
        ->assertJsonPath('data', []);
});

it('paginates chatable users with cursor', function () {
    User::factory()->count(25)->create(['chat_enabled' => true]);

    $first = $this->actingAs($this->user)
        ->getJson(route('chat.users'))
        ->assertOk();

    expect($first->json('has_more'))->toBeTrue();
    expect($first->json('next_cursor'))->not->toBeNull();

    $second = $this->actingAs($this->user)
        ->getJson(route('chat.users', ['cursor' => $first->json('next_cursor')]))
        ->assertOk();

    $firstIds = collect($first->json('data'))->pluck('id');
    $secondIds = collect($second->json('data'))->pluck('id');
    expect($firstIds->intersect($secondIds))->toBeEmpty();
});

it('returns avatar_url in chatable users', function () {
    $this->actingAs($this->user)
        ->getJson(route('chat.users'))
        ->assertOk()
        ->assertJsonStructure(['data' => [['id', 'name', 'email', 'avatar_url']]]);
});

// ========================================================================
// Start conversation
// ========================================================================

it('can start a conversation with a chatable user', function () {
    $this->actingAs($this->user)
        ->postJson(route('chat.start'), ['user_id' => $this->otherUser->id])
        ->assertOk()
        ->assertJsonStructure(['data' => ['id', 'participants']]);
});

it('returns existing conversation when one already exists', function () {
    $first = $this->actingAs($this->user)
        ->postJson(route('chat.start'), ['user_id' => $this->otherUser->id])
        ->assertOk();

    $second = $this->actingAs($this->user)
        ->postJson(route('chat.start'), ['user_id' => $this->otherUser->id])
        ->assertOk();

    expect($first->json('data.id'))->toBe($second->json('data.id'));
});

it('validates user_id when starting conversation', function () {
    $this->actingAs($this->user)
        ->postJson(route('chat.start'), ['user_id' => 99999])
        ->assertUnprocessable();
});

// ========================================================================
// Send message
// ========================================================================

it('can send a message in a conversation', function () {
    $convo = $this->actingAs($this->user)
        ->postJson(route('chat.start'), ['user_id' => $this->otherUser->id])
        ->json('data');

    $this->actingAs($this->user)
        ->postJson(route('chat.send', $convo['id']), ['body' => 'Hello!'])
        ->assertCreated()
        ->assertJsonPath('data.body', 'Hello!');
});

it('validates message body', function () {
    $convo = $this->actingAs($this->user)
        ->postJson(route('chat.start'), ['user_id' => $this->otherUser->id])
        ->json('data');

    $this->actingAs($this->user)
        ->postJson(route('chat.send', $convo['id']), ['body' => ''])
        ->assertUnprocessable();
});

it('can retrieve messages for a conversation', function () {
    $convo = $this->actingAs($this->user)
        ->postJson(route('chat.start'), ['user_id' => $this->otherUser->id])
        ->json('data');

    $this->actingAs($this->user)
        ->postJson(route('chat.send', $convo['id']), ['body' => 'Test message']);

    $this->actingAs($this->user)
        ->getJson(route('chat.messages', $convo['id']))
        ->assertOk()
        ->assertJsonFragment(['body' => 'Test message']);
});

// ========================================================================
// Conversations list
// ========================================================================

it('returns user conversations', function () {
    $this->actingAs($this->user)
        ->postJson(route('chat.start'), ['user_id' => $this->otherUser->id]);

    $this->actingAs($this->user)
        ->getJson(route('chat.conversations'))
        ->assertOk()
        ->assertJsonCount(1);
});

it('user without conversations sees empty list', function () {
    $freshUser = User::factory()->create(['email_verified_at' => now(), 'chat_enabled' => true]);

    $this->actingAs($freshUser)
        ->getJson(route('chat.conversations'))
        ->assertOk()
        ->assertJson([]);
});

// ========================================================================
// Chat page rendering
// ========================================================================

it('renders chat page for authenticated user', function () {
    $this->actingAs($this->user)
        ->get(route('chat.index'))
        ->assertOk()
        ->assertSee('Messages')
        ->assertSee('New Chat');
});

it('chat page requires authentication', function () {
    $this->get(route('chat.index'))
        ->assertRedirect(route('login'));
});

// ========================================================================
// Profile edit shows chat toggle
// ========================================================================

it('profile edit page shows chat toggle', function () {
    $this->user->ensureProfile();

    $this->actingAs($this->user)
        ->get(route('profile.edit'))
        ->assertOk()
        ->assertSee('Chat Availability');
});
