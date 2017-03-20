<?php

use App\Models\Role;
use App\Models\User;
use App\Models\Profile;
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

        $faker = Faker::create();
        $adminRole = Role::whereName('Admin')->first();
        $userRole = Role::whereName('User')->first();
        $userProfile = new Profile;

        $user = User::where('email', '=', 'user@user.com')->first();
        if ($user === null) {
            $user = User::create(array(
                'name'          => $faker->userName,
                'first_name'    => $faker->firstName,
                'last_name'     => $faker->lastName,
                'email'         => 'user@user.com',
                'password'      => Hash::make('password'),
                'token'         => str_random(64),
                'activated'     => true
            ));
            $user->assignRole($adminRole);
        }

        $user = User::where('email', '=', 'admin@admin.com')->first();
        if ($user === null) {
            $user = User::create(array(
                'name'          => $faker->userName,
                'first_name'    => $faker->firstName,
                'last_name'     => $faker->lastName,
                'email'         => 'admin@admin.com',
                'password'      => Hash::make('password'),
                'token'         => str_random(64),
                'activated'     => true
            ));
            $user->assignRole($userRole);
        }

    }
}
