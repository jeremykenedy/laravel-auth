<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userRole = Role::whereName('User')->first();

        return [
            'name'                           => fake()->name(),
            'first_name'                     => fake()->firstName,
            'last_name'                      => fake()->lastName,
            'email'                          => fake()->unique()->safeEmail(),
            'email_verified_at'              => now(),
            'password'                       => bcrypt('secret'),
            'token'                          => str_random(64),
            'activated'                      => true,
            'remember_token'                 => Str::random(10),
            'signup_ip_address'              => fake()->ipv4,
            'signup_confirmation_ip_address' => fake()->ipv4,
        ];
    }
}
