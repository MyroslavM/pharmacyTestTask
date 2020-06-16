<?php

use Illuminate\Database\Seeder;

class WhereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Where::create(['name' => 'Від друзів, знайомих']);
        \App\Where::create(['name' => 'Фейсбук']);
        \App\Where::create(['name' => 'Інстаграм']);
        \App\Where::create(['name' => 'Інтернет']);
        \App\Where::create(['name' => 'Інше']);
    }
}
