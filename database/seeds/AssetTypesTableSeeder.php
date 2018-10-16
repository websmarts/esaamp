<?php
use App\AssetType;
use Illuminate\Database\Seeder;

class AssetTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AssetType::create([
            'client_id'=>1 ,
            'name' => 'Sling', 
            'dataschema' => json_encode(['name'=>['type'=>'textinput','validate'=>'required|min:5']]), 
            'auditschema'=> json_encode(['name'=>['type'=>'textinput','validate'=>'required|min:8']]), 
            ]);
    }
}
