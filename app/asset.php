<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
        'barcode',
        'vendor', 
        'vendor_part_reference', 
        'description', 
        'size', 
        'cost_price', 
        'site_id',
        'department_id',
        
        'cost_centre', 

        'asset_type_id',
        'jdata', 
        
        'quarantined',
        'retire_from_service',

        'commissioned_date', 
        'retired_date', 
        'next_audit_due' 
    ];

    protected $casts = [
        'jdata' => 'array'
    ];

    public function type()
    {
        return $this->belongsTo('App\AssetType');
    }
}
