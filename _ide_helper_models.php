<?php
/**
 * An helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * This is the User.
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property integer $id 
 * @property string $username 
 * @property string $email 
 * @property string $password 
 * @property string $remember_token 
 * @property string $deleted_at 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Role[] $roles 
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 */
	class User {}
}

namespace App{
/**
 * This is the Role.
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property integer $id 
 * @property string $name 
 * @property string $slug 
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users 
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Permission[] $permissions 
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereSlug($value)
 */
	class Role {}
}

namespace App{
/**
 * This is the Permission.
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property integer $id 
 * @property string $name 
 * @property string $slug 
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Role[] $roles 
 * @method static \Illuminate\Database\Query\Builder|\App\Permission whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Permission whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Permission whereSlug($value)
 */
	class Permission {}
}

