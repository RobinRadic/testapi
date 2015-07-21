<?php
/**
 * Part of the Robin Radic's PHP packages.
 *
 * MIT License and copyright information bundled with this package
 * in the LICENSE file or visit http://radic.mit-license.com
 */
namespace App\Http\Middleware;

use Closure;
use Dingo\Api\Auth\Auth as Authorization;
use Dingo\Api\Routing\Router;
use Entrust;


/**
 * This is the RequirePermission.
 *
 * @package        App\Http
 * @version        1.0.0
 * @author         Robin Radic
 * @license        MIT License
 * @copyright      2015, Robin Radic
 * @link           https://github.com/robinradic
 */
class RouteNamePermission
{
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
     * Create a new auth middleware instance.
     *
     * @param \Dingo\Api\Routing\Router $router
     * @param \Dingo\Api\Auth\Auth $auth
     */
    public function __construct(Router $router, Authorization $auth)
    {
        $this->router = $router;
        $this->auth = $auth;
    }

    /**
     * Checks if the user has permission to visit the route.
     * By default it will check if the current route name is in the user permissions.
     * If $permissions is provided, it will check if the $permission value is in the user permissions
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @param null|string                      $permission
     * @return mixed
     */
    public function handle($request, Closure $next, $permission = null)
    {
        if ( is_null($permission) )
        {
            $name = $this->router->getCurrentRoute()->getName();
            $permission = is_null($name) ? $this->router->getCurrentRoute()->getActionName() : $name;
        }
        if(Entrust::can($permission))
        {
            return $next($request);
        } else {
            return response('Unauthorized.', 401) ;
        }
    }
}
