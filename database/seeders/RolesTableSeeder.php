<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Super Admin',
                'slug' => 'superadmin',
                'description' => 'Super Admin Role',
                'level' => 10,
            ],
            [
                'name' => 'Admin',
                'slug' => 'admin',
                'description' => 'Admin Role',
                'level' => 5,
            ],
            [
                'name' => 'User',
                'slug' => 'user',
                'description' => 'User Role',
                'level' => 1,
            ],
            [
                'name' => 'Unverified',
                'slug' => 'unverified',
                'description' => 'Unverified Role',
                'level' => 0,
            ],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['slug' => $role['slug']],
                $role
            );
        }
    }
}
