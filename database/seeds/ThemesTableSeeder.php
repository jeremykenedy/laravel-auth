<?php

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
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0/darkly/bootstrap.min.css',
            ],
            [
                'name' => 'Cyborg',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0/cyborg/bootstrap.min.css',
            ],
            [
                'name' => 'Cosmo',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0/cosmo/bootstrap.min.css',
            ],
            [
                'name' => 'Cerulean',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0/cerulean/bootstrap.min.css',
            ],
            [
                'name' => 'Flatly',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0/flatly/bootstrap.min.css',
            ],
            [
                'name' => 'Journal',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0/journal/bootstrap.min.css',
            ],
            [
                'name' => 'Lumen',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0/lumen/bootstrap.min.css',
            ],
            [
                'name' => 'Paper',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0/paper/bootstrap.min.css',
            ],
            [
                'name' => 'Readable',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0/readable/bootstrap.min.css',
            ],
            [
                'name' => 'Sandstone',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0/sandstone/bootstrap.min.css',
            ],
            [
                'name' => 'Simplex',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0/simplex/bootstrap.min.css',
            ],
            [
                'name' => 'Slate',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0/slate/bootstrap.min.css',
            ],
            [
                'name' => 'Spacelab',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0/spacelab/bootstrap.min.css',
            ],
            [
                'name' => 'Superhero',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0/superhero/bootstrap.min.css',
            ],
            [
                'name' => 'United',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0/united/bootstrap.min.css',
            ],
            [
                'name' => 'Yeti',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0/yeti/bootstrap.min.css',
            ],
            [
                'name' => 'Bootstrap 4.0.0 Alpha',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css',
            ],
            [
                'name' => 'Materialize',
                'link' => 'https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css',
            ],
            [
                'name' => 'Bootstrap Material Design 4.0.0',
                'link' => 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/4.0.0/bootstrap-material-design.min.css',
            ],
            [
                'name' => 'Bootstrap Material Design 4.0.2',
                'link' => 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/4.0.2/bootstrap-material-design.min.css',
            ],
            [
                'name' => 'mdbootstrap',
                'link' => 'https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.1/css/mdb.min.css',
            ],
            [
                'name' => 'Litera',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0/litera/bootstrap.min.css',
            ],
            [
                'name' => 'Lux',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0/lux/bootstrap.min.css',
            ],
            [
                'name' => 'Materia',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0/materia/bootstrap.min.css',
            ],
            [
                'name' => 'Minty',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0/minty/bootstrap.min.css',
            ],
            [
                'name' => 'Pulse',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0/pulse/bootstrap.min.css',
            ],
            [
                'name' => 'Sketchy',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0/sketchy/bootstrap.min.css',
            ],
            [
                'name' => 'Solar',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0/solar/bootstrap.min.css',
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
