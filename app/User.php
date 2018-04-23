<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'tel', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles() {
        return $this->belongsToMany(Roles::class, 'roles_has_users', 'users_id', 'roles_id')->withTimestamps();
    }

    public function isAdmin()
    {
        return $this->roles()->where('roles_id', 1)->first();
    }

    public function getOrder()
    {
        return $this->hasMany('App\Order', 'users_id', 'id');
    }

    public function getTort()
    {
        return $this->hasMany('App\Tort', 'users_id', 'id');
    }

    public function getWesele()
    {
        return $this->hasMany('App\Wesele', 'users_id', 'id');
    }
}
