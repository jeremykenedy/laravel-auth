<?php

//use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


////////////////

        // $adminRole = Role::whereName('administrator')->first();
        // $userRole = Role::whereName('user')->first();

        // $user = User::where('email', '=', 'jeremykenedy@gmail.com')->first();
        // if ($user === null) {
        //     $user = User::create(array(
        //         'name'          => 'Jeremy',
        //         'first_name'    => 'Jeremy',
        //         'last_name'     => 'Kenedy',
        //         'email'         => 'jeremykenedy@gmail.com',
        //         'password'      => Hash::make('password'),
        //         'token'         => str_random(64),
        //         'activated'     => true
        //     ));
        //     $user->assignRole($adminRole);
        // }

////////////////

        // $user = User::where('email', '=', 'jeremy@jeremykenedy.com')->first();
        // if ($user === null) {
        //     $user = User::create(array(
        //         'name'          => 'J',
        //         'first_name'    => 'J',
        //         'last_name'     => 'Kenedy',
        //         'email'         => 'jeremy@jeremykenedy.com',
        //         'password'      => Hash::make('password'),
        //         'token'         => str_random(64),
        //         'activated'     => true
        //     ));
        //     $user->assignRole($userRole);
        // }

    }
}
