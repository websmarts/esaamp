<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'asset_id',
        'auditdata'
    ];
}
