<?php

namespace App\Modules\AdminStatistic\Providers;

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
        $this->loadTranslationsFrom(module_path('adminStatistic', 'Resources/Lang', 'app'), 'adminStatistic');
        $this->loadViewsFrom(module_path('adminStatistic', 'Resources/Views', 'app'), 'adminStatistic');
        $this->loadMigrationsFrom(module_path('adminStatistic', 'Database/Migrations', 'app'), 'adminStatistic');
        $this->loadConfigsFrom(module_path('adminStatistic', 'Config', 'app'));
        $this->loadFactoriesFrom(module_path('adminStatistic', 'Database/Factories', 'app'));
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
