<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Worktime;
use Faker\Generator as Faker;

$factory->define(Worktime::class, function (Faker $faker) {
    return [
        'doctor_id' => App\User::inRandomOrder()->whereIn('id', \App\Role::where('role_id', 3)->pluck('model_id'))->first()->id,
        'date'      => \Carbon\Carbon::now()->format('Y-m-d'),
        'start'     => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
        'end'       => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
        'clinic_id' => App\Clinic::inRandomOrder()->first()->id,
    ];
});
