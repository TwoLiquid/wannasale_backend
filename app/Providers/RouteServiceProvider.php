<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $router = app(Router::class);

        $id   = '^(?!0)[\d]+';
        $uuid = '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}';
        $slug = '[a-zA-Z0-9-]+';

        $router->pattern('id', $id);
        $router->pattern('uuid', $uuid);
        $router->pattern('slug', $slug);
        $router->pattern('hash', '[a-zA-Z0-9=]+');
        $router->pattern('any', '^(?!_)[\w\d\/-]+');

        $router->pattern('vendorSlug', $slug);

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $router = app(Router::class);

        // The "api" routes for the application.
        $router->group(['middleware' => 'api', 'namespace' => $this->namespace], function () : void {
            require base_path('routes/v1/api.php');
        });

        // The "web" routes for the application.
        $router->group(['middleware' => 'web', 'namespace' => $this->namespace], function () : void {
            require base_path('routes/web.php');
        });
    }
}
