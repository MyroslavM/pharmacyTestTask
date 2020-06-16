<?php

use App\Disease;
use Illuminate\Database\Seeder;


class DiseaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Disease::create(['name' => 'дівгноз1']);
    }
}
