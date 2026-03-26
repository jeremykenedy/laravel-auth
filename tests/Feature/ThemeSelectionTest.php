<?php

use App\Models\User;
use Database\Seeders\ThemesTableSeeder;
use Jeremykenedy\LaravelThemes\Domain\Models\Theme;

beforeEach(function () {
    $this->seed(ThemesTableSeeder::class);

    $this->user = User::factory()->create();
    $this->user->ensureProfile();
});

it('renders the theme selector page', function () {
    $this->actingAs($this->user)
        ->get('/themes')
        ->assertOk();
});

it('can select a theme', function () {
    $theme = Theme::where('slug', '!=', 'default')->first();

    $this->actingAs($this->user)
        ->post('/themes/select/'.$theme->id)
        ->assertRedirect();

    expect((int) $this->user->fresh()->profile->theme_id)->toBe($theme->id);
});

it('applies theme body class after selection', function () {
    $theme = Theme::where('slug', 'cerulean')->first();
    if (! $theme) {
        $this->markTestSkipped('Cerulean theme not seeded');
    }

    $this->user->profile->update(['theme_id' => $theme->id]);

    $this->actingAs($this->user)
        ->get('/home')
        ->assertOk()
        ->assertSee('theme-cerulean');
});
