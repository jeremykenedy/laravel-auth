<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Seeder;

class ThemesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $themes = [
            [
                'name' => 'Default',
                'link' => 'null',
            ],
            [
                'name' => 'Darkly',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/darkly/bootstrap.min.css',
            ],
            [
                'name' => 'Cyborg',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/cyborg/bootstrap.min.css',
            ],
            [
                'name' => 'Cosmo',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/cosmo/bootstrap.min.css',
            ],
            [
                'name' => 'Cerulean',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/cerulean/bootstrap.min.css',
            ],
            [
                'name' => 'Flatly',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/flatly/bootstrap.min.css',
            ],
            [
                'name' => 'Journal',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/journal/bootstrap.min.css',
            ],
            [
                'name' => 'Lumen',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/lumen/bootstrap.min.css',
            ],
            [
                'name' => 'Paper',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/paper/bootstrap.min.css',
            ],
            [
                'name' => 'Readable',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/readable/bootstrap.min.css',
            ],
            [
                'name' => 'Sandstone',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/sandstone/bootstrap.min.css',
            ],
            [
                'name' => 'Simplex',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/simplex/bootstrap.min.css',
            ],
            [
                'name' => 'Slate',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/slate/bootstrap.min.css',
            ],
            [
                'name' => 'Spacelab',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/spacelab/bootstrap.min.css',
            ],
            [
                'name' => 'Superhero',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/superhero/bootstrap.min.css',
            ],
            [
                'name' => 'United',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/united/bootstrap.min.css',
            ],
            [
                'name' => 'Yeti',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/yeti/bootstrap.min.css',
            ],
            [
                'name' => 'Bootstrap 4.3.1',
                'link' => 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css',
            ],
            [
                'name' => 'Materialize',
                'link' => 'https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.css',
            ],
            [
                'name' => 'Material Design for Bootstrap (MDB) 4.8.7',
                'link' => 'https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.7/css/mdb.css',
            ],
            [
                'name' => 'mdbootstrap',
                'link' => 'https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.1/css/mdb.min.css',
            ],
            [
                'name' => 'Litera',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/litera/bootstrap.min.css',
            ],
            [
                'name' => 'Lux',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/lux/bootstrap.min.css',
            ],
            [
                'name' => 'Materia',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/materia/bootstrap.min.css',
            ],
            [
                'name' => 'Minty',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/minty/bootstrap.min.css',
            ],
            [
                'name' => 'Pulse',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/pulse/bootstrap.min.css',
            ],
            [
                'name' => 'Sketchy',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/sketchy/bootstrap.min.css',
            ],
            [
                'name' => 'Solar',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.3.1/solar/bootstrap.min.css',
            ],

        ];

        foreach ($themes as $theme) {
            $newTheme = Theme::where('name', '=', $theme['name'])->first();
            if ($newTheme === null) {
                $newTheme = Theme::create([
                    'name'          => $theme['name'],
                    'link'          => $theme['link'],
                    'taggable_id'   => 0,
                    'taggable_type' => 'theme',
                ]);
            }
        }

        $allThemes = Theme::All();
        foreach ($allThemes as $theme) {
            $theme->taggable_id = $theme->id;
            $theme->save();
        }
    }
}
