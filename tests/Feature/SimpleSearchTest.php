<?php

use App\Models\Role;
use App\Models\User;
use Database\Seeders\BlockedItemsTableSeeder;
use Database\Seeders\BlockedTypeTableSeeder;
use Database\Seeders\PermissionsTableSeeder;
use Database\Seeders\RolesTableSeeder;

beforeEach(function () {
    $this->seed(BlockedTypeTableSeeder::class);
    $this->seed(BlockedItemsTableSeeder::class);
    $this->seed(RolesTableSeeder::class);
    $this->seed(PermissionsTableSeeder::class);

    $this->user = User::factory()->create(['email_verified_at' => now()]);
    $this->user->attachRole(Role::where('slug', 'user')->first());

    $this->admin = User::factory()->create(['email_verified_at' => now()]);
    $this->admin->attachRole(Role::where('slug', 'admin')->first());
});

// ========================================================================
// Admin search (users type requires level:5)
// ========================================================================

it('admin can search users by name', function () {
    $target = User::factory()->create(['name' => 'searchableuser']);

    $this->actingAs($this->admin)
        ->getJson(route('simple-search.type', ['type' => 'users', 'q' => 'searchable']))
        ->assertOk()
        ->assertJsonPath('results.0.name', 'searchableuser');
});

it('admin can search users by email', function () {
    $target = User::factory()->create(['email' => 'findme@example.com']);

    $this->actingAs($this->admin)
        ->getJson(route('simple-search.type', ['type' => 'users', 'q' => 'findme']))
        ->assertOk()
        ->assertJsonPath('results.0.email', 'findme@example.com');
});

it('admin gets empty results when no match', function () {
    $this->actingAs($this->admin)
        ->getJson(route('simple-search.type', ['type' => 'users', 'q' => 'zzzznotfound']))
        ->assertOk()
        ->assertJsonPath('results', []);
});

it('admin results include _search_title _search_subtitle _search_url', function () {
    User::factory()->create(['name' => 'metauser', 'email' => 'meta@test.com']);

    $this->actingAs($this->admin)
        ->getJson(route('simple-search.type', ['type' => 'users', 'q' => 'metauser']))
        ->assertOk()
        ->assertJsonStructure(['results' => [['_search_title', '_search_subtitle', '_search_url']]]);
});

it('_search_url resolves to user show page', function () {
    $target = User::factory()->create(['name' => 'urluser']);

    $response = $this->actingAs($this->admin)
        ->getJson(route('simple-search.type', ['type' => 'users', 'q' => 'urluser']))
        ->assertOk();

    expect($response->json('results.0._search_url'))->toBe('/users/'.$target->id);
});

it('admin global search returns grouped results', function () {
    User::factory()->create(['name' => 'globalsearchuser']);

    $this->actingAs($this->admin)
        ->getJson(route('simple-search', ['q' => 'globalsearch']))
        ->assertOk()
        ->assertJsonStructure(['results' => ['users']]);
});

it('admin search limits results to max_results', function () {
    for ($i = 0; $i < 30; $i++) {
        User::factory()->create(['name' => 'bulkuser'.$i]);
    }

    $response = $this->actingAs($this->admin)
        ->getJson(route('simple-search.type', ['type' => 'users', 'q' => 'bulkuser']))
        ->assertOk();

    expect(count($response->json('results')))->toBeLessThanOrEqual(config('simple-search.max_results', 25));
});

// ========================================================================
// Permission enforcement: regular users cannot search users
// ========================================================================

it('regular user cannot search users type', function () {
    User::factory()->create(['name' => 'hiddenuser']);

    $this->actingAs($this->user)
        ->getJson(route('simple-search.type', ['type' => 'users', 'q' => 'hiddenuser']))
        ->assertNotFound();
});

it('regular user global search returns no user results', function () {
    User::factory()->create(['name' => 'shouldntsee']);

    $response = $this->actingAs($this->user)
        ->getJson(route('simple-search', ['q' => 'shouldntsee']))
        ->assertOk();

    expect($response->json('results'))->toBeEmpty();
});

it('admin sees users in available types', function () {
    $this->actingAs($this->admin)
        ->getJson(route('simple-search.types'))
        ->assertOk()
        ->assertJsonFragment(['type' => 'users']);
});

it('regular user does not see users in available types', function () {
    $this->actingAs($this->user)
        ->getJson(route('simple-search.types'))
        ->assertOk()
        ->assertJsonPath('types', []);
});

// ========================================================================
// Validation and auth
// ========================================================================

it('validates minimum query length', function () {
    $this->actingAs($this->admin)
        ->getJson(route('simple-search.type', ['type' => 'users', 'q' => 'a']))
        ->assertUnprocessable();
});

it('returns 404 for unknown search type', function () {
    $this->actingAs($this->admin)
        ->getJson(route('simple-search.type', ['type' => 'widgets', 'q' => 'test']))
        ->assertNotFound();
});

it('requires authentication for search', function () {
    $this->getJson(route('simple-search', ['q' => 'test']))
        ->assertUnauthorized();
});
