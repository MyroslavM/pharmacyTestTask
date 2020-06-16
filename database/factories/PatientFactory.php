<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Patient;
use Faker\Generator as Faker;
use Propaganistas\LaravelPhone\PhoneNumber;

$factory->define(Patient::class, function (Faker $faker) {
    return [
        'first_name'  => $faker->firstName,
        'name'        => $faker->lastName,
        'last_name'   => $faker->firstName,
        'address'     => $faker->address,
        'phone'       => (string) PhoneNumber::make($faker->phoneNumber, 'UA'),
        'birthday'    => $faker->date('Y-m-d', '2002-12-31'),
        'where_id'    => App\Where::inRandomOrder()->first()->id
    ];
});
