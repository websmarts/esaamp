<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Asset;
use App\AssetType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuditController extends Controller
{
    protected $user;
    protected $request;

    public function __construct(Request $request)
    {
         //$this->user = auth('api')->user();
         
        $this->user = $request->user('api');
        $this->request = $request;    
        
    }

    public function getAssetByBarcode($barcode)
    {
        
        $asset = Asset::with('assettype')->where('barcode',$barcode)->first();  
       
        return ['asset'=>$asset->toArray()];
    }

    public function store( $barcode)
    {
            // Validate data
            $validatedData = $this->request->validate([
                'barcode' => 'required'
                ]);
            // Update data
            $data = $this->request->input();
            $asset = Asset::where('barcode',$barcode)->first();

            // get the audit data
            $input = $this->request->input();
            $data = $this->transform($input);

            $asset->update($data['assetdata']);
            $audit = $asset->audits()->create($data['auditdata']);
            $audit->update($data['auditdata']);
            
        
            return ['data'=>'success','record'=>$data];

    }

    private function transform($input)
    {

        $auditdata=[];
        $assetdata=[];
        $data = [];

        // Handle the switch inputs
        $auditdata['quarantined'] = $input['quarantined']===true ? 1 : 0;
        $auditdata['retire_from_service'] = $input['retire_from_service']===true ? 1 : 0;

        



        $auditdata['audit_date'] = $input['audit_date'];
        $auditdata['created_by'] = $this->user->id;
        $auditdata['audit_notes'] = $input['audit_notes'];
        $auditdata['next_action'] = $input['next_action'];
        $auditdata['condition'] = $input['condition'];


        // Asset data
        // Handle the switch inputs
        $assetdata['quarantined'] = $input['quarantined']===true ? 1 : 0;
        $assetdata['retire_from_service'] = $input['retire_from_service']===true ? 1 : 0;
        $assetdata['condition'] = $input['condition'];
        $assetdata['next_audit_due']=$input['next_audit_due'];

        if($assetdata['retire_from_service']){
            $assetdata['retired_date'] = gmdate('Y-m-d');
        }

        // Combine data
        $data['auditdata'] = $auditdata;
        $data['assetdata'] = $assetdata; 


        return $data;
    }

    
    
}
