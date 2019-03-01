<template>

    <v-app id="inspire">
    
        
        <v-toolbar color="grey darken-2" height="85" dark fixed app>
        
            <v-toolbar-title>
                <img src="images/saamlogo-with-checkbox.png" height="45" /><br />
                <span style="font-size:13px">Safety Audit &amp; Asset Management</span>
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-title class="title" >{{ clientname }}</v-toolbar-title>
            <v-spacer></v-spacer>

            <v-toolbar-items>
                <v-btn  flat><a href="/logout" style="color:white;text-decoration: none">Logout<br /><small>{{ user.name }}</small></a></v-btn>
            </v-toolbar-items>
            
        </v-toolbar>




        <v-content style="padding-top:64px">
            <v-toolbar tile dark flat  color="grey lighten-1" height="84">
                    
                <v-layout row align-center justify-center >
                    <v-flex xs12 sm11 md7>

                   Washer  Toolbar
                            
                    </v-flex>
                </v-layout>

            </v-toolbar>
        
            <v-container>
            
                <v-layout row justify-space-around wrap>
                    <v-flex xs12 sm5 md4>        
                                
                        <v-menu
                            :ref="washdate"
                            :close-on-content-click="false"
                            v-model="datemenu"
                            :nudge-right="80"
                            transition="scale-transition"
                            offset-y
                            full-width
                            min-width="290px"
                        >
                            <v-text-field
                            slot="activator"
                            v-model ="washdate"
                            label="Wash date"
                            
                            append-icon="event"
                            readonly
                            ></v-text-field>

                            <v-date-picker 
                            v-model="washdate" 
                            :reactive="reactive"
                            :landscape="landscape"
                            label="DATE LABEL"
                            
                            
                
                            xno-title
                            light
                            scrollable>  
                            </v-date-picker>
                        </v-menu>
                    </v-flex>

                    <v-flex xs12 sm6 md4>        
                                
                        
                            <v-text-field
                            
                            :value ="assetId"
                            @input ="assetIdInput"
                            @change="assetIdChange"
                            label="Asset Id"
                            
                            
                            ></v-text-field>

                    </v-flex>

                    <v-flex xs12 text-xs-center>Feedback message area</v-flex>

                </v-layout>
                
                <v-layout row justify-space-around wrap>
                    
                    <v-flex xs12 sm6 md5>  
                        <p class="title">Wash list</p>

                        <v-data-table
                            :headers="headers"
                            :items="records"
                            class="elevation-1"
                        >
                            <template slot="items" slot-scope="props">
                            <td>{{ props.item.asset_id }}</td>
                            <td class="text-xs-right">{{ props.item.description }}</td>
                            <td class="text-xs-right">{{ props.item.washcount }}</td>
                            <td class="text-xs-right">{{ props.item.condition }}</td>
                            </template>
                        </v-data-table>

                    </v-flex>

                </v-layout>



                    
              
            </v-container>
        </v-content>

        <v-footer color="primary" app>
        <span class="white--text">&copy; 2018</span>
        </v-footer>
    </v-app>
</template>

<script>
export default {
    data() {
        return {
            clientname: $Clientdata['name'],
            user: $User,
            landscape: true,
            reactive: true,
            datemenu: false,
            washdate: moment().format('YYYY-MM-DD'),
            assetId: null,
            
            // Data table 
            headers: [
                        { text: 'Asset Id', value: 'asset_id' },
                        { text: 'Description', value: 'description' },
                        {
                            text: 'Wash count',
                            align: 'left',
                            sortable: false,
                            value: 'washcount'
                        },
                        { text: 'Condition', value: 'condition' },
                        
        
                    ],
            records: [],
            
        }
    },
    methods: {
        assetIdInput(val){
            this.assetId = val
        },
        assetIdChange(val){
            this.save()
        },
        save() {

            // check asset Id is valid

            if(!$AssetIds.includes(this.assetId)){
                console.log('Invalid assetId entered')
                return
            }

            // Okay it is a valid assetId
            const path = '/api/washes';
            const data = {
                asset_id: this.assetId,
                washdate: this.washdate,
            }

            this.$api.post(path, data, (status,data) => {

                    console.log('WASH DATA SAVED')

                    // Update records with new one returnd
                    

                }).catch( (err)=> {
                   
                    
                    
                }).then(function () {
                    // always executed
                    // self.saving = false
                })

        },
        load() {

            const path = '/api/washes/' + this.washdate

            this.$api.get(path, (status,data) => {

                    this.records = data.records

                }).catch( (err)=> {
                   
                    
                        console.log('Error in washapp.vue load function',err)
                    
                    
                }).then(function () {
                    // always executed
                    // self.saving = false
                })
           
        }
    },
    mounted () {
        this.load()
    },
    watch: {
        'washdate' (to) {
            console.log('Washdate changed to:',this.washdate)
            this.load()
        }
    }
   
}

</script>