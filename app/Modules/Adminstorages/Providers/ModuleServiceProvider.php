<?php

namespace App\Modules\Adminstorages\Providers;

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
        $this->loadTranslationsFrom(module_path('adminstorages', 'Resources/Lang', 'app'), 'adminstorages');
        $this->loadViewsFrom(module_path('adminstorages', 'Resources/Views', 'app'), 'adminstorages');
        $this->loadMigrationsFrom(module_path('adminstorages', 'Database/Migrations', 'app'), 'adminstorages');
        $this->loadConfigsFrom(module_path('adminstorages', 'Config', 'app'));
        $this->loadFactoriesFrom(module_path('adminstorages', 'Database/Factories', 'app'));
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
