<?php

use App\Models\Role;
use App\Models\User;
use Database\Seeders\BlockedItemsTableSeeder;
use Database\Seeders\BlockedTypeTableSeeder;
use Database\Seeders\PostsTableSeeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\ThemesTableSeeder;

beforeEach(function () {
    $this->seed(BlockedTypeTableSeeder::class);
    $this->seed(BlockedItemsTableSeeder::class);
    $this->seed(RolesTableSeeder::class);
    $this->seed(ThemesTableSeeder::class);

    $this->admin = User::factory()->create();
    $this->admin->attachRole(Role::where('slug', 'admin')->first());
});

it('renders the chat page', function () {
    $this->actingAs($this->admin)
        ->get('/chat')
        ->assertOk()
        ->assertSee('Messages');
});

it('renders the admin social providers page', function () {
    $this->actingAs($this->admin)
        ->get('/admin/social')
        ->assertOk();
});

it('renders the admin themes page', function () {
    $this->actingAs($this->admin)
        ->get('/admin/themes')
        ->assertOk();
});

it('renders the blocker create page', function () {
    $this->actingAs($this->admin)
        ->get('/blocker/create')
        ->assertOk();
});

it('renders the permissions page', function () {
    $this->actingAs($this->admin)
        ->get('/permissions')
        ->assertOk();
});

it('renders the phpinfo page', function () {
    $this->actingAs($this->admin)
        ->get('/phpinfo')
        ->assertOk();
});

it('renders the log viewer', function () {
    $this->actingAs($this->admin)
        ->get('/log-viewer')
        ->assertOk();
});

it('renders the health check as JSON', function () {
    $this->getJson('/health')
        ->assertOk()
        ->assertJsonStructure(['status', 'checks']);
});

it('renders the blog with posts', function () {
    $this->seed(PostsTableSeeder::class);

    $this->get('/posts')
        ->assertOk()
        ->assertSee('Blog');
});

it('can access the two-factor setup page', function () {
    $this->actingAs($this->admin)
        ->get('/two-factor/setup')
        ->assertOk();
});
