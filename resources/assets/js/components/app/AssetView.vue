<template>
<v-layout justify-center>
    
    <v-flex xs12 sm11 md7>
        <v-tabs
            v-model="active"
            color="green lighten-2"
            light
            slider-color="grey darken-2"
            >
            <v-flex xs2 class="grey darken-2" style="text-align: right;font-size:120%;color:#fff; padding:5px" >Asset ID</v-flex>
            <v-flex  class="grey darken-2" style="font-size:120%;color:#fff; padding:5px" >{{barcode}}</v-flex>
            <v-tab  
                :key="edit"
                ripple
            >
                Edit
            </v-tab>
            <v-tab  
                :key="audit"
                ripple
            >
                Audit
            </v-tab>
            <v-tab-item  
                :key="edit"
            >
                <v-card flat>
                    
                        <v-card-text>
                            <div class="display-1">View/Edit {{ assettypeName }} Asset</div>
                            <asset-edit-form :asset="asset"></asset-edit-form>
                        </v-card-text>
                    
                </v-card>
                        
            </v-tab-item>

            <v-tab-item  
                :key="audit"
            >
                <v-card flat>
                <v-card-text>
                    <div class="display-1">Audit Asset</div>
                    <asset-audit :asset="asset"  @created="addAudit"></asset-audit>
                    <div>Asset Audit History</div>
                    <audit-history :audits="asset.audits"></audit-history>
                </v-card-text>
                </v-card>
            </v-tab-item>


        </v-tabs>
    </v-flex>
</v-layout>
</template>

<script>
import store from './lib/store'

export default {
    data() {
        return {
            store: store,
            active: null,
            edit: null,
            audit: null,
            barcode: this.$route.params.barcode,
            asset:{}
        }
    },
    computed: {
        xhr_loading() {
            return this.store.isActive()
        },

        assettypeName() {
            if(typeof(this.asset.assettype) != "undefined"){
                return '( ' + this.asset.assettype.name + ' )'
            }
        }

    
    },
    methods: {
        addAudit(audit){
            // console.log('pushing new audit',audit)
            this.asset.audits.push(audit)
        },
        load () {

            
            this.$api.get('/api/asset/'+ this.barcode,(status,data) => {
                this.asset = Object.assign({},data.asset)
            })
            
            
            
            

        },
    },
    mounted() {
        this.load()
    },
    watch: {
        '$route' (to, from) {
            // react to route changes...
            // console.log('re-routed to: ',to.params.barcode)
            this.barcode = to.params.barcode
            if(typeof(this.barcode) !== 'undefined'){
                this.load()
            }

            
        }
    }
}

</script>