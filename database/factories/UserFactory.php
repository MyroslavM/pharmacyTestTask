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

//$factory->define(User::class, function (Faker $faker) {
//    return [
//        'name' => $faker->name,
//        'email' => $faker->unique()->safeEmail,
//        'email_verified_at' => now(),
//        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
//        'remember_token' => Str::random(10),
//    ];
//});



$factory->define(User::class, function (Faker $faker) {
    $sex_array = ['Male', 'Female'];

    $sex = $sex_array[array_rand($sex_array)];

    return [
        'clinic_id'      => App\Clinic::inRandomOrder()->first()->id,
        'name'           => $faker->{'firstName' . $sex},
        'surname'        => $faker->lastName,
        'patronymic'     => $faker->{'middleName' . $sex},
        'specialization' => 'Врач-офтальмолог',
        'email'          => $faker->unique()->safeEmail,
        'password'       => bcrypt('secret'),

        //'avatar'         => $faker->image('public/image/users', 640, 480, 'people', false)
    ];
});

$factory->afterCreating(App\User::class, function ($user, $faker) {
    $user->assignRole('Doctor');
});
