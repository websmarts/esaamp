<?php
use App\Site;
use Illuminate\Database\Seeder;

class SitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sites = ['Site 1','Site 2','Site 3'];
        $clients = [1,2,3];
        foreach($clients as $clientId){
            foreach($sites as $site){
                Site::create([
                    'client_id'=> $clientId,
                    'name'=>$site
                ]);
            }
        }
        
        
        

    }
}
