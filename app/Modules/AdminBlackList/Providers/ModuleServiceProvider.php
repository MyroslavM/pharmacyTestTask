<?php

namespace App\Modules\AdminBlackList\Providers;

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
        $this->loadTranslationsFrom(module_path('adminBlackList', 'Resources/Lang', 'app'), 'adminBlackList');
        $this->loadViewsFrom(module_path('adminBlackList', 'Resources/Views', 'app'), 'adminBlackList');
        $this->loadMigrationsFrom(module_path('adminBlackList', 'Database/Migrations', 'app'), 'adminBlackList');
        $this->loadConfigsFrom(module_path('adminBlackList', 'Config', 'app'));
        $this->loadFactoriesFrom(module_path('adminBlackList', 'Database/Factories', 'app'));
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
