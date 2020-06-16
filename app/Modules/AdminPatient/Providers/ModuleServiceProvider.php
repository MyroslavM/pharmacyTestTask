<?php

namespace App\Modules\AdminPatient\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(module_path('adminPatient', 'Resources/Lang', 'app'), 'adminPatient');
        $this->loadViewsFrom(module_path('adminPatient', 'Resources/Views', 'app'), 'adminPatient');
        $this->loadMigrationsFrom(module_path('adminPatient', 'Database/Migrations', 'app'), 'adminPatient');
        $this->loadConfigsFrom(module_path('adminPatient', 'Config', 'app'));
        $this->loadFactoriesFrom(module_path('adminPatient', 'Database/Factories', 'app'));
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
