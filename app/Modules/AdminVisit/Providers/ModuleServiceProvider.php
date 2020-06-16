<?php

namespace App\Modules\AdminVisit\Providers;

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
        $this->loadTranslationsFrom(module_path('adminVisit', 'Resources/Lang', 'app'), 'adminVisit');
        $this->loadViewsFrom(module_path('adminVisit', 'Resources/Views', 'app'), 'adminVisit');
        $this->loadMigrationsFrom(module_path('adminVisit', 'Database/Migrations', 'app'), 'adminVisit');
        $this->loadConfigsFrom(module_path('adminVisit', 'Config', 'app'));
        $this->loadFactoriesFrom(module_path('adminVisit', 'Database/Factories', 'app'));
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
