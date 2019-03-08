<?php

namespace App\Http\Controllers\Api;


use App\Wash;
use App\Asset;
use App\Audit;
use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class ReportsController extends Controller
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


    public function index()
    {
        $data = [
            'auditsdue' => $this->auditsDue(),
            'auditsdone'=> $this->auditsDone(),
            'assetcount' =>$this->assetCount()

        ];
       
        
        
        return ['data'=>$data];
    }

    protected function auditsDue()
    {
        $now = Carbon::now();
        
        return Asset::where('client_id',$this->user->client_id)
                    ->whereNotNull('next_audit_due')
                    ->whereDate('next_audit_due', '<=', $now)
                    ->count();
    }

    protected function auditsDone()
    {
        // return Audit::where('client_id',$this->user->client_id)->count();

        $res = \DB::table('audits')
                    ->leftJoin('assets','audits.asset_id','=','assets.asset_id')
                    ->where('assets.client_id',$this->user->client_id)
                    ->count();
        return $res;
    }

    protected function assetCount()
    {
        return Asset::where('client_id',$this->user->client_id)->count();
    }
}
