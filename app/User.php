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
        'name', 'email', 'password',
        'date_of_birth', 'phone_number', 'address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){

        return $this->belongsToMany('App\Role');
    }

    //----Authorization blocks--
    public function hasRole($role)
    {
        if ($this->isSuperAdmin()) {
            return true;
        }
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }
        return !! $this->roles->intersect($role)->count();
    }

    public function isSuperAdmin()
    {
        if ($this->roles->contains('name', 'Super Admin')) {
            return true;
        }
        return false;
    }

    //Relation with Rate
    public function rate()
    {
        return $this->hasOne('App\Rate');
    }

    //Relation with payroll
    public function payrolls()
    {
        return $this->hasMany('App\Payroll');
    }
}
