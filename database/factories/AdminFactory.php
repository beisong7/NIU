<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Admin;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Admin::class, function (Faker $faker) {
    return [
    	'who' => 4,
        'uuid' => (string) Str::uuid(),
        'title' => $faker->title,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => 'admin@niucms.com', //$faker->unique()->safeEmail,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'active' => true,
        'password' => bcrypt('password'),
        'last_seen' => $faker->unixTime,
        'dob' => $faker->date('Y-m-d'),
        'theme_type' => 'light',
        'email_verified_at' => now(),
        'remember_token' => Str::random(10),
    ];
});
