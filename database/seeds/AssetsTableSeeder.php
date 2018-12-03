<?php
use App\Sling;
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
        $slings = Sling::get();

        $clients = Client::all();

        // for each client 
        foreach($clients as $C)
        {
            // foreach site
            foreach($C->sites as $S)
            {
                // forech department
                foreach($S->departments as $D)
                {
                    for($n = 0; $n < 10; $n++)
                    {
                        $sling = $slings->shift();
                        $data['barcode'] = $sling->barcode;
                        $data['description'] = $sling->description;
                        $data['vendor'] = $sling->vendor;
                        $data['vendor_part_reference'] = $sling->vendor_part_reference;



                        $data['client_id']= $C->id;
                        $data['site_id'] = $S->id;
                        $data['department_id'] = $D->id;
                        $data['cost_centre'] = $sling->cost_centre;
                        $data['asset_type_id'] = 2; // 1=basic asset, 2 = sling asset

                        $data['commissioned_date']=$sling->commissioned_date !='0000-01-01'? $sling->commissioned_date : null;

                        $data['condition']=$sling->condition > '' ? $sling->condition : null;
                        $data['retire_from_service']=$sling->retire_from_service == 'yes' ? 1: 0;
                        $data['retired_date']=$sling->retired_date;
                        $data['next_audit_due'] = $sling->next_audit_due;


                        $data['meta'] = ['wash_count'=>$sling->wash_count,'last_washed_date'=>$sling->last_washed_date,'last_washed_updated_at'=>$sling->last_washed_updated_at];

                       
                        Asset::create($data);
                    }
                    
                    
                }
            }
        }

        

        
    }
}
