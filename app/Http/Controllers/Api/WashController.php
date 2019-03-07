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
        
        $this->middleware(function ($request, $next) {

            $this->user = $request->user('api');

            $this->client = Client::find($this->user->client_id);

            $this->request = $request;   

            return $next($request);
        });
             
        
    }


    public function washes($date)
    {
        
        $washes = $this->washlist($date);

        return ['records'=>$washes];
    }

    public function store()
    {

        
        $this->request->validate([ 
            'asset_id'=> 'required',
            'washdate' => 'required'
            ]
        );
        
        // Okay it is a valid request
        $asset = Asset::where('asset_id',$this->request->asset_id)->first();


        $data = [
            'asset_id' =>$asset->asset_id,
            'client_id' =>$asset->client_id,
            'washdate' =>$this->request->washdate,
            'washcount' =>$asset->meta['wash_count'] + 1,
            'condition' => $asset->condition,
            'quarantined' => $asset->quarantined
        ];

        // If wash exists for today then return
        if($this->isWashRecorded($data['asset_id'],$data['washdate'])){
            return ['data'=>'duplicate record','record'=>$data];
        }

        

        $wash = Wash::create($data);// new wash record

        $asset->update(['wash_count'=>$asset->meta['wash_count'] + 1]); // increment asset.washcount



        return ['data'=>'success','records'=>$this->washlist($data['washdate'])];
    }

    protected function isWashRecorded($assetId,$date){

        return  Wash::where('client_id',$this->user->client_id)
                    ->where('asset_id',$assetId)
                    ->whereDate('washdate','=', $date)
                    ->first();

    }

    protected function washlist($date)
    {


        return \DB::table('washes')
           ->join('assets', 'washes.asset_id', '=', 'assets.asset_id')
           ->where('washes.client_id','=',$this->user->client_id)
           ->whereDate('washdate','=', $date)
           ->select('washes.*', 'assets.description as description')
           ->get();

    }
}
