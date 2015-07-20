<?php

namespace App;

use App\Contracts\Validatable as ValidatableContract;
use App\Traits\Validatable;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\MessageBag;

/**
 * This is the Role.
 *
 * @package        App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property-read \App\User $user
 * Cartalyst\Sentinel\Roles\EloquentRole
 */
class Role extends Model implements ValidatableContract, SluggableInterface
{
    use Validatable, SluggableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name' ];

    public $timestamps = false;

    protected $rules = [
        'create' => [
            'name' => 'required|max:20',
            'slug'    => 'required|unique:role'
        ]
    ];

    protected $sluggable = [
        'build_from' => 'name',
        'save_to'    => 'slug',
        'max_length' => 255,
    ];

    /** @return BelongsToMany */
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_roles', 'role_id', 'user_id');
    }

    /** @return BelongsToMany */
    public function permissions()
    {
        return $this->belongsToMany('App\Permission', 'role_permissions', 'role_id', 'permission_id');
    }


}
