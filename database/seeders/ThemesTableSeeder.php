<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Jeremykenedy\LaravelThemes\Domain\Models\Theme;

class ThemesTableSeeder extends Seeder
{
    public function run(): void
    {
        $themes = [
            [
                'name' => 'Default',
                'slug' => 'default',
                'css_file' => null,
                'description' => 'Default application theme',
                'is_active' => true,
                'is_default' => true,
            ],
            [
                'name' => 'Darkly',
                'slug' => 'darkly',
                'css_file' => 'https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/darkly/bootstrap.min.css',
                'description' => 'Flatly in night mode',
                'is_active' => true,
                'is_default' => false,
            ],
            [
                'name' => 'Cyborg',
                'slug' => 'cyborg',
                'css_file' => 'https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/cyborg/bootstrap.min.css',
                'description' => 'Jet black and electric blue',
                'is_active' => true,
                'is_default' => false,
            ],
            [
                'name' => 'Cosmo',
                'slug' => 'cosmo',
                'css_file' => 'https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/cosmo/bootstrap.min.css',
                'description' => 'An ode to metro',
                'is_active' => true,
                'is_default' => false,
            ],
            [
                'name' => 'Cerulean',
                'slug' => 'cerulean',
                'css_file' => 'https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/cerulean/bootstrap.min.css',
                'description' => 'A calm blue sky',
                'is_active' => true,
                'is_default' => false,
            ],
            [
                'name' => 'Flatly',
                'slug' => 'flatly',
                'css_file' => 'https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/flatly/bootstrap.min.css',
                'description' => 'Flat and modern',
                'is_active' => true,
                'is_default' => false,
            ],
            [
                'name' => 'Journal',
                'slug' => 'journal',
                'css_file' => 'https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/journal/bootstrap.min.css',
                'description' => 'Crisp like a new sheet of paper',
                'is_active' => true,
                'is_default' => false,
            ],
            [
                'name' => 'Lumen',
                'slug' => 'lumen',
                'css_file' => 'https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/lumen/bootstrap.min.css',
                'description' => 'Light and shadow',
                'is_active' => true,
                'is_default' => false,
            ],
            [
                'name' => 'Litera',
                'slug' => 'litera',
                'css_file' => 'https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/litera/bootstrap.min.css',
                'description' => 'The medium is the message',
                'is_active' => true,
                'is_default' => false,
            ],
            [
                'name' => 'Lux',
                'slug' => 'lux',
                'css_file' => 'https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/lux/bootstrap.min.css',
                'description' => 'A touch of class',
                'is_active' => true,
                'is_default' => false,
            ],
            [
                'name' => 'Materia',
                'slug' => 'materia',
                'css_file' => 'https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/materia/bootstrap.min.css',
                'description' => 'Material is the metaphor',
                'is_active' => true,
                'is_default' => false,
            ],
            [
                'name' => 'Minty',
                'slug' => 'minty',
                'css_file' => 'https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/minty/bootstrap.min.css',
                'description' => 'A fresh feel',
                'is_active' => true,
                'is_default' => false,
            ],
            [
                'name' => 'Pulse',
                'slug' => 'pulse',
                'css_file' => 'https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/pulse/bootstrap.min.css',
                'description' => 'A trace of purple',
                'is_active' => true,
                'is_default' => false,
            ],
            [
                'name' => 'Sandstone',
                'slug' => 'sandstone',
                'css_file' => 'https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/sandstone/bootstrap.min.css',
                'description' => 'A touch of warmth',
                'is_active' => true,
                'is_default' => false,
            ],
            [
                'name' => 'Simplex',
                'slug' => 'simplex',
                'css_file' => 'https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/simplex/bootstrap.min.css',
                'description' => 'Mini and minimalist',
                'is_active' => true,
                'is_default' => false,
            ],
            [
                'name' => 'Sketchy',
                'slug' => 'sketchy',
                'css_file' => 'https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/sketchy/bootstrap.min.css',
                'description' => 'A hand-drawn look for mockups',
                'is_active' => true,
                'is_default' => false,
            ],
            [
                'name' => 'Slate',
                'slug' => 'slate',
                'css_file' => 'https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/slate/bootstrap.min.css',
                'description' => 'Shades of gunmetal gray',
                'is_active' => true,
                'is_default' => false,
            ],
            [
                'name' => 'Solar',
                'slug' => 'solar',
                'css_file' => 'https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/solar/bootstrap.min.css',
                'description' => 'A spin on Solarized',
                'is_active' => true,
                'is_default' => false,
            ],
            [
                'name' => 'Spacelab',
                'slug' => 'spacelab',
                'css_file' => 'https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/spacelab/bootstrap.min.css',
                'description' => 'Silvery and sleek',
                'is_active' => true,
                'is_default' => false,
            ],
            [
                'name' => 'Superhero',
                'slug' => 'superhero',
                'css_file' => 'https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/superhero/bootstrap.min.css',
                'description' => 'The brave and the blue',
                'is_active' => true,
                'is_default' => false,
            ],
            [
                'name' => 'United',
                'slug' => 'united',
                'css_file' => 'https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/united/bootstrap.min.css',
                'description' => 'Ubuntu orange and unique font',
                'is_active' => true,
                'is_default' => false,
            ],
            [
                'name' => 'Yeti',
                'slug' => 'yeti',
                'css_file' => 'https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/yeti/bootstrap.min.css',
                'description' => 'A friendly foundation',
                'is_active' => true,
                'is_default' => false,
            ],
        ];

        foreach ($themes as $themeData) {
            Theme::firstOrCreate(
                ['slug' => $themeData['slug']],
                $themeData
            );
        }
    }
}
