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
        $slings = Sling::select('barcode','description')->get();

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


                        $data['client_id']= $C->id;
                        $data['site_id'] = $S->id;
                        $data['department_id'] = $D->id;
                        $data['asset_type_id'] = 1; // sling

                        $data['jdata'] = json_encode(['a'=>'b']);

                        Asset::create($data);
                    }
                    
                    
                }
            }
        }

        

        
    }
}
