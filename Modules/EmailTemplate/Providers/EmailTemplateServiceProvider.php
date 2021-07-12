<?php

namespace Modules\EmailTemplate\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class EmailTemplateServiceProvider extends ServiceProvider
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
        $this->loadMigrationsFrom(module_path('EmailTemplate', 'Database/Migrations'));
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
            module_path('EmailTemplate', 'Config/config.php') => config_path('emailtemplate.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('EmailTemplate', 'Config/config.php'), 'emailtemplate'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/emailtemplate');

        $sourcePath = module_path('EmailTemplate', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/emailtemplate';
        }, \Config::get('view.paths')), [$sourcePath]), 'emailtemplate');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/emailtemplate');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'emailtemplate');
        } else {
            $this->loadTranslationsFrom(module_path('EmailTemplate', 'Resources/lang'), 'emailtemplate');
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
            app(Factory::class)->load(module_path('EmailTemplate', 'Database/factories'));
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
