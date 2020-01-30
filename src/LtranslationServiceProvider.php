<?php

namespace Webtamizhan\Ltrans;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class LtranslationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/views' => base_path('resources/views/vendor/translations'),
            __DIR__ . '/en/config.json' => base_path('resources/lang/en/config.json'),
            __DIR__.'/config/translation.php' => config_path('translation.php'),
        ], 'ltrans');
        $this->setupRoutes($this->app->router);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }

    public function setupRoutes(Router $router)
    {
        $router->group(['namespace' => 'Webtamizhan\Ltrans\Http\Controllers'], function($router)
        {
            require __DIR__.'/Http/routes.php';
        });
    }
}
