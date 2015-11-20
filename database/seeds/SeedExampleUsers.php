<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\User;

class SeedExampleUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table('users')->delete();

        $admin_role     = Role::whereName('administrator')->first();
        $editor_role    = Role::whereName('editor')->first();
        $user_role      = Role::whereName('user')->first();


        $user = User::create(array(
            'name'              => 'user',
            'first_name'        => 'jeremy',
            'last_name'         => 'kenedy',
            'email'             => 'jeremy@jeremykenedy.com',
            'password'          => Hash::make('password'),
            'activation_code'   => str_random(60) . 'jeremy@jeremykenedy.com',
            'active'            => 1
        ));
        $user->assignRole($user_role);

        $user = User::create(array(
            'name'              => 'admin',
            'first_name'        => 'Jeremy',
            'last_name'         => 'Kenedy',
            'email'             => 'jeremykenedy@gmail.com',
            'password'          => Hash::make('password'),
            'activation_code'   => str_random(60) . 'jeremykenedy@gmail.com',
            'active'            => 1
        ));
        $user->assignRole($admin_role);
    }
}