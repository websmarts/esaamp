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
        'meta', 

        'condition',
        
        'quarantined',
        'retire_from_service',

        'commissioned_date', 
        'retired_date', 
        'next_audit_due' 
    ];

    protected $casts = [
        'meta' => 'array'
    ];

    public function atype()
    {
        return $this->belongsTo('App\AssetType','asset_type_id');
    }
}
