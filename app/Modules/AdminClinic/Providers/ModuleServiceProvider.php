<?php

namespace App\Modules\AdminClinic\Providers;

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
        $this->loadTranslationsFrom(module_path('adminClinic', 'Resources/Lang', 'app'), 'adminClinic');
        $this->loadViewsFrom(module_path('adminClinic', 'Resources/Views', 'app'), 'adminClinic');
        $this->loadMigrationsFrom(module_path('adminClinic', 'Database/Migrations', 'app'), 'adminClinic');
        $this->loadConfigsFrom(module_path('adminClinic', 'Config', 'app'));
        $this->loadFactoriesFrom(module_path('adminClinic', 'Database/Factories', 'app'));
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
