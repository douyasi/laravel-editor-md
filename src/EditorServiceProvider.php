<?php

namespace Douyasi\Editor;

class EditorServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {

        //配置
        $configPath = __DIR__ . '/../config/editor.php';
        $this->mergeConfigFrom($configPath, 'editor');
        $this->publishes([$configPath => config_path('editor.php')], 'config');

        //公共资源
        $publicPath = __DIR__ . '/../public';
        $this->publishes([$publicPath => public_path('')], 'public');

        //视图
        $viewPath = __DIR__ . '/../resources/views';
        $this->loadViewsFrom($viewPath, 'editor');

        //路由
        $routePath = __DIR__ . '/Http/routes.php';
        if (! $this->app->routesAreCached()) {
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
