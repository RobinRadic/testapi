<?php

namespace App;

use App\Traits\EloquentWithConstraints;

/**
 * This is the Role.
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property-read \App\User $user
 * @property integer $id
 * @property string $slug
 * @property string $name
 * @property string $permissions
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\static::$usersModel[] $users
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role wherePermissions($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereUpdatedAt($value)
 */
class Role extends \Cartalyst\Sentinel\Roles\EloquentRole{
    use EloquentWithConstraints;
    protected $hidden = ['created_at', 'updated_at', 'pivot'];
}
