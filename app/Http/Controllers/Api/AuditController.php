<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Asset;
use App\AssetType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Client;


class AuditController extends Controller
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

    public function getAssetByBarcode($barcode)
    {
        
        $asset = Asset::with('assettype')->where('barcode',$barcode)->first();  
       
        return ['asset'=>$asset->toArray()];
    }

    public function store( )
    {
            // Validate data
            $validatedData = $this->request->validate([
                'barcode' => 'required'
                ]);
            // Update data
            $data = $this->request->input();
            $asset = Asset::where('barcode',$this->request->barcode)->first();

            // get the audit data
            $data = $this->getData();

            $asset->update($data['assetdata']);
            
            $audit = $asset->audits()->create($data['auditdata']);
            $audit->update($data['auditdata']);
            
        
            return ['data'=>'success','record'=>$audit->refresh()];

    }

    private function getData()
    {

        $auditdata=[];
        $assetdata=[];
        $data = [];

        // Handle the switch inputs
        $auditdata['quarantined'] = $this->request->quarantined === true ? 1 : 0;
        $auditdata['retire_from_service'] = $this->request->retire_from_service === true ? 1 : 0;


        $auditdata['audit_date'] = $this->convertToUtcDate($this->request->audit_date);

        $auditdata['created_by'] = $this->user->id;
        $auditdata['auditors'] = $this->request->auditors;
        $auditdata['audit_notes'] = $this->request->audit_notes;
        $auditdata['next_action'] = $this->request->next_action;
        $auditdata['condition'] = $this->request->condition;


        // Asset data
        // Handle the switch inputs
        $assetdata['quarantined'] = $this->request->quarantined === true ? 1 : 0;
        $assetdata['retire_from_service'] = $this->request->retire_from_service === true ? 1 : 0;
        $assetdata['condition'] = $this->request->condition;
        $assetdata['next_audit_due'] = $this->request->next_audit_due;

        if($assetdata['retire_from_service']){
            $assetdata['retired_date'] = gmdate('Y-m-d');
        }

        // Combine data
        $data['auditdata'] = $auditdata;
        $data['assetdata'] = $assetdata; 


        return $data;
    }

    protected function convertToUtcDate($date)
    {
        
        $dt = \DateTime::createFromFormat('Y-m-d',$date,new \DateTimeZone($this->getTimezone())); 
        $dt->setTimeZone(new \DateTimeZone('UTC'));
        return $dt->format('Y-m-d');
    }


    protected function getTimezone()
    {
        return $this->client->timezone;
    }

    
    
}
