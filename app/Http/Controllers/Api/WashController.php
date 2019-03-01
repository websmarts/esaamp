<?php

namespace App\Http\Controllers\Api;


use App\Wash;
use App\Asset;
use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WashController extends Controller
{
    protected $user;
    protected $request;

    public function __construct(Request $request)
    {
         //$this->user = auth('api')->user();
         
        $this->user = $request->user('api');
        $this->client = Client::find($this->user->client_id);
        $this->request = $request;    
        
    }


    public function washes($date)
    {
        $washes = Wash::where('client_id',$this->user->client_id)
                        ->whereDate('washdate','=', $date)
                        ->get();

        return ['records'=>$washes];
    }

    public function store()
    {
        $this->request->validate([ 
            'asset_id'=> 'required',
            'washdate' => 'required'
            ]
        );
        
        // Okay it is valid
        $asset = Asset::where('asset_id',$this->request->asset_id)->first();


        $data = [
            'asset_id' =>$asset->asset_id,
            'client_id' =>$asset->client_id,
            'washdate' =>$this->request->washdate,
            'washcount' =>$asset->meta['wash_count'] + 1,
            'condition' => $asset->condition
        ];

        $wash = Wash::create($data);

        

        $asset->update(['wash_count'=>$asset->meta['wash_count'] + 1]);
        

        return ['data'=>'success','record'=>$data];
    }
}
