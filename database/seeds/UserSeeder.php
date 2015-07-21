<?php
/**
 * Part of the Robin Radic's PHP packages.
 *
 * MIT License and copyright information bundled with this package
 * in the LICENSE file or visit http://radic.mit-license.com
 */

use Illuminate\Database\Seeder;
use Laradic\Support\String;
use App\Permission;
use App\Role;
use App\User;


/**
 * This is the UserSeeder.
 *
 * @version        1.0.0
 * @author         Robin Radic
 * @license        MIT License
 * @copyright      2015, Robin Radic
 * @link           https://github.com/robinradic
 */
class UserSeeder extends Seeder
{


    protected function mk($name, $displayname, $desc)
    {
        return [ 'name' => $name, 'display_name' => $displayname, 'description' => $desc ];
    }

    public function run()
    {

        $routes = $this->getRouteNamePermissions();
        $roles = [
            $this->mk('admin', 'Admin', 'Administrator can do everything'),
            $this->mk('moderator', 'Moderator', 'Moderator is quite powerfull aswell'),
            $this->mk('user', 'User', 'Regular users are allowed to pay money')
        ];

        $permissions = [];
        foreach ( $routes as $route )
        {
            $permissions[$route['name']] = Permission::create($this->mk($route[ 'name' ], 'API Route: ' . $route[ 'name' ], $route[ 'action' ]));
        }

        foreach ( $roles as $role )
        {
            $roles[$role['name']] = Role::create($role);
        }

        $roles['admin']->attachPermissions(array_values($permissions));
        $roles['moderator']->attachPermissions(array_values($permissions));

        factory(App\User::class, 'radic')->create()->attachRole($roles['admin']);
        factory(App\User::class, 'admin', 2)->create()->each(function($u) use ($roles) {
            $u->attachRole($roles['moderator']);
        });
        factory(App\User::class, 40)->create()->each(function($u) use ($roles) {
            $u->attachRole($roles['user']);
        });
    }


    protected function getRouteNamePermissions()
    {
        $routes     = app('Dingo\Api\Routing\Router')->getRoutes();
        $structured = [ ];
        foreach ( $routes as $collection )
        {
            foreach ( $collection->getRoutes() as $route )
            {
                if ( is_null($route->getName()) )
                {
                    continue;
                }
                $structured[] = [
                    'host'      => $route->domain(),
                    'uri'       => implode('|', $route->methods()) . ' ' . $route->uri(),
                    'name'      => $route->getName(),
                    'action'    => $route->getActionName(),
                    'versions'  => implode(', ', $route->versions()),
                    'protected' => $route->isProtected() ? 'Yes' : 'No',
                    'scopes'    => implode(', ', $route->scopes())
                ];
            }
        }

        return $structured;
    }

}
