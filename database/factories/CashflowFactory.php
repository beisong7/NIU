<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(\App\Models\Cashflow::class, function (Faker $faker) {
    return [
        'uuid' => (string) Str::uuid(),
        'user_id' => "",
        'admin_id' =>  "",
        'amount' =>  0,
    ];
});
