<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Asset;
use App\AssetType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssetTypesController extends Controller
{
    public function index()
    {
        return AssetType::where('client_id',Auth::user()->client_id)->get();
    }

    public function getAssetByBarcode($barcode)
    {
        
        $asset = Asset::with('assettype')->where('barcode',$barcode)->first();  
       
        return ['asset'=>$asset->toArray()];
    }

    public function update(Request $request, $barcode)
    {
            // Validate data
            $validatedData = $request->validate([
                'barcode' => 'required',
                'body' => 'required'
                ]);
            // Update data
            $asset = Asset::where('barcode',$barcode)->first();

            $data = $this->transform($request,$asset);

            $asset->update($data);
            
            return ['data'=>'success','record'=>$data];

    }

    private function transform($request,$asset)
    {

        // Transform the form data into suitable format
        // for model update or save
        $data = $request->input();


        
        // Remove the ID
        unSet($data['id']);

        // Handle the switch inputs
        $data['quarantined'] = $data['quarantined']===true ? 1 : 0;
        $data['retire_from_service'] = $data['retire_from_service']===true ? 1 : 0;

        // update any meta data
        // The meta field keys are stored in the asset_type table
        //$assetType = AssetType::find($data['asset_type_id']);




        // dd($asset);
        $metadata = $asset->meta;

        $metakeys = $asset->atype->metakeys;

        if(is_array($metakeys) && count($metakeys)){
            foreach($metakeys as $input){
                if(isSet($data[$input])){
                    $metadata[$input] = $data[$input];
                }
            }
            $data['meta'] = $metadata;
        }
        

        return $data;
    }
}
