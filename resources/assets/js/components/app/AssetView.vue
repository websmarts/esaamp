<template>
<v-layout justify-center>
    <v-flex xs12 sm10 md8 lg6>
        <v-tabs
            v-model="active"
            color="grey darken-3"
            dark
            slider-color="purple"
            >
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
                    Edit Asset Form
                    <myform :barcode="barcode"></myform>
                    </v-card-text>
                </v-card>
            </v-tab-item>

            <v-tab-item  
                :key="audit"
            >
                <v-card flat>
                <v-card-text>Audit Asset Form &amp; History</v-card-text>
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
            
        }
    },
    watch: {
    '$route' (to, from) {
      // react to route changes...
      console.log('re-routed to: ',to.params.barcode)
      this.barcode = to.params.barcode
    }
  }
}

</script>