<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api\V1\Controller;
use Dingo\Api\Auth\Auth as Authentication;
use Dingo\Api\Routing\Router;
use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;


class RouteCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    /**
     * Router instance.
     *
     * @var \Dingo\Api\Routing\Router
     */
    protected $router;

    /**
     * Authenticator instance.
     *
     * @var \Dingo\Api\Auth\Auth
     */
    protected $auth;

    /**
     * {@inheritDoc}
     */
    public function __construct(Encrypter $encrypter, Router $router, Authentication $auth)
    {
        parent::__construct($encrypter);
        $this->router = $router;
        $this->auth   = $auth;;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     *
     */
    public function handle($request, \Closure $next)
    {
        $route = $this->router->getCurrentRoute();
        if ( $route->usesController() )
        {
            /** @var Controller $controller */
            $controller = $route->getController();
            if ( property_exists($controller, 'crsfExclusions') and method_exists($controller, 'getCrsfExclusions') )
            {
                $excludedMethodNames = $controller->getCrsfExclusions();
                $action              = $route->getAction();
                $use                 = isset($action[ 'uses' ]) ? $action[ 'uses' ] : $action[ 'controller' ];
                if ( ! is_null($use) )
                {
                    list(, $methods) = explode('@', $use);
                    foreach ( explode(',', $methods) as $method )
                    {
                        if ( method_exists($controller, $method) and in_array($method, $excludedMethodNames) )
                        {
                            // Skip it!
                            return $next($request);
                        }
                    }
                }
            }
        }

        parent::handle($request, $next);
    }

}
