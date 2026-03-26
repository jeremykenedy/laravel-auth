<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Jeremykenedy\LaravelProfiles\Domain\Models\Profile;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create();

        $emailMap = [
            'superadmin' => 'superadmin@superadmin.com',
            'admin' => 'admin@user.com',
            'user' => 'user@user.com',
            'unverified' => 'unverified@user.com',
        ];

        $roles = Role::all();
        foreach ($roles as $role) {
            $email = $emailMap[$role->slug] ?? $role->slug.'@user.com';
            $this->createUser($faker, $email, $role);
        }
    }

    private function createUser($faker, string $email, $role): void
    {
        $user = User::where('email', '=', $email)->first();
        if ($user === null) {
            $isVerified = $role->slug !== 'unverified';

            $user = User::create([
                'name' => $faker->userName,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $email,
                'email_verified_at' => $isVerified ? now() : null,
                'password' => Hash::make('password'),
                'token' => Str::random(64),
                'activated' => true,
                'signup_ip_address' => $faker->ipv4,
                'signup_confirmation_ip_address' => $faker->ipv4,
            ]);

            $user->profile()->save(new Profile);
            $user->attachRole($role);
            $user->save();
        }
    }
}
