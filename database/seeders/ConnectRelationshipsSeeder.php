<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class ConnectRelationshipsSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = Permission::all();

        // Attach all permissions to Super Admin and Admin
        foreach (['superadmin', 'admin'] as $roleSlug) {
            $role = Role::where('slug', $roleSlug)->first();
            if ($role) {
                foreach ($permissions as $permission) {
                    $role->attachPermission($permission);
                }
            }
        }
    }
}
