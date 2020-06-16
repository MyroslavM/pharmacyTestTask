<?php

namespace App\Modules\AdminUser\Providers;

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
        $this->loadTranslationsFrom(module_path('adminUser', 'Resources/Lang', 'app'), 'adminUser');
        $this->loadViewsFrom(module_path('adminUser', 'Resources/Views', 'app'), 'adminUser');
        $this->loadMigrationsFrom(module_path('adminUser', 'Database/Migrations', 'app'), 'adminUser');
        $this->loadConfigsFrom(module_path('adminUser', 'Config', 'app'));
        $this->loadFactoriesFrom(module_path('adminUser', 'Database/Factories', 'app'));
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
