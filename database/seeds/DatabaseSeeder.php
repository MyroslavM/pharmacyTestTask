<?php

use App\Disease;
use App\Manipulation;
use App\Product;
use App\Service;
use App\Status;
use App\User;
use App\Where;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (Role::count() == 0) {
            $this->call(RolesSeeder::class);
        }
        if (User::count() == 0) {
            $this->call(AdminUsers::class);
        }
        if (Disease::count() == 0) {
            $this->call(DiseaseSeeder::class);
        }
        if (Product::count() == 0) {
            $this->call(ProductsSeeder::class);
        }
        if (Where::count() == 0) {
            $this->call(WhereSeeder::class);
        }
        if (Service::count() == 0) {
            $this->call(ServiceSeeder::class);
        }
        if (Status::count() == 0) {
            $this->call(StatusSeeder::class);
        }
        if (Manipulation::count() == 0) {
            $this->call(ManipulationSeeder::class);
        }

    }
}
