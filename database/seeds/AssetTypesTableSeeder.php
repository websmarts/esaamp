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

        $formSchema =  [ 

            
                
            [
                'name'=> 'description',
                'input'=>'v-text-field',
                'label'=> 'Description',
                'rules'=>  'required|min:2|max:250'
                            
            ],
            [
                'name'=> 'vendor',
                'input'=>'v-text-field',
                'label'=> 'Vendor',
                
                            
            ],
            [
                'name'=> 'vendor_part_reference',
                'input'=>'v-text-field',
                'label'=> 'Vendor Part#',
                
                            
            ],
            [
                'name'=> 'size',
                'input'=>'v-text-field',
                'label'=> 'Size',
                
                            
            ],
            [
                'name'=> 'cost_price',
                'input'=>'v-text-field',
                'label'=> 'Cost price',
                
                            
            ],
            [
                'name'=> 'cost_centre',
                'input'=>'v-text-field',
                'label'=> 'Cost centre',
                
                
            ],
            [
                'name'=>'condition',
                'input' =>'v-select',
                'items' =>'condition_options',
                'label' =>'Condition'
            ],

            [
                'name'=> 'quarantined',
                'input'=>'v-switch',
                'label'=> 'Quarantined',   
                
            ],
            [
                'name'=> 'retire_from_service',
                'input'=>'v-switch',
                'label'=> 'Retire from service',   
                
            ],
            [
                'name'=> 'retired_date',
                'input'=>'v-date-picker',
                'landscape'=>false,
                'reactive'=>true,
                'label'=> 'Retired date',
                
                
            ],
            [
                'name'=> 'commissioned_date',
                'input'=>'v-date-picker',
                'landscape'=>false,
                'reactive'=>true,
                'label'=> 'Commissioned date',
                
                
            ]
             
            

        ];

        // Every asset type has the above dataschema
        // Individual asset types probably have a diffent metaSchema

        $metaSchema = [
            ['name'=>'wash_count','label'=>'Wash count','input'=>'v-text-field','validate'=>''],
            ['name'=>'last_wash_date','label'=>'Last wash date','input'=>'v-date-picker','validate'=>'']
        ];

        foreach($metaSchema as $s){
            array_push($formSchema,$s);
        }



        // Default auditSchema to be the same as the formSchema for now. It will change
        // of course because the audit form will use a different data set.
        $auditSchema = $formSchema;


        AssetType::create([
            'client_id'=>1 ,
            'name' => 'Sling', 
            'dataschema' => $formSchema, 
            'auditschema'=> $auditSchema // TODO need to update to real auditschema 
            ]);
    }
}
