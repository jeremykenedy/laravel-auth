<?php

namespace Tests\Unit;

use App\Http\Controllers\ThemesManagementController;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThemesManagementControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_eager_loads_user_profiles(): void
    {
        $user = User::factory()->create();
        $theme = $this->createTheme();
        $user->profile()->create(['theme_id' => $theme->id]);

        $view = (new ThemesManagementController)->index();

        $this->assertTrue($view->getData()['users']->first()->relationLoaded('profile'));
    }

    public function test_show_returns_theme_and_assigned_users(): void
    {
        $theme = $this->createTheme();
        $user = User::factory()->create();
        $user->profile()->create(['theme_id' => $theme->id]);

        $view = (new ThemesManagementController)->show($theme);
        $data = $view->getData();

        $this->assertSame($theme->id, $data['theme']->id);
        $this->assertCount(1, $data['themeUsers']);
        $this->assertSame($user->id, $data['themeUsers'][0]->id);
    }

    private function createTheme(): Theme
    {
        $theme = Theme::create([
            'name'          => 'Test Theme',
            'link'          => 'https://example.com/theme.css',
            'notes'         => 'Test theme.',
            'status'        => 1,
            'taggable_id'   => 0,
            'taggable_type' => 'theme',
        ]);
        $theme->taggable_id = $theme->id;
        $theme->save();

        return $theme;
    }
}
