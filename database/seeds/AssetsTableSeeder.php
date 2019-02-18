<?php

use App\Asset;
use App\Client;


use Illuminate\Database\Seeder;

class AssetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {     
        
        $slings = \DB::table('assman_slings')->get();

        foreach ($slings as $a) {

            $data = [];
           
            $data['asset_id'] = $a->barcode;
            $data['description'] = $a->description;
            $data['size'] = $a->size;
            $data['vendor'] = $a->vendor;
            $data['vendor_part_reference'] = $a->vendor_part_reference;



            $data['client_id']= 1;
            $data['site_id'] = $a->site_id;
            $data['department_id'] = $a->department_id;
            $data['cost_centre'] = $a->cost_centre;
            $data['asset_type_id'] = 3; // 1=hoist asset, 2 = restraint asset , 3 = Sling asset

            $data['commissioned_date']=substr($a->commissioned_date,0,4) !='0000'? $a->commissioned_date : null;

            $data['condition']=$a->condition > '' ? $a->condition : null;
            $data['retire_from_service']=$a->retire_from_service == 'yes' ? 1: 0;
            $data['retired_date']=$a->retired_date;
            $data['next_audit_due'] = $a->next_audit_due;


            $data['meta'] = [
                'wash_count'=>$a->wash_count,
                'last_washed_date'=>$a->last_washed_date,
                'quarantined' => $a->quarantined == 'yes' ? 1 : 0
                ];

            
            Asset::create($data);

        }

        // Restraints
        $restraints = \DB::table('assman_restraints')->get();

        foreach ($restraints as $a) {

            $data =[];
           
            $data['asset_id'] = $a->barcode;
            $data['description'] = $a->description;
            // $data['size'] = $a->size; // restraints table does not have a size field
            // $data['vendor'] = $a->vendor; // restraints did not have a vendor field
            $data['vendor_part_reference'] = $a->vendor_part_reference;



            $data['client_id']= 1;
            $data['site_id'] = 0; // Restraints have now site_id
            $data['department_id'] = 0; // Restraints have no department_id
            // $data['cost_centre'] = $a->cost_centre;
            $data['asset_type_id'] = 2; // 1=hoist asset, 2 = restraint asset , 3 = Sling asset

            $data['commissioned_date']=substr($a->commissioned_date,0,4) !='0000'? $a->commissioned_date : null;

            // $data['condition']= null; // Restraints did not have a condition field
            $data['retire_from_service']=$a->retire_from_service == 'yes' ? 1: 0;
            // $data['retired_date']=$a->retired_date;
            // $data['next_audit_due'] = $a->next_audit_due;

            $data['meta'] = [
                'date_out'=>$a->date_out,
                'comments'=>$a->comments,
                'current_location' => $a->current_location
                ];

            // Delete any asset with this barcode because it is being replaced with the restraint
            Asset::where('asset_id',$a->barcode)->delete();
            
            Asset::create($data);

        }



        // $clients = Client::all();

        // // for each client 
        // foreach($clients as $C)
        // {
        //     // foreach site
        //     foreach($C->sites as $S)
        //     {
        //         // forech department
        //         foreach($S->departments as $D)
        //         {
        //             for($n = 0; $n < 10; $n++)
        //             {
        //                 $sling = $slings->shift();
        //                 $data['barcode'] = $sling->barcode;
        //                 $data['description'] = $sling->description;
        //                 $data['vendor'] = $sling->vendor;
        //                 $data['vendor_part_reference'] = $sling->vendor_part_reference;



        //                 $data['client_id']= $C->id;
        //                 $data['site_id'] = $S->id;
        //                 $data['department_id'] = $D->id;
        //                 $data['cost_centre'] = $sling->cost_centre;
        //                 $data['asset_type_id'] = 2; // 1=basic asset, 2 = sling asset

        //                 $data['commissioned_date']=$sling->commissioned_date !='0000-01-01'? $sling->commissioned_date : null;

        //                 $data['condition']=$sling->condition > '' ? $sling->condition : null;
        //                 $data['retire_from_service']=$sling->retire_from_service == 'yes' ? 1: 0;
        //                 $data['retired_date']=$sling->retired_date;
        //                 $data['next_audit_due'] = $sling->next_audit_due;


        //                 $data['meta'] = ['wash_count'=>$sling->wash_count,'last_washed_date'=>$sling->last_washed_date,'last_washed_updated_at'=>$sling->last_washed_updated_at];

                       
        //                 Asset::create($data);
        //             }
                    
                    
        //         }
        //     }
        // }

        

        
    }
}
