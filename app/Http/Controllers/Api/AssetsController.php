<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Asset;
use App\AssetType;

class AssetsController extends Controller
{
    public function index()
    {
        return Asset::select('barcode')->get();
    }

    public function getAssetByBarcode($barcode)
    {
        
        $asset = Asset::where('barcode',$barcode)->first();

        $data = $asset->toArray();
        $meta = $data['meta'];

        //dd($meta);
        foreach($meta as $key=>$value){
            $data[$key]=$value;
        }

        unSet($data['meta']);
        

        $assetType = AssetType::find($asset->asset_type_id);

        
        return ['data'=>$data,'dataschema'=>$assetType->dataschema];
    }
}
