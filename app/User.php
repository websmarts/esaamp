<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
        'name', 
        'title',
        'email', 
        'roles',
        'password',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // 'client_id',
        // 'name',
        // 'title',
        // 'roles',
        // 'email',
        'password',
        'remember_token'
    ];

    public function hasRole($role)
    {
        // dd([$this->roles,$role]);
        $roles = explode(',' , $this->roles);
        return in_array($role,$roles);
        
        // return strpos($this->roles,$role) !== false;
    }
}
