<?php

namespace App;

use App\Traits\EloquentWithConstraints;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * This is the User.
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @mixin \Cartalyst\Sentinel\Users\EloquentUser
 * @mixin \Illuminate\Database\Eloquent\Model
 * @method \App\User withOnly($relation, $columns)
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $permissions
 * @property string $last_login
 * @property string $first_name
 * @property string $last_name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\static::$rolesModel[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\static::$persistencesModel[] $persistences
 * @property-read \Illuminate\Database\Eloquent\Collection|\static::$activationsModel[] $activations
 * @property-read \Illuminate\Database\Eloquent\Collection|\static::$remindersModel[] $reminders
 * @property-read \Illuminate\Database\Eloquent\Collection|\static::$throttlingModel[] $throttle
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePermissions($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLastLogin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 */
class User extends \Cartalyst\Sentinel\Users\EloquentUser implements Authenticatable {

    use EloquentWithConstraints;

    protected $hidden = ['password'];

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string $value
     * @return void
     */
    public function setRememberToken($value)
    {
        /** @var \Cartalyst\Sentinel\Reminders\EloquentReminder $m */
        $m = \Reminder::createModel();

    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
    }
}
