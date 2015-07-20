<?php

namespace App;

use App\Contracts\Validatable as ValidatableContract;
use App\Traits\Validatable;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * This is the Permission.
 *
 * @package        App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Permission extends Model implements ValidatableContract, SluggableInterface
{
    use Validatable, SluggableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name' ];

    public  $timestamps = false;

    protected $rules = [
        'create' => [
            'name' => 'required|max:40',
            'slug'    => 'required|unique:permissions'
        ]
    ];

    protected $sluggable = [
        'build_from' => 'name',
        'save_to'    => 'slug',
        'max_length' => 255,
    ];

    public function users()
    {
        return $this->hasManyThrough('App\User', 'App\Role', 'user_id', 'role_id');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_permissions', 'role_id', 'permission_id');
    }

    public static function createPermission($slug, $name){
        return with(new static)->validate([
            'name' => $name,
            'slug' => $slug
        ]);
    }
}
