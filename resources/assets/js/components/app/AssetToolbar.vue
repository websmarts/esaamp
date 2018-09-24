<template>

      <v-card flat>
          <v-layout row align-center>
              <v-flex xs4 >

                        <v-autocomplete
                            :loading="loading"
                            :items="items"
                            item-text="barcode"
                            item-value="barcode"
                            v-model="select"
                            @change="assetSelected"
                            clearable
                            cache-items
                            light
                            flat
                            hide-details
                            label="Enter barcode..."
                            solo
                        ></v-autocomplete>
                </v-flex>
                <v-flex ><v-btn :disabled="!select" color="blue darken-2" @click="view">Select</v-btn></v-flex>
                <v-flex ><v-btn color="blue darken-2" @click="add">Add</v-btn></v-flex>
                <v-flex ><v-btn color="blue darken-2" @click="reports">Reports</v-btn></v-flex>
          </v-layout>
        </v-card>
                        

                    


</template>

<script>
export default {
    data() {

        return {
            select: this.$route.params.barcode,
            items: [],
            
            loading: false,
            isEditing: false,
            goBtnDisabled: true,
            
        }
    },
    methods: {
        assetSelected(e) {
            this.goBtnDisabled = false
        },
        view() {
            this.$router.push('/view/'+this.select);
            
        },
        add() {
            this.$router.push('/add');
        },
        reports() {
            this.$router.push('/reports');
        },
        

    },
    mounted() {
        let self = this
        axios.get('/api/slings')
        .then(function (response) {
            // handle success
            // console.log(response.data);
            self.items = response.data
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        })
        .then(function () {
            // always executed
        });
    }

}


</script>