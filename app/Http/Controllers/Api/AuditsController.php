<?php

namespace App\Http\Controllers\Api;

use App\Asset;
use App\Audit;
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

        
        $assets = Asset::where('assets.client_id',$this->user->client_id)
                        ->whereNotNull('next_audit_due')
                        ->where('retire_from_service',0)
                        ->whereDate('next_audit_due','<', $cutoffDate)
                        ->leftJoin('asset_types','assets.asset_type_id','=','asset_types.id')
                        ->leftJoin('sites','assets.site_id','=','sites.id')
                        ->leftJoin('departments','assets.department_id','=','departments.id')
                        ->get([
                            'asset_types.name as type',
                            'sites.name as site',
                            'departments.name as department',
                            'assets.*']);

        foreach($assets as $asset) {
            $lastAudit = Audit::where('asset_id',$asset->id)->latest()->first();
            if($lastAudit){
                $asset->last_audit_date = $lastAudit->created_at->toFormattedDateString();
            }
            
        }

        

        
        return ['items'=>$assets];
    }

    

    
    
}