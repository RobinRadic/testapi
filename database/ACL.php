<?php
/**
 * Part of the Robin Radic's PHP packages.
 *
 * MIT License and copyright information bundled with this package
 * in the LICENSE file or visit http://radic.mit-license.com
 */
namespace App;

/**
 * This is the UserRepository.
 *
 * @package        App\Repositories
 * @version        1.0.0
 * @author         Robin Radic
 * @license        MIT License
 * @copyright      2015, Robin Radic
 * @link           https://github.com/robinradic
 */
class ACL
{
    public static function allow($permission, $role){
        $permission = $permission instanceof Permission ? $permission : Permission::findBySlugOrFail($role);
        $role = $role instanceof Role ? $role : Role::findBySlugOrFail($role);
    }

    public static function createPermission($name, $slug = false)
    {
        with($permission = new Permission)->fill([ 'name' => $name, 'slug' => $slug !== false ? $slug : null ])->validate();
        if ( $permission->hasErrors() )
        {
            return false;
        }
        $permission->save();

        return $permission;
    }

    public static function createRole($name, $slug = false)
    {
        with($role = new Role)->fill([ 'name' => $name, 'slug' => $slug !== false ? $slug : null ])->validate();
        if ( $role->hasErrors() )
        {
            return false;
        }
        $role->save();

        return $role;
    }

    public static function registerUser($username, $email, $password)
    {
        with($user = new User)->fill(compact('username', 'email', 'password'))->validate();
        if ( $user->hasErrors() )
        {
            return false;
        }
        $user->save();

        return $user;
    }

}
