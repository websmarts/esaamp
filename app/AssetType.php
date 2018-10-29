<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
        'name',
        'dataschema',
        'auditschema' 
    ];

    protected $casts = [
        'dataschema' => 'array',
        'auditschema' => 'array'
    ];
}
