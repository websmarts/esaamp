<?php

namespace App;

use App\Traits\storesMetadata;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    use storesMetadata;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'asset_id',
        'created_by',
        'meta'
    ];

    protected $casts = [
        'meta' => 'array'
    ];


    /**
     *  Returns an array of the supported keys in metadata
     */
    protected function metakeys()
    {
        
        return collect($this->asset->assettype->auditschema)->pluck('name')->all();
    }

    public function asset()
    {
        return $this->belongsTo('App\Asset');
    }
}
