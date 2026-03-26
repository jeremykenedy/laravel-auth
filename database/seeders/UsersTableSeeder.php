<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Jeremykenedy\LaravelProfiles\Domain\Models\Profile;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'role' => 'superadmin',
                'email' => 'superadmin@superadmin.com',
                'name' => 'SuperAdmin',
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'profile' => [
                    'bio' => 'Platform administrator with full system access.',
                    'location' => 'San Francisco, CA',
                    'twitter_username' => 'jeabornes',
                    'github_username' => 'jeremykenedy',
                ],
            ],
            [
                'role' => 'admin',
                'email' => 'admin@user.com',
                'name' => 'Admin',
                'first_name' => 'Admin',
                'last_name' => 'User',
                'profile' => [
                    'bio' => 'Application administrator managing users, roles, and content.',
                    'location' => 'Austin, TX',
                    'twitter_username' => 'laabornes',
                    'github_username' => 'laravel',
                ],
            ],
            [
                'role' => 'user',
                'email' => 'user@user.com',
                'name' => 'User',
                'first_name' => 'Standard',
                'last_name' => 'User',
                'profile' => [
                    'bio' => 'Just a regular user exploring the platform.',
                    'location' => 'Portland, OR',
                ],
            ],
            [
                'role' => 'unverified',
                'email' => 'unverified@user.com',
                'name' => 'Unverified',
                'first_name' => 'Unverified',
                'last_name' => 'User',
                'profile' => [],
            ],
        ];

        foreach ($users as $userData) {
            $role = Role::where('slug', $userData['role'])->first();
            if (! $role) {
                continue;
            }

            $user = User::where('email', $userData['email'])->first();
            if ($user !== null) {
                continue;
            }

            $isVerified = $userData['role'] !== 'unverified';

            $user = User::create([
                'name' => $userData['name'],
                'first_name' => $userData['first_name'],
                'last_name' => $userData['last_name'],
                'email' => $userData['email'],
                'email_verified_at' => $isVerified ? now() : null,
                'password' => Hash::make('password'),
                'token' => Str::random(64),
                'activated' => true,
                'signup_ip_address' => '127.0.0.1',
            ]);

            $user->profile()->save(new Profile($userData['profile']));
            $user->attachRole($role);
            $user->save();
        }

        // Add jeremykenedy demo user
        if (! User::where('email', 'jeremykenedy@gmail.com')->exists()) {
            $jk = User::create([
                'name' => 'jeremykenedy',
                'first_name' => 'Jeremy',
                'last_name' => 'Kenedy',
                'email' => 'jeremykenedy@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'token' => Str::random(64),
                'activated' => true,
                'signup_ip_address' => '127.0.0.1',
            ]);

            $jk->profile()->save(new Profile([
                'bio' => 'Full-stack developer and open-source contributor. Creator of laravel-auth.',
                'location' => 'Portland, OR',
                'twitter_username' => 'jeabornes',
                'github_username' => 'jeremykenedy',
            ]));
        }
    }
}
