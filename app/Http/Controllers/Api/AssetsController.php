<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Asset;
use App\Client;
use App\AssetType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class AssetsController extends Controller
{
    protected $user;
    protected $client;
    protected $request;

    public function __construct(Request $request)
    {
         //$this->user = auth('api')->user();
         
        $this->user = $request->user('api');
        $this->client = Client::find($this->user->client_id);
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

       //dd($asset);

        return ['asset'=>$asset->toArray()];
    }

    public function store()
    {
        $data = $this->getData($this->request->input());
        //dd($data);

        $asset = Asset::create($data);

        return ['data'=>'success','record'=>$data];

    }

    public function update( $barcode)
    {
            // Validate data
            $validatedData = $this->request->validate([
                'barcode' => 'required'
                ]);
            // Update data
            $asset = Asset::where('barcode',$barcode)->first();

            $data = $this->getData($this->request->input());

            $asset->update($data);

            sleep(2);
            
            return ['data'=>'success','record'=>$data];

    }

    private function getData($data)
    {

        // Remove the ID
        unSet($data['id']);

        // Note Meta data handled by Asset model

        // Handle the switch inputs
        $data['quarantined'] = $data['quarantined']===true ? 1 : 0;
        $data['retire_from_service'] = $data['retire_from_service']===true ? 1 : 0;

        // Commisioned date
        if(!$this->isValidDate($data['commissioned_date'])){
            unSet($data['commissioned_date']);
        }
        

        // Set the client_id
        $data['client_id'] = $this->user->client_id;

        return $data;
    }

    protected function isValidDate($date) 
    {
        // check length = 10 eg YYYY-MM-DD
        return strlen($date) == 10;
    }

    
    
    
}
