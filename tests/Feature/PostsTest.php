<?php

use App\Models\Role;
use App\Models\User;
use Database\Seeders\ConnectRelationshipsSeeder;
use Database\Seeders\PermissionsTableSeeder;
use Database\Seeders\RolesTableSeeder;
use Jeremykenedy\LaravelPosts\Domain\Models\Post;

beforeEach(function () {
    $this->seed(RolesTableSeeder::class);
    $this->seed(PermissionsTableSeeder::class);
    $this->seed(ConnectRelationshipsSeeder::class);

    $this->admin = User::factory()->create();
    $this->admin->attachRole(Role::where('slug', 'admin')->first());
});

it('shows published posts on the blog', function () {
    Post::create([
        'user_id' => $this->admin->id,
        'title' => 'Test Post',
        'slug' => 'test-post',
        'body' => 'Hello world content.',
        'status' => 'published',
        'published_at' => now(),
    ]);

    $this->get('/posts')
        ->assertOk()
        ->assertSee('Test Post');
});

it('does not show draft posts on the blog', function () {
    Post::create([
        'user_id' => $this->admin->id,
        'title' => 'Draft Post',
        'slug' => 'draft-post',
        'body' => 'Draft content.',
        'status' => 'draft',
    ]);

    $this->get('/posts')
        ->assertOk()
        ->assertDontSee('Draft Post');
});

it('renders a single published post', function () {
    Post::create([
        'user_id' => $this->admin->id,
        'title' => 'Single Post',
        'slug' => 'single-post',
        'body' => 'Full post content here.',
        'status' => 'published',
        'published_at' => now(),
    ]);

    $this->get('/posts/single-post')
        ->assertOk()
        ->assertSee('Single Post')
        ->assertSee('Full post content here.');
});

it('allows admin to create a post', function () {
    $this->actingAs($this->admin)
        ->post('/admin/posts', [
            'title' => 'New Post',
            'body' => 'New post content.',
            'status' => 'published',
        ])
        ->assertRedirect('/admin/posts');

    $this->assertDatabaseHas('posts', ['title' => 'New Post']);
});

it('auto-generates slug from title', function () {
    $this->actingAs($this->admin)
        ->post('/admin/posts', [
            'title' => 'Auto Slug Test',
            'body' => 'Content.',
            'status' => 'draft',
        ]);

    expect(Post::where('title', 'Auto Slug Test')->first()->slug)->toBe('auto-slug-test');
});

it('allows admin to update a post', function () {
    $post = Post::create([
        'user_id' => $this->admin->id,
        'title' => 'Old Title',
        'slug' => 'old-title',
        'body' => 'Old content.',
        'status' => 'draft',
    ]);

    $this->actingAs($this->admin)
        ->put('/admin/posts/'.$post->id, [
            'title' => 'Updated Title',
            'body' => 'Updated content.',
            'status' => 'published',
        ])
        ->assertRedirect('/admin/posts');

    expect($post->fresh()->title)->toBe('Updated Title');
});

it('allows admin to delete a post', function () {
    $post = Post::create([
        'user_id' => $this->admin->id,
        'title' => 'Delete Me',
        'slug' => 'delete-me',
        'body' => 'Content.',
        'status' => 'draft',
    ]);

    $this->actingAs($this->admin)
        ->delete('/admin/posts/'.$post->id)
        ->assertRedirect('/admin/posts');

    expect(Post::find($post->id))->toBeNull();
});
