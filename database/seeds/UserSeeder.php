<?php
/**
 * Part of the Robin Radic's PHP packages.
 *
 * MIT License and copyright information bundled with this package
 * in the LICENSE file or visit http://radic.mit-license.com
 */
use Illuminate\Database\Seeder;

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Database\Eloquent\Model;

use Laradic\Support\String;

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
    /** Instantiates the class */
    public function run()
    {
        // Insert default roles and default permissions. Also, add all route names as permissions. ADmin and mod will get access
        /** @var \App\Role[] $roles */
        $routes = $this->getRouteNamePermissions();
        $roles  = [ ];
        foreach ( Config::get('packadic.acl.default_roles') as $roleName => $permissions )
        {
            /** @var \App\Role $role */
            $role = Sentinel::getRoleRepository()->createModel()->create([
                'name' => $roleName,
                'slug' => String::slugify($roleName, '_'),
            ]);
            foreach ( $permissions as $permission )
            {
                $role->addPermission($permission, true);
            }

            foreach ( $routes as $route )
            {
                $role->addPermission($route[ 'name' ], ($roleName === 'Admin' or $roleName === 'Moderator'));
            }
            $role->save();
            $roles[ $roleName ] = $role;
        }

        $faker = \Faker\Factory::create();
        $user  = \Sentinel::registerAndActivate([
            'email'      => 'robin@radic.nl',
            'password'   => 'test',
            "first_name" => 'Robin',
            "last_name"  => 'Radic'
        ]);
        $roles[ 'Admin' ]->users()->attach($user);

        foreach ( [ 'Admin' => 2, 'Moderator' => 10, 'User' => 50 ] as $role => $repeat )
        {
            for ( $i = 0; $i < $repeat; $i++ )
            {
                $user = \Sentinel::registerAndActivate([
                    'email'      => $faker->email,
                    'first_name' => $faker->firstName,
                    'last_name'  => $faker->lastName,
                    'password'   => str_random(10)
                ]);
                $roles[ $role ]->users()->attach($user);
            }
        }
    }
    protected function getRouteNamePermissions()
    {
        $routes     = app('Dingo\Api\Routing\Router')->getRoutes();
        $structured = [ ];
        foreach ( $routes as $collection )
        {
            foreach ( $collection->getRoutes() as $route )
            {
                if(is_null($route->getName())) continue;
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
