<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
		'name'          => $faker->unique()->userName,
		'first_name'    => $faker->firstName,
		'last_name'     => $faker->lastName,
		'email' 		=> $faker->unique()->safeEmail,
		'password' 		=> $password ?: $password = bcrypt('secret'),
		'token'         => str_random(64),
		'activated'     => $faker->boolean,
        'remember_token' => str_random(10),
    ];
});



