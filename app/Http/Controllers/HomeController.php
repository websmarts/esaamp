<?php

namespace App\Http\Controllers;

use App\Client;


use Illuminate\Http\Request;
use App\AssetType;
use Illuminate\Support\Facades\Auth;
use App\Asset;

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
        // $this->user = $request->user();

        // dd($this->user->hasRole('user'));

        // Display the correct app for the user role
        // Role options - manager, washer

        $role = 'manager'; // default

        if (auth()->user()->hasRole('washer')) {
            $role = 'washer';
        }
        



        $clientdata = $this->clientdata();
        $refdata = $this->referenceData();
        $barcodes = $this->getBarcodes();


        return view('home',compact('clientdata','refdata','barcodes','role'));
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

    protected function getBarcodes()
    {
        $barcodes = Asset::select('barcode')
                    ->where('client_id',auth()->user()->client_id)
                    ->get()
                    ->pluck('barcode')
                    ->all();

        return $barcodes;
    }
}
