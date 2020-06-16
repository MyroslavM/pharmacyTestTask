<?php

use App\User;
use Illuminate\Database\Seeder;

class AdminUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create(['name' => 'Povarss', 'email' => 'meroslavchuk@gmail.com', 'password' => 'meroslavchuk@gmail.com']);
        $user->assignRole('SuperAdmin');
        $user = User::create(['name' => 'admin', 'email' => 'admin@gmail.com', 'password' => 'admin@gmail.com']);
        $user->assignRole('SuperAdmin');


        $user = User::create(['name' => 'Іванов','surname'=>'Іван','patronymic'=>'Іванович', 'email' => 'ivanov@gmail.com', 'password' => 'ivanov@gmail.com']);
        $user->assignRole('Doctor');

        $user = User::create(['name' => 'Петренко','surname'=>'Петро','patronymic'=>'Петрович', 'email' => 'petrenko@gmail.com', 'password' => 'petrenko@gmail.com']);
        $user->assignRole('Doctor');
    }
}


