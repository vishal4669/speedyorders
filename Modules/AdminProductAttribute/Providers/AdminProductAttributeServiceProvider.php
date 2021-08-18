<?php

namespace Modules\AdminProductAttribute\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class AdminProductAttributeServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(module_path('AdminProductAttribute', 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('AdminProductAttribute', 'Config/config.php') => config_path('adminproductattribute.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('AdminProductAttribute', 'Config/config.php'), 'adminproductattribute'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/adminproductattribute');

        $sourcePath = module_path('AdminProductAttribute', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/adminproductattribute';
        }, \Config::get('view.paths')), [$sourcePath]), 'adminproductattribute');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/adminproductattribute');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'adminproductattribute');
        } else {
            $this->loadTranslationsFrom(module_path('AdminProductAttribute', 'Resources/lang'), 'adminproductattribute');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path('AdminProductAttribute', 'Database/factories'));
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
