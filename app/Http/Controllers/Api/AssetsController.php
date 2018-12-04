<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Asset;
use App\AssetType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class AssetsController extends Controller
{
    protected $user;
    protected $request;

    public function __construct(Request $request)
    {
         //$this->user = auth('api')->user();
         
        $this->user = $request->user('api');
        $this->request = $request;    
        
    }


    public function index()
    {
              
        $clientId = $this->user->client_id;
        
        return Asset::where('client_id',$clientId)->select('barcode')->get()->pluck('barcode');
    }

    public function getAssetByBarcode($barcode)
    {
        
        $asset = Asset::with(['audits','assettype'])->where('barcode',$barcode)->first();  
       
        return ['asset'=>$asset->toArray()];
    }

    public function update( $barcode)
    {
            // Validate data
            $validatedData = $this->request->validate([
                'barcode' => 'required'
                ]);
            // Update data
            $asset = Asset::where('barcode',$barcode)->first();

            $data = $this->transform($this->request->input());

            //$data = $asset->setmeta($data);

            $asset->update($data);
            
            return ['data'=>'success','record'=>$data];

    }

    private function transform($data)
    {

        // Remove the ID
        unSet($data['id']);

        // Handle the switch inputs
        $data['quarantined'] = $data['quarantined']===true ? 1 : 0;
        $data['retire_from_service'] = $data['retire_from_service']===true ? 1 : 0;

        return $data;
    }

    
    
}
