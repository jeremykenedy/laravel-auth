<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use jeremykenedy\LaravelBlocker\App\Models\BlockedItem;
use jeremykenedy\LaravelBlocker\App\Models\BlockedType;

class BlockedItemsTableSeeder extends Seeder
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
        $BlockedItems = [
            [
                'type'  => 'domain',
                'value' => 'test.com',
                'note'  => 'Block all domains/emails @test.com',
            ],
            [
                'type'  => 'domain',
                'value' => 'test.ca',
                'note'  => 'Block all domains/emails @test.ca',
            ],
            [
                'type'  => 'domain',
                'value' => 'fake.com',
                'note'  => 'Block all domains/emails @fake.com',
            ],
            [
                'type'  => 'domain',
                'value' => 'example.com',
                'note'  => 'Block all domains/emails @example.com',
            ],
            [
                'type'  => 'domain',
                'value' => 'mailinator.com',
                'note'  => 'Block all domains/emails @mailinator.com',
            ],
        ];

        /*
         * Add Blocked Items
         *
         */
        if (config('laravelblocker.seedPublishedBlockedItems')) {
            foreach ($BlockedItems as $BlockedItem) {
                $blockType = BlockedType::where('slug', $BlockedItem['type'])->first();
                $newBlockedItem = BlockedItem::where('typeId', '=', $blockType->id)
                    ->where('value', '=', $BlockedItem['value'])
                    ->withTrashed()
                    ->first();
                if ($newBlockedItem === null) {
                    $newBlockedItem = BlockedItem::create([
                        'typeId'    => $blockType->id,
                        'value'     => $BlockedItem['value'],
                        'note'      => $BlockedItem['note'],
                    ]);
                }
            }
        }
        echo "\e[32mSeeding:\e[0m BlockedItemsTableSeeder\r\n";
    }
}
