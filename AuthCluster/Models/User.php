<?php namespace App\Clusters\AuthCluster\Models;

use App\Clusters\AuthCluster\Traits\User\ControlsUserAccessTrait;
use Auth;
use Hash;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword, ControlsUserAccessTrait;


    public static $tableName = 'users';

    public static $registerRules = [
        'username' => [ 'required', 'min:4', 'max:20', 'unique:users,username', 'regex:/^[a-z][a-z\d_.]+$/' ],
        'email'    => [ 'required', 'email', 'max:160', 'unique:users,email' ],
        'name'     => [ 'sometimes', 'min:3', 'max:160', "regex:/^[A-Za-z]'?[-\. a-zA-Z]+$/" ],
        'password' => [ 'required', 'confirmed', 'min:6', 'max:160' ]
    ];

    protected $_updateRules = [
        'email'    => [ 'required', 'email', 'max:160' ],
        'name'     => [ 'sometimes', 'min:3', 'max:160', "regex:/^[A-Za-z]'?[-\. a-zA-Z]+$/" ],
        'password' => [ 'sometimes', 'confirmed', 'min:6', 'max:160' ]
    ];

	protected $fillable = ['name', 'username', 'email', 'password'];

	protected $hidden = ['password', 'remember_token'];


    public function roleRelation()
    {
        return $this->hasOne('App\Clusters\AuthCluster\Models\AccessControl\UserRole');
    }

    public function permissionsRelation()
    {
        return $this->hasMany('App\Clusters\AuthCluster\Models\AccessControl\UserPermission');
    }


    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function setUsernameAttribute($value)
    {
        $this->attributes['username'] = strtolower($value);
    }


    public function getUpdateRules()
    {
        $rules = $this->_updateRules;

        if ( $this->id && $this->email ) {
            $rules['email'][] = 'unique:users,email,'. $this->id;
        }

        return $rules;
    }

    public function isCurrent()
    {
        if (Auth::guest()) return FALSE;

        return Auth::user()->id == $this->id;
    }

    public function permissions()
    {
        if ( !$this->id ) return [];

        $repo = \App::make('App\Clusters\AuthCluster\Repositories\UserRepository');

        return $repo->getPermissions($this->id);
    }

    public function role()
    {
        if ( !$this->id ) return [];

        $repo = \App::make('App\Clusters\AuthCluster\Repositories\UserRepository');

        return $repo->getRole($this->id);
    }

}
