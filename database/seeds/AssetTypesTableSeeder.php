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
                'items' =>'condition_options', // vue form will load select options from refData[condition_options]
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
                'name'=> 'commissioned_date',
                'input'=>'v-date-picker',
                'landscape'=>false,
                'reactive'=>true,
                'label'=> 'Commissioned date',
                
                
            ]
             
            

        ];

        // Default auditSchema to be the same as the formSchema for now. It will change
        // of course because the audit form will use a different data set.
        $auditSchema = [
            [
                'name'=> 'audit_date',
                'input'=>'v-date-picker',
                'landscape'=>false,
                'reactive'=>true,
                'label'=> 'Audit date',
            ],
            [
                'name'=> 'auditors',
                'input'=>'v-text-field',
                'label'=> 'Auditors',
                
                
            ],
            [
                'name'=> 'audit_notes',
                'input'=>'v-text-field',
                'label'=> 'Audit notes',
                
                
            ],
            [
                'name'=> 'next_action',
                'input'=>'v-text-field',
                'label'=> 'Next action',
                
                
            ],
            [
                'name'=>'condition',
                'input' =>'v-select',
                'items' =>'condition_options', // vue form will load select options from refData[condition_options]
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
                
            ]


        ];

        // Every asset type has the above dataschema

        // Base metaschema is empty
        $metaSchema =[];

        // Create basic asset type
        AssetType::create([
            'client_id'=>1 ,
            'name' => 'Basic', 
            'dataschema' => $formSchema, 
            'metaschema' => $metaSchema,
            'auditschema'=> $auditSchema // TODO need to update to real auditschema 
            ]);





        // Individual asset types probably have a diffent metaSchema

        // Create a Sling asset type

        // metaschema for sling type
        $metaSchema = [
            
            ['name'=>'last_washed_date','label'=>'Last wash date','input'=>'v-date-picker','validate'=>''],
            ['name'=>'wash_count','label'=>'Wash count','input'=>'v-text-field','validate'=>'']
        ];


        AssetType::create([
            'client_id'=>1 ,
            'name' => 'Sling', 
            'dataschema' => $formSchema, 
            'auditschema'=> $auditSchema,
            'metaschema' => $metaSchema
            ]);
    }
}
