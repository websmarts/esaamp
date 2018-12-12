<template>  
    <div>

        <v-form ref="auditform">
            <v-container>
            <v-layout row wrap>
                
                
                

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

                    <template v-if="groupC(s)">
                        
                        <v-flex xs12>   
                            <component 
                                :is="s.input" 
                                :label="s.label"
                                :rules="s.rules"
                                :readonly="s.readonly"
                                v-model="formdata[s.name]"
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
        
    </div>

</template>

<script>

const formValidator = require('./lib/validatorClass') ;


export default {
    props: ['asset'],
    data() {
        return {
            
            valid: true,
            
            dateMenus: { // flags for datepicker popups
                audit_date: false,
            },
            
            
            formdata: {},
            

            formschema: [],
            
            showSuccessAlertFlag: false,
            successAlertMessage: ''        
        }
    },
    computed: {
        
    },
    methods: {
        formatDate (date) {
            if (!date) return null

            const [year, month, day] = date.split('-')
            return `${day}-${month}-${year}`
        },
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
            this.formdata[field]=e
        },
        
        submit () {
            if (this.$refs.auditform.validate()) {

            let self=this

            axios.post('/api/audit', self.formdata)
            .then(function (response) {
                // handle success
                // console.log(response.data);
                 self.successAlertMessage = 'Success ... audit record saved'
                 self.showSuccessAlertFlag = true

                 // push the new audit onto the audits stack
                 // should emit an event so parent can update the record TODO
                 self.$emit('created',response.data.record)
                // this.asset.audits.push(response.data.record)
                
                
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
            
            this.formdata = Object.assign({}, {}, {})
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

            let assetdata = {}
           

            
            let extractKeys = ['barcode','condition','quarantined','retire_from_service']
            _.each(extractKeys, function(key){
                 assetdata[key] =  _.clone(self.asset[key])
            })

            // console.log('cleaned clone',assetdata)

            // retrieve and remove assettype data from asset
            let assettype = this.asset.assettype
            
            
            // Set schema to assets auditschema
            let schema = assettype.auditschema 
            let datakeys = _.map(schema,'name')

            // add datakeys that are NOT already in assetdata
            _.each(datakeys, function(key){
                if(!assetdata.hasOwnProperty(key)){     
                    assetdata[key] = null       
                }
            })

            
            //  set the dafault value for audit date 
            let now = new Date()
            let today = now.toISOString().substring(0,10) // YYYY-mm-dd
           

            assetdata.audit_date = today

            // Set the logged in user as one of the  Auditors
            assetdata['auditors'] = $Refdata.user.name

            // console.log('ASSETDATA',assetdata)

            self.formdata = Object.assign({},assetdata)
            
            // Setup the formschema with the laravel rules converted to local rules
            const validator = new formValidator(self.formdata,schema)
            self.formschema =  validator.schema_with_rules        

        }
    },
    watch: {
        'asset' (to, from) {
        // react to route changes...

        // Ajax load latest data from server for asset ....
        // console.log('audit asset updated to: ',to)
        // this.formdata.description = 'my description for ' + this.barcode;
        // this.formdata.notes = 'my notes for barcode ' + this.barcode;
        this.load()

        

        }
    },
    mounted() {
        // console.log('Asset Audit Mounted - Audit asset',this.asset)
        //this.load()
    }
}

</script>