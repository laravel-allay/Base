<?php

namespace Allay\Base;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Route;

class BaseServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(\Illuminate\Routing\Router $router)
    {
        // LOAD THE VIEWS
        // - first the published views (in case they have any changes)
        $this->loadViewsFrom(resource_path('views/vendor/allay/base'), 'allay');
        // - then the stock views that come with the package, in case a published view might be missing
        $this->loadViewsFrom(realpath(__DIR__.'/resources/views'), 'allay');

        $this->loadTranslationsFrom(realpath(__DIR__.'/resources/lang'), 'allay');

        // use the vendor configuration file as fallback
        $this->mergeConfigFrom(
            __DIR__.'/config/allay/base.php', 'allay.base'
        );

        $this->setupRoutes($this->app->router);

        // -------------
        // PUBLISH FILES
        // -------------
        // publish config file
        $this->publishes([__DIR__.'/config' => config_path()], 'config');
        // publish lang files
        $this->publishes([__DIR__.'/resources/lang' => resource_path('lang/vendor/allay')], 'lang');
        // publish views
        $this->publishes([__DIR__.'/resources/views' => resource_path('views/vendor/allay/base')], 'views');
        // publish error views
        $this->publishes([__DIR__.'/resources/error_views' => resource_path('views/errors')], 'errors');
        // publish public Allay assets
        $this->publishes([__DIR__.'/public' => public_path('vendor/allay')], 'public');
        // publish public AdminLTE assets
        $this->publishes([base_path('vendor/almasaeed2010/adminlte') => public_path('vendor/adminlte')], 'adminlte');
    }

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        // register the 'admin' middleware
        $router->aliasMiddleware('admin', app\Http\Middleware\Admin::class);
        $router->aliasMiddleware('IsVerified', config('allay.base.user_verification_middleware_fqn'));

        $router->group(['namespace' => 'Allay\Base\app\Http\Controllers'], function ($router) {
            Route::group(
                [
                    'middleware' => ['web'],
                    'prefix'     => config('allay.base.route_prefix'),
                ],
                function () {
                    // if not otherwise configured, setup the auth routes
                    if (config('allay.base.setup_auth_routes')) {
                        // Auth
                        Route::auth();
                        Route::get('logout', 'Auth\LoginController@logout');

                        // Verification routes (requires login)
                        Route::group(['middleware' => 'admin'], function() {
                            // Email verification
                            Route::get(
                                'email-verification/verify',
                                'Auth\RegisterController@getVerify'
                            )->name('email-verification.verify');

                            Route::get(
                                'email-verification/check/{token}',
                                'Auth\RegisterController@getVerification'
                            )->name('email-verification.check');

                            Route::get(
                                'email-verification/resend',
                                'Auth\RegisterController@getResendVerification'
                            )->name('email-verification.resend');
                        });
                    }

                    // if not otherwise configured, setup the dashboard routes
                    if (config('allay.base.setup_dashboard_routes')) {
                        Route::get('dashboard', 'AdminController@dashboard');
                        Route::get('/', 'AdminController@redirect');
                    }
                });
        });
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        // register the current package
        $this->app->bind('base', function ($app) {
            return new Base($app);
        });

        // register its dependencies
        $this->app->register(\Jenssegers\Date\DateServiceProvider::class);
        $this->app->register(\Prologue\Alerts\AlertsServiceProvider::class);
        $this->app->register(\Jrean\UserVerification\UserVerificationServiceProvider::class);
        $this->app->register(\Zschuessler\RouteToClass\ServiceProvider::class);

        // register their aliases
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Alert', \Prologue\Alerts\Facades\Alert::class);
        $loader->alias('Date', \Jenssegers\Date\Date::class);
        $loader->alias('UserVerification', \Jrean\UserVerification\Facades\UserVerification::class);

        // Merge configurations
        $this->publishes([__DIR__.'/config/route2class.php' => config_path('route2class.php')]);

        $this->mergeConfigFrom(
            __DIR__.'/config/route2class.php', 'route2class'
        );

        // Custom merge, since `mergeConfigFrom` doesn't support nested arrays.
        $baseGeneratorConfig = (require __DIR__.'/config/route2class.php')['generators'];
        $appGeneratorConfig = config('route2class.generators');

        if ($appGeneratorConfig
            && true === config('route2class.use_default_generators')) {
            $mergedGenerators = array_unique(array_merge($baseGeneratorConfig, $appGeneratorConfig));

            $this->app['config']->set('route2class.generators', $mergedGenerators);
        }
    }
}
