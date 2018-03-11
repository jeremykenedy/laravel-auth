<?php

namespace Tests\Feature;

use App\Models\Theme;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ThemesTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    private $_faker;
    private $_themeName;
    private $_themeUrl;

    /**
     * Create a new theme test.
     *
     * @return void
     */
    public function testCreateNewTheme()
    {
        $this->_faker = (object) \Faker\Factory::create();
        $this->_themeName = $this->_faker->domainWord;
        $this->_themeUrl = $this->_faker->url;

        $theme = Theme::create([
            'name'          => $this->_themeName,
            'link'          => $this->_themeUrl,
            'notes'         => 'Test Default Theme.',
            'status'        => 1,
            'taggable_id'   => 0,
            'taggable_type' => 'theme',
        ]);
        $theme->taggable_id = $theme->id;
        $theme->save();

        $theme = Theme::where('name', $this->_themeName)->first();
        $this->assertEquals($this->_themeUrl, $theme->link);
        $this->assertEquals($theme->id, $theme->taggable_id);
    }
}
