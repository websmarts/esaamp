<template>  
    <div>MYFORM {{ barcode }}

        <v-form ref="form">
            <v-container>
                <v-layout row wrap>
                    <v-text-field label="Barcode" :value="barcode" readonly ></v-text-field>

                    <v-flex  v-for="s in schema" :key="s.name" xs12 >
                        
                    <component 
                        :is="s.input" 
                        :label="s.label"
                        :rules="s.rules" 
                        :readonly="s.readonly"
                        :value="formdata[s.name]"
                        :items="s.items"
                        light
                        ></component>
                    </v-flex>
                    <v-btn
                        :disabled="!valid"
                        @click="submit"
                        >
                        submit
                    </v-btn>
                    <v-btn @click="clear">clear</v-btn>
                </v-layout>
            </v-container>
        </v-form>
    </div>

</template>

<script>
export default {
    props: ['barcode'],
    data() {
        return {
            
            valid: true,
            formdata: {},
            schema: []
            
        }
    },
    methods: {
      submit () {
        if (this.$refs.form.validate()) {
          // Native form submission is not yet supported
          console.log('Form is valid and I am submitting it now')
        }
      },
      clear () {
        this.$refs.form.reset()
      },
      addRules(schema) {

          _.each(schema, function(value,key, obj){
                obj[key].rules = 'makeyRules'
          })
          return schema

      },
      load () {
        let self = this
        axios.get('/api/sling/'+ this.barcode)
        .then(function (response) {
            // handle success
            // console.log(response.data);
            self.formdata = response.data.formdata

            const schema = self.addRules(response.data.formschema)

            self.schema = schema

            
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
        'barcode' (to, from) {
        // react to route changes...

        // Ajax load latest data from server for asset ....
        console.log('barcode updated to: ',to)
        this.formdata.description = 'my description for ' + this.barcode;
        this.formdata.notes = 'my notes for barcode ' + this.barcode;
        this.load()

        

        }
    },
    mounted() {
        this.load()
    }
}

</script>