<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $category = ['lead', 'opportunity', 'out right sale'];
    return [
        'uuid' => (string) Str::uuid(),
        'title' => $faker->title,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'active' => true,
        'status'=>$category[random_int(0,2)],
        'assigned_to'=>1,
        'password' => bcrypt('password'),
        'last_seen' => $faker->unixTime,
        'dob' => $faker->date('Y-m-d'),
        'email_verified_at' => now(),
        'remember_token' => Str::random(10),
    ];
});
