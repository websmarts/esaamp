<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Asset;

class AssetsController extends Controller
{
    public function index()
    {
        return Asset::select('barcode')->get();
    }

    public function getAssetByBarcode($barcode)
    {
        
        
        $formData =  Asset::with('type')->where('barcode',$barcode)->first();

        

        $formSchema =  [ 
                
            [
                'name'=> 'description',
                'input'=>'v-text-field',
                'label'=> 'Description',
                'rules'=>  'required|min:2|max:250'
                            
            ],
            [
                'name'=> 'vendor',
                'input'=>'v-text-field',
                'label'=> 'Vendor',
                
                            
            ],
            [
                'name'=> 'vendor_part_reference',
                'input'=>'v-text-field',
                'label'=> 'Vendor Part#',
                
                            
            ],
            [
                'name'=> 'size',
                'input'=>'v-text-field',
                'label'=> 'Size',
                
                            
            ],
            [
                'name'=> 'cost_price',
                'input'=>'v-text-field',
                'label'=> 'Cost price',
                
                            
            ],
            [
                'name'=> 'cost_centre',
                'input'=>'v-text-field',
                'label'=> 'Cost centre',
                
                
            ],
            [
                'name'=> 'quarantined',
                'input'=>'v-switch',
                'label'=> 'Quarantined',
                
                
            ],
            [
                'name'=> 'retired_date',
                'input'=>'v-date-picker',
                'landscape'=>false,
                'reactive'=>true,
                'label'=> 'Retired date',
                
                
            ]    
            

        ];

        return ['data'=>$formData,'dataschema'=>$formSchema];
    }
}
