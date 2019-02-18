<?php

namespace App\Http\Controllers;

use App\Asset;


use App\Client;
use App\AssetType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $user;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');


    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  

        $user = auth()->user();
        $clientdata = $this->clientdata();
        $refdata = $this->referenceData();
        $assetids = $this->getAssetIds();


        // $cutoffDate = Carbon::now();
        // $auditsdue = Asset::with('assettype:id,name')
        //                 ->select('asset_id','asset_type_id','next_audit_due')
        //                 ->whereNotNull('next_audit_due')
        //                 ->where('next_audit_due','<', $cutoffDate)
        //                 ->limit(10)->get();

        // dd($auditsdue);


        return view('home',compact('clientdata','refdata','assetids','user'));
    }

    protected function clientdata()
    {
        
        return Client::where('id',auth()->user()->client_id)->with('sites.departments')->first();
    }

    protected function referenceData()
    {
        
        $refdata = [];

        $refdata['condition_options'] = $this->getConditionOptions();
        $refdata['asset_types'] = $this->getAssetTypes();
        $refdata['user'] = auth()->user();
        
        
        return $refdata;
        
    }

    protected function getConditionOptions()
    {
        // Asset condition field enum options
        $options = \DB::select(\DB::raw('SHOW COLUMNS FROM assets WHERE Field = "condition"'))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $options, $matches);
        $conditionOptions = array();
        foreach(explode(',', $matches[1]) as $value){
            $conditionOptions[] = trim($value, "'");
        }

        return $conditionOptions;
    }
    
    protected function getAssetTypes()
    {
        $col =  AssetType::where('client_id',auth()->user()->client_id)->get();

        return $col->keyBy('id')->toArray();
    }

    protected function getAssetIds()
    {
        $assetIds = Asset::select('asset_id')
                    ->where('client_id',auth()->user()->client_id)
                    ->get()
                    ->pluck('asset_id')
                    ->all();

        return $assetIds;
    }
}
