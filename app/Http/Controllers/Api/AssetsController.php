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
        
        return Asset::where('client_id',$clientId)->select('asset_id')->get()->pluck('asset_id');
    }

    public function getAssetByAssetId($assetid)
    {
        
        $asset = Asset::with(['audits','assettype'])->where('asset_id',$assetid)->first();  

       //dd($asset);

        return ['asset'=>$asset->toArray()];
    }

    public function store(Request $request)
    {
        // Validate data
        $validatedData = $this->request->validate([
            'client_id'=> 'required',
            'asset_id' => 'required',
            'site_id' => 'required',
            'department_id' => 'required',
            'asset_type_id' => 'required'
            ]);

        
        

        $data = $this->getData($this->request->input());
        //dd($data);

        

        $data['client_id'] = $this->user->client_id; // force assets client_id to be users client_id

        // Validate against the assetype rules
        $assettype = AssetType::find($request->input('asset_type_id'));
        $rules = $assettype->validationRules();
        $validatedData = $this->request->validate($rules);

        $asset = Asset::create($data);

        return ['data'=>'success','record'=>$data];

    }

    public function update( $assetid)
    {
            
        
            // Pre Validate data - the rules for asset_id, site_id and department_id are not in the assettype rules
            $validatedData = $this->request->validate([
                'asset_id' => 'required',
                'site_id'=> 'required',
                'department_id' => 'required'
                ]);

            

            
            $asset = Asset::where('asset_id',$assetid)->first();


            // Validate against the assetype rules
            $rules = $asset->assettype->validationRules();
            $validatedData = $this->request->validate($rules);



            $data = $this->getData($this->request->input());

            $asset->update($data);

            //sleep(2);
            
            return ['data'=>'success','record'=>$data];

    }

    

    private function getData($data)
    {

        // Remove the ID if it exists
        unSet($data['id']);

        // Note Meta data handled by Asset model

        // Handle the switch inputs
        $data['quarantined'] = isSet($data['quarantined']) ? ($data['quarantined']===true ? 1 : 0) : 0;
        $data['retire_from_service'] = isSet($data['retire_from_service']) ? ($data['retire_from_service']===true ? 1 : 0) : 0;

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
        // check length = 10 eg YYYY-MM-DD and YYYY does not start wth a zero
        return strlen($date) == 10 && substr($date,0,1 != "0");
    }

    
    
    
}
