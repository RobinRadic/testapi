<?php

namespace App\Providers;

use App\Auth;
use Dingo\Api\Provider\LaravelServiceProvider;
use ReflectionClass;
use Illuminate\Contracts\Http\Kernel;
use Dingo\Api\Routing\Adapter\Laravel as LaravelAdapter;

class DingoServiceProvider extends LaravelServiceProvider
{

    /**
     * Register the auth.
     *
     * @return void
     */
    protected function registerAuth()
    {
        $this->app->singleton('api.auth', function ($app) {
            $config = $app['config']['api'];

            return new Auth($app['api.router'], $app, $this->prepareConfigValues($config['auth']));
        });
    }
}
