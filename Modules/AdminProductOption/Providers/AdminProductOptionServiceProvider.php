<?php

namespace Modules\AdminProductOption\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class AdminProductOptionServiceProvider extends ServiceProvider
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
        $this->loadMigrationsFrom(module_path('AdminProductOption', 'Database/Migrations'));
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
            module_path('AdminProductOption', 'Config/config.php') => config_path('adminproductoption.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('AdminProductOption', 'Config/config.php'), 'adminproductoption'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/adminproductoption');

        $sourcePath = module_path('AdminProductOption', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/adminproductoption';
        }, \Config::get('view.paths')), [$sourcePath]), 'adminproductoption');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/adminproductoption');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'adminproductoption');
        } else {
            $this->loadTranslationsFrom(module_path('AdminProductOption', 'Resources/lang'), 'adminproductoption');
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
            app(Factory::class)->load(module_path('AdminProductOption', 'Database/factories'));
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
