<?php

namespace App\Modules\Widget\Providers;

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
        $this->loadTranslationsFrom(module_path('widget', 'Resources/Lang', 'app'), 'widget');
        $this->loadViewsFrom(module_path('widget', 'Resources/Views', 'app'), 'widget');
        $this->loadMigrationsFrom(module_path('widget', 'Database/Migrations', 'app'), 'widget');
        $this->loadConfigsFrom(module_path('widget', 'Config', 'app'));
        $this->loadFactoriesFrom(module_path('widget', 'Database/Factories', 'app'));
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
