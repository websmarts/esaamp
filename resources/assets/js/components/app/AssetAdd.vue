<template>
   <v-layout justify-center row wrap> 
       <v-flex  xs12 sm10 md8 lg6>
           <div class="display-1">Add ({{ assettype.name }}) Asset</div>
 
        <v-form ref="add_asset_form" v-model="valid" :lazy-validation="false">
            <v-container>
                <v-layout row wrap>
                   
                   
                    <v-flex  xs12>
                        <v-text-field label="Barcode" v-model="formdata.barcode" :rules="barcodeRules"></v-text-field>
                    </v-flex>
                    <v-flex xs12>
                        <v-select
                            v-model="formdata.site_id"
                            :items="sites"
                            :rules="siteRules"
                            item-text="name"
                            item-value="id"
                            label="Site"
                            @change="siteChange"
                        ></v-select>
                    </v-flex>

                    <v-flex xs12>

                        <v-select
                            v-model="formdata.department_id"
                            :items="siteDepartments"
                            :rules="departmentRules"
                            item-text="name"
                            item-value="id"
                            label="Department"
                        ></v-select>
                    </v-flex>

                   

                    <v-flex  v-for="s in formschema" :key="s.name" xs12 >

                        <template v-if="groupA(s)">
                            <v-flex xs12>   
                                <component 
                                    
                                    :is="s.input" 
                                    :label="s.label"
                                    :rules="s.rules"
                                    :readonly="s.readonly"
                                    :value="formdata[s.name]"
                                    :items="getOptions(s.items)"
                                    @change="changed($event,s.name)"
                                    light
                                ></component>
                            </v-flex>
                        </template>

                        <template v-if="groupB(s)">
                            <v-flex xs12 sm6 md4>
                                
                            <v-menu
                                :ref="s.name"
                                :close-on-content-click="false"
                                v-model="dateMenus[s.name]"
                                :nudge-right="80"
                                
                                xlazy
                                transition="scale-transition"
                                offset-y
                                full-width
                                min-width="290px"
                            >
                                <v-text-field
                                slot="activator"
                                :value="formatDate(formdata[s.name])"

                                :label="s.label"
                                :rules = "s.rules"
                                
                                append-icon="event"
                                readonly
                                ></v-text-field>

                                <v-date-picker 
                                v-model="formdata[s.name]" 
                                :label="s.label"
                                :rules="s.rules"
                                :readonly="s.readonly"
                                :items="getOptions(s.items)"
                               
                                no-title
                                light
                                scrollable>
                                
                                </v-date-picker>
                            </v-menu>
                            </v-flex>
                        </template>

                        <template v-if="groupC(s)"><!-- switches -->
                            <v-flex xs12>   
                                <component 
                                    v-model="formdata[s.name]"
                                    :is="s.input" 
                                    :label="s.label"
                                    :rules="s.rules"
                                    :readonly="s.readonly"
                                    :items="getOptions(s.items)"
                                    @change="changed($event,s.name)"
                                    light
                                ></component>
                            </v-flex>
                        </template>

                    </v-flex>
                   

                    <v-btn
                        :disabled="!valid"
                        :loading="saving"
                        @click="submit"
                        >
                        submit
                    </v-btn>
                    <!-- <v-btn @click="clear">clear</v-btn>
                    <v-btn @click="load">reset</v-btn> -->

                    <v-flex xs12>
                             <v-alert
                            :value="showSuccessAlertFlag"
                            dismissible
                            type="success"
                            >
                            {{ successAlertMessage }}
                            </v-alert>

                    </v-flex>
                </v-layout>
            </v-container>
        </v-form>
        
    </v-flex>
</v-layout>
</template>

<script>
import { EventBus } from './lib/eventbus.js';

const formValidator = require('./lib/validatorClass') ;
import assetforms from './mixins/assetforms.js';

export default {
    mixins: [assetforms],
    data() {
        return {
            
            assetTypeId: parseInt(this.$route.params.assettype),
            barcodes: $Barcodes,

            barcodeRules: [this.barcodeRuleset],

            
        }
    },
    computed: {
        siteDepartments(){
            if (this.formdata.site_id){
                const site = _.find($Clientdata.sites,['id',this.formdata.site_id])
                // console.log('Returning site departments for site_id',this.data.site_id)
                return site.departments
            }
            return []
        },
        conditionOptions() {
            return $Refdata.condition_options
        },
        myRefData() {
            return $Refdata
        },
       
        assettype() {
            return _.find($Refdata['asset_types'],['id',this.assetTypeId])
        }
    },
    methods: {
        barcodeRuleset(v){

            
            if(!v) {
                return 'Barcode is required'
            }


            // is unique
            if(this.barcodes.includes(v)){
                return 'This barcode is already in use, '
            }
            
            return true
        },
        submit () {
            if (this.$refs.add_asset_form.validate()) {
            // Native form submission is not yet supported
            // console.log('Form is valid and I am submitting it now with this data',this.data)

            const data = this.formdata

            const newBarcode = data.barcode

            data['asset_type_id'] = this.assetTypeId
            data['client_id'] = $Clientdata.id
            
            let self=this

            self.saving = true

            axios.post('/api/asset', data)
            .then(function (response) {
                // handle success
                // console.log(response.data);
                 self.successAlertMessage = 'Record update successful'
                 self.showSuccessAlertFlag = true

                 // emit event to update the list of barcodes
                 EventBus.$emit('new_barcode',newBarcode)
                
                
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            .then(function () {
                // always executed
                self.saving = false
            });
            }
        },

        clear () {
            
            this.formdata = Object.assign({}, {}, {})
            this.$refs.form.reset()
            // this.$nextTick( function() {
            //     this.$refs.form.reset()
            // })
            this.showSuccessAlertFlag = false
            this.successAlertMessage=''
        },
        load () {
            
            this.assetType = _.find($Refdata.asset_types,['id',this.assetTypeId])

            // Remove some unwanted data so it does not become part of the formdata
        
            
            
            // Combine the core schema with any metaschema
            let schema = this.assetType.dataschema.concat(this.assetType.metaschema)

            // set the datepicker menus data property
            // find all datapicker.names
            // console.log('SCHEMA',schema)
            let datepickers = _.filter(schema,{'input': 'v-date-picker'})
            // console.log('DatePickers',datepickers)
            let dateMenus ={}
            _.each(datepickers, function(p){
                dateMenus[p.name]=false
            })
            // console.log('MENUS',menus)
            self.dateMenus = Object.assign({},dateMenus)

            let datakeys = _.map(schema,'name')
            let formdata = {}

            // add datakeys that are NOT already in assetdata
            _.each(datakeys, function(key){
                    
                    formdata[key] = ''       
                
            })
            
            
            // Setup formdata object by combining the core asset data Obj and the asset meta data Obj
            this.formdata = Object.assign({},formdata)
            
            // Setup the formschema with the laravel rules converted to local rules
            this.rawSchema = schema
            const validator = new formValidator(self.formdata,schema)
            this.formschema =  validator.schema_with_rules
            

        }
    },
    mounted() {
    
        this.load()
    },
    watch: {
    '$route' (to, from) {
      // react to route changes...
      // console.log('re-routed to: ',to.params.barcode)
      this.assetTypeId = parseInt(to.params.assettype)
      this.load()
    }
  }
}

</script>