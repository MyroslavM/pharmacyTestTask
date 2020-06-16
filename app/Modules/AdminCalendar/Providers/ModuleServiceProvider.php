<?php

namespace App\Modules\AdminCalendar\Providers;

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
        $this->loadTranslationsFrom(module_path('adminCalendar', 'Resources/Lang', 'app'), 'adminCalendar');
        $this->loadViewsFrom(module_path('adminCalendar', 'Resources/Views', 'app'), 'adminCalendar');
        $this->loadMigrationsFrom(module_path('adminCalendar', 'Database/Migrations', 'app'), 'adminCalendar');
        $this->loadConfigsFrom(module_path('adminCalendar', 'Config', 'app'));
        $this->loadFactoriesFrom(module_path('adminCalendar', 'Database/Factories', 'app'));
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
