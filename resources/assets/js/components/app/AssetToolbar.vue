<template>

      <v-card dark flat  color="grey" >
          <v-layout row align-center>
                <v-flex xs3 style="text-align:left;"><v-btn color="blue darken-2" @click="reports" style=" height:80px">
                    Dashboard<v-icon dark right v-show="btn_selected.reports">check_circle</v-icon>
                    </v-btn>
                </v-flex>

                 
                <v-flex xs9>
                    <v-card dark flat  color="grey darken-2" > 
                        <v-layout row align-center>
                            <v-flex style="padding-left:30px">
                                <span style="color: #ddd; font-size:120%"> Asset &nbsp;</span>
                            </v-flex> 
                        </v-layout>
                        <v-layout row align-center style="padding-bottom:10px">
                            
                            <v-flex xs4 style="padding-left:30px">
                                    
                                    <v-autocomplete
                                        :loading="loading"
                                        :items="assetIds"
                                        
                                        v-model="assetId"
                                        @change="assetSelected"
                                        clearable
                                        cache-items
                                        light
                                        flat
                                        hide-details
                                        label="Enter Asset ID..."
                                        solo
                                    ></v-autocomplete>
                            </v-flex>
                            <v-flex ><v-btn :disabled="!assetId" color="blue darken-2" @click="view">
                                Select<v-icon dark right v-show="btn_selected.view">check_circle</v-icon>
                                </v-btn></v-flex>

                            <v-flex >
                                <v-menu offset-y>
                                <v-btn slot="activator"  color="blue darken-2">
                                    Add<v-icon dark right v-show="btn_selected.add">check_circle</v-icon>
                                    </v-btn>

                                    <v-list>
                                        <v-list-tile
                                        v-for="(item, index) in assetTypes"
                                        :key="index"
                                        @click="add(item.id)"
                                        >
                                        <v-list-tile-title>{{ item.name }}</v-list-tile-title>
                                        </v-list-tile>
                                    </v-list>

                                </v-menu>
                            </v-flex>
                        </v-layout>
                    </v-card>
                </v-flex>


                
          </v-layout>
        </v-card>
                        

                    


</template>

<script>

import { EventBus } from './lib/eventbus.js';
EventBus.$on('newAssetId', newAssetId => {
  console.log(`Toolbar says - Oh, that's nice we have a new asset  ${newAssetId}! :)`)
  $AssetIds.push(newAssetId)
});

import store from './lib/store.js';

export default {
    props: ['currentroute'],
    data() {

        return {
            store: store,
            assetId: this.$route.params.assetid,
            assetIds: $AssetIds,
            
            loading: false,
            isEditing: false,
            // goBtnDisabled: true,

            
            assetTypes: $Refdata.asset_types,

            btn_selected: {
                view: false,
                add: false,
                reports: false
            },
            
            
        }
    },
    computed: {
        xhr_loading() {
            return this.store.isActive()
        }
    },
    methods: {
        assetSelected(e) {
            //this.goBtnDisabled = false
         this.view();
        },
        view() {
            if(typeof(this.assetId) != "undefined") {
                this.$router.push('/view/'+this.assetId);
            }
            
            //this.updateButtonSelectIndicators('select')
            
        },
        add(assetTypeId) {
            this.$router.push('/add/'+ assetTypeId);
            //this.updateButtonSelectIndicators('add')
        },
        reports() {
            this.$router.push('/reports');
            //this.updateButtonSelectIndicators('reports')
        },
        updateButtons(btn){
            let self = this
            Object.keys(this.btn_selected).forEach(function(key,index) {
                self.btn_selected[key] = key == btn ? true : false
            })
        }
        
        

    },
    watch: {
        'currentroute' (to, from) {
            this.updateButtons(to)
        }
    },
    
 
    

}


</script>