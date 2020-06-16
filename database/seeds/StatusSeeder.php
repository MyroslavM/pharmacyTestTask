<?php

use App\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create(['id' => 1, 'name' => 'Не підтверджено', 'color' => '#893dff']);
        Status::create(['id' => 2, 'name' => 'Підтверджено', 'color' => '#0061da']);
        Status::create(['id' => 3, 'name' => 'Завершено', 'color' => '#4ecc48']);
        Status::create(['id' => 4, 'name' => 'Не з\'явився', 'color' => '#c21a1a']);
        Status::create(['id' => 5, 'name' => 'Відмінено', 'color' => '#000']);
    }
}
