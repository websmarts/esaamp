<?php

namespace App;

use App\Scopes\ClientScope;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id', 'name'
    ];

    protected $hidden = ['updated_at','created_at'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ClientScope);
    }

    public function departments() 
    {
        return $this->hasMany('App\Department');
    }
}
