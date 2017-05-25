<?php
namespace Xetaio\Editor;

use Illuminate\Support\ServiceProvider;

class EditorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__ . '/../config/editor.php';
        $this->mergeConfigFrom($configPath, 'editor');
        $this->publishes([$configPath => config_path('editor.php')], 'config');

        $publicPath = __DIR__ . '/../public';
        $this->publishes([$publicPath => public_path('')], 'public');

        $viewPath = __DIR__ . '/../resources/views';
        $this->loadViewsFrom($viewPath, 'editor');

        $routePath = __DIR__ . '/Http/routes.php';
        if (!$this->app->routesAreCached()) {
            require $routePath;
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['editor'];
    }
}
