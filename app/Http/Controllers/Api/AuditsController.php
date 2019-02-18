<?php

namespace App\Http\Controllers\Api;

use App\Asset;
use App\Client;
use App\AssetType;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class AuditsController extends Controller
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

    public function index()
    {
        
        $cutoffDate = Carbon::now();
        $auditsdue = Asset::with('assettype:id,name')
                        ->whereNotNull('next_audit_due')
                        ->where('next_audit_due','<', $cutoffDate)
                        ->get();

        
        return ['items'=>$auditsdue];
    }

    

    
    
}
