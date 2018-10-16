<?php
use App\Department;
use App\Site;
use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments =['ICU','Physio','2 West','AC','2F'];
        $clients = [1,2,3];

        $sites = Site::all();

        foreach($sites as $site)  {
            foreach($departments as $department){
                Department::create([
                    
                    'site_id' => $site->id,
                    'name' => $department
                ]);
            }

        }

        
    }
}
