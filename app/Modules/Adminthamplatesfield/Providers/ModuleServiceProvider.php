<?php

namespace App\Modules\Adminthamplatesfield\Providers;

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
        $this->loadTranslationsFrom(module_path('adminthamplatesfield', 'Resources/Lang', 'app'), 'adminthamplatesfield');
        $this->loadViewsFrom(module_path('adminthamplatesfield', 'Resources/Views', 'app'), 'adminthamplatesfield');
        $this->loadMigrationsFrom(module_path('adminthamplatesfield', 'Database/Migrations', 'app'), 'adminthamplatesfield');
        $this->loadConfigsFrom(module_path('adminthamplatesfield', 'Config', 'app'));
        $this->loadFactoriesFrom(module_path('adminthamplatesfield', 'Database/Factories', 'app'));
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
