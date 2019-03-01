<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wash extends Model
{
    
    protected $table = "washes";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'asset_id',
        'client_id', 
        'washdate',
        'washcount',
        'condition',
        'quarantined'

    ];
}
