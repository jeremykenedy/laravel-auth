<?php

use App\Models\Role;
use App\Models\User;
use Database\Seeders\BlockedItemsTableSeeder;
use Database\Seeders\BlockedTypeTableSeeder;
use Database\Seeders\ConnectRelationshipsSeeder;
use Database\Seeders\PermissionsTableSeeder;
use Database\Seeders\PostsTableSeeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\ThemesTableSeeder;
use Jeremykenedy\LaravelPosts\Domain\Models\Post;

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

// User CRUD
it('can create a new user', function () {
    $this->actingAs($this->admin)
        ->post('/users', [
            'name' => 'newuser',
            'email' => 'new@example.com',
            'password' => 'Password123',
            'password_confirmation' => 'Password123',
            'role' => Role::where('slug', 'user')->first()->id,
        ])
        ->assertRedirect('/users');

    $this->assertDatabaseHas('users', ['email' => 'new@example.com']);
});

it('can update a user', function () {
    $user = User::factory()->create(['name' => 'oldname']);

    $this->actingAs($this->admin)
        ->patch('/users/'.$user->id, [
            'name' => 'newname',
            'email' => $user->email,
        ])
        ->assertRedirect();

    expect($user->fresh()->name)->toBe('newname');
});

it('can soft delete a user', function () {
    $user = User::factory()->create();

    $this->actingAs($this->admin)
        ->delete('/users/'.$user->id)
        ->assertRedirect('/users');

    expect(User::find($user->id))->toBeNull();
    expect(User::onlyTrashed()->find($user->id))->not->toBeNull();
});

it('can restore a soft-deleted user', function () {
    $user = User::factory()->create();
    $user->delete();

    $this->actingAs($this->admin)
        ->put('/users/deleted/'.$user->id)
        ->assertRedirect();

    expect(User::find($user->id))->not->toBeNull();
});

// Profile CRUD
it('can update own profile', function () {
    $this->admin->ensureProfile();

    $this->actingAs($this->admin)
        ->put('/profile/update', [
            'bio' => 'Updated bio text',
            'location' => 'New York',
        ])
        ->assertRedirect();

    expect($this->admin->fresh()->profile->bio)->toBe('Updated bio text');
});

it('can export user data as JSON', function () {
    $this->admin->ensureProfile();

    $this->actingAs($this->admin)
        ->get('/profile/export')
        ->assertOk()
        ->assertJsonStructure(['user', 'profile', 'exported_at']);
});

// Notification CRUD
it('can access notification count', function () {
    $this->actingAs($this->admin)
        ->getJson('/notifications/count')
        ->assertOk()
        ->assertJson(['count' => 0]);
});

it('can access notifications page', function () {
    $this->actingAs($this->admin)
        ->get('/notifications')
        ->assertOk();
});

// Blog
it('can view a single blog post', function () {
    $this->seed(PostsTableSeeder::class);
    $post = Post::published()->first();

    $this->get('/posts/'.$post->slug)
        ->assertOk()
        ->assertSee($post->title);
});

it('can export users as CSV', function () {
    $this->actingAs($this->admin)
        ->get('/users/export')
        ->assertOk()
        ->assertHeader('content-type', 'text/csv; charset=UTF-8')
        ->assertHeader('content-disposition');
});
