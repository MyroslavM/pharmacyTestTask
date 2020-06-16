<?php

use Illuminate\Database\Seeder;

class ManipulationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Manipulation::create(['name' => 'Маніпуляція']);
        \App\Manipulation::create(['name' => 'Інше']);

    }
}
