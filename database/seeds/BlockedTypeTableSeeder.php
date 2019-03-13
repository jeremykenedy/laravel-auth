<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use jeremykenedy\LaravelBlocker\App\Models\BlockedType;

class BlockedTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Blocked Types
         *
         */
        $BlockedTypes = [
            [
                'slug' => 'email',
                'name' => 'E-mail',
            ],
            [
                'slug' => 'ipAddress',
                'name' => 'IP Address',
            ],
            [
                'slug' => 'domain',
                'name' => 'Domain Name',
            ],
            [
                'slug' => 'user',
                'name' => 'User',
            ],
            [
                'slug' => 'city',
                'name' => 'City',
            ],
            [
                'slug' => 'state',
                'name' => 'State',
            ],
            [
                'slug' => 'country',
                'name' => 'Country',
            ],
            [
                'slug' => 'countryCode',
                'name' => 'Country Code',
            ],
            [
                'slug' => 'continent',
                'name' => 'Continent',
            ],
            [
                'slug' => 'region',
                'name' => 'Region',
            ],
        ];

        /*
         * Add Blocked Types
         *
         */
        if (config('laravelblocker.seedPublishedBlockedTypes')) {
            foreach ($BlockedTypes as $BlockedType) {
                $newBlockedType = BlockedType::where('slug', '=', $BlockedType['slug'])
                    ->withTrashed()
                    ->first();
                if ($newBlockedType === null) {
                    $newBlockedType = BlockedType::create([
                        'slug' => $BlockedType['slug'],
                        'name' => $BlockedType['name'],
                    ]);
                }
            }
        }
        echo "\e[32mSeeding:\e[0m BlockedTypeTableSeeder\r\n";
    }
}
