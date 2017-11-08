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
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/darkly/bootstrap.min.css',
            ],
            [
                'name' => 'Cyborg',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cyborg/bootstrap.min.css',
            ],
            [
                'name' => 'Cosmo',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cosmo/bootstrap.min.css',
            ],
            [
                'name' => 'Cerulean',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cerulean/bootstrap.min.css',
            ],
            [
                'name' => 'Flatly',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/flatly/bootstrap.min.css',
            ],
            [
                'name' => 'Journal',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/journal/bootstrap.min.css',
            ],
            [
                'name' => 'Lumen',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/lumen/bootstrap.min.css',
            ],
            [
                'name' => 'Paper',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/paper/bootstrap.min.css',
            ],
            [
                'name' => 'Readable',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/readable/bootstrap.min.css',
            ],
            [
                'name' => 'Sandstone',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/sandstone/bootstrap.min.css',
            ],
            [
                'name' => 'Simplex',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/simplex/bootstrap.min.css',
            ],
            [
                'name' => 'Slate',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/slate/bootstrap.min.css',
            ],
            [
                'name' => 'Spacelab',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/spacelab/bootstrap.min.css',
            ],
            [
                'name' => 'Superhero',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/superhero/bootstrap.min.css',
            ],
            [
                'name' => 'United',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/united/bootstrap.min.css',
            ],
            [
                'name' => 'Yeti',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/yeti/bootstrap.min.css',
            ],
            [
                'name' => 'Bootstrap 4.0.0 Alpha',
                'link' => 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css',
            ],
            [
                'name' => 'Materialize',
                'link' => 'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css',
            ],
            [
                'name' => 'Bootstrap Material Design 0.3.0',
                'link' => 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/css/material-fullpalette.min.css',
            ],
            [
                'name' => 'Bootstrap Material Design 0.5.10',
                'link' => 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/css/bootstrap-material-design.min.css',
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
                'name' => 'bootflat',
                'link' => 'https://cdnjs.cloudflare.com/ajax/libs/bootflat/2.0.4/css/bootflat.min.css',
            ],
            [
                'name' => 'flat-ui',
                'link' => 'https://cdnjs.cloudflare.com/ajax/libs/flat-ui/2.3.0/css/flat-ui.min.css',
            ],
            [
                'name' => 'm8tro-bootstrap',
                'link' => 'https://cdnjs.cloudflare.com/ajax/libs/m8tro-bootstrap/3.3.7/m8tro.min.css',
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
