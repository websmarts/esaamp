<template>  
    <div>
        <div>Asset audit form
            <v-form ref="auditform">
                <v-container>
                <v-layout row wrap>
                   
                    
                   

                    <v-flex  v-for="s in schema" :key="s.name" xs12 >

                        <template v-if="groupA(s)">
                            <v-flex xs12>   
                                <component 
                                    
                                    :is="s.input" 
                                    :label="s.label"
                                    :rules="s.rules"
                                    :readonly="s.readonly"
                                    :value="data[s.name]"
                                    :items="getOptions(s.items)"
                                    @change="changed($event,s.name)"
                                    light
                                ></component>
                            </v-flex>
                        </template>

                        <template v-if="groupB(s)">
                            <v-layout row wrap align-left>
                            <v-flex xs2 >{{s.label}}</v-flex>
                            <v-flex xs10>  
                                <component 
                                    v-model="data[s.name]"
                                    :is="s.input" 
                                    :label="s.label"
                                    :rules="s.rules"
                                    :readonly="s.readonly"
                                    :value="data[s.name]"
                                    :reactive="s.reactive"
                                    :landscape="s.landscape"
                                    color="green"
                                    light
                                ></component>
                            </v-flex>
                            </v-layout>
                        </template>

                        <template v-if="groupC(s)">
                            <v-flex xs12>   
                                <component 
                                    v-model="data[s.name]"
                                    :is="s.input" 
                                    :label="s.label"
                                    :rules="s.rules"
                                    :readonly="s.readonly"
                                    :value="data[s.name]"
                                    :items="getOptions(s.items)"
                                    @change="changed($event,s.name)"
                                    light
                                ></component>
                            </v-flex>
                        </template>

                    </v-flex>

                    <v-btn
                        :disabled="!valid"
                        @click="submit"
                        >
                        submit
                    </v-btn>
                    <v-btn @click="clear">clear</v-btn>
                    <v-btn @click="load">reset</v-btn>

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
        </div>
        <div>Asset Audit History</div>

        
    </div>

</template>

<script>

const myValidator = require('../../myValidatorClass') ;


export default {
    props: ['asset'],
    data() {
        return {
            
            valid: true,
            
            
            data: {},
            

            schema: [],
            
            showSuccessAlertFlag: false,
            successAlertMessage: ''        
        }
    },
    computed: {
        
    },
    methods: {
        groupA(s) {
            // return true if input is one of the following
            
            const options = ['v-text-field','v-select']
            return options.indexOf(s.input) > -1
           
        },
        groupB(s) {
            
            const options = ['v-date-picker']
            return options.indexOf(s.input) > -1

        },
        groupC(s) {
            const options = ['v-switch']
            return options.indexOf(s.input) > -1
        },
        getOptions(key){
            // console.log('Refdata Options Key',key)

            // Could update to check if key is a string of options and if it is then return
            // them as an array

            // But for now we assume key is a key into the global refdata array
            if($Refdata.hasOwnProperty(key)){
                return $Refdata[key]
            }

        },
        changed(e,field) {
            // console.log('changed',e,field)
            this.data[field]=e
        },
        
        submit () {
            if (this.$refs.auditform.validate()) {
            // Native form submission is not yet supported
            // console.log('Form is valid and I am submitting it now with this data',this.data)

            const data = this.data
            

            let self=this

            axios.post('/api/audit/'+ this.asset.barcode, this.data)
            .then(function (response) {
                // handle success
                // console.log(response.data);
                 self.successAlertMessage = 'Record update successful'
                 self.showSuccessAlertFlag = true
                
                
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            .then(function () {
                // always executed
            });
            }
        },

        clear () {
            
            this.data = Object.assign({}, {}, {})
            this.$refs.auditform.reset()
            // this.$nextTick( function() {
            //     this.$refs.form.reset()
            // })
            this.showSuccessAlertFlag = false
            this.successAlertMessage=''
        },
        
        load () {
            let self = this
            
            this.clear()

            let barcode = this.asset.barcode

            console.log('Audit barcode',barcode)

            axios.get('/api/audit/'+ barcode)
            .then(function (response) {
                // handle success
                // console.log(response.data);

                let asset = response.data.asset

                // retrieve and remove assettype data from asset
                let assettype = asset.assettype
                delete asset.assettype

                // retrieve and remove metadata from asset
                let metadata = asset.meta
                delete asset.meta

                
                // Combine the core schema with any metaschema
                let schema = assettype.auditschema // .concat(assettype.metaschema)
            
                
                // Setup formdata object by combining the core asset data Obj and the asset meta data Obj
                self.data = Object.assign({},asset,metadata)
                
                // Setup the formschema with the laravel rules converted to local rules
                const validator = new myValidator(self.data,schema)
                self.schema =  validator.schema_with_rules
                
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            .then(function () {
                // always executed
            });

        }
    },
    watch: {
        'asset' (to, from) {
        // react to route changes...

        // Ajax load latest data from server for asset ....
        console.log('audit asset updated to: ',to)
        // this.formdata.description = 'my description for ' + this.barcode;
        // this.formdata.notes = 'my notes for barcode ' + this.barcode;
        this.load()

        

        }
    },
    mounted() {
        console.log('Asset Audit Mounted - Audit asset',this.asset)
        //this.load()
    }
}

</script>