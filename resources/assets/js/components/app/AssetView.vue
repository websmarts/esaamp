<template>
<v-layout justify-center>
    
    <v-flex xs12 sm10 md8 lg6>
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
                            <asset-edit-form :asset="asset"></asset-edit-form>
                        </v-card-text>
                    
                </v-card>
                        
            </v-tab-item>

            <v-tab-item  
                :key="audit"
            >
                <v-card flat>
                <v-card-text><asset-audit :asset="asset"></asset-audit></v-card-text>
                </v-card>
            </v-tab-item>


        </v-tabs>
    </v-flex>
</v-layout>
</template>
<script>
export default {
    data() {
        return {
            active: null,
            edit: null,
            audit: null,
            barcode: this.$route.params.barcode,
            asset:{}
            
        }
    },
    methods: {
        load () {
            let self = this
            

            axios.get('/api/asset/'+ this.barcode)
            .then(function (response) {
                // handle success
                // console.log(response.data);

                self.asset = response.data.asset

                
                
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
    mounted() {
        this.load()
    },
    watch: {
    '$route' (to, from) {
      // react to route changes...
      console.log('re-routed to: ',to.params.barcode)
      this.barcode = to.params.barcode
      this.load()
    }
  }
}

</script>