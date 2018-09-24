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

function makeRule(field,ruletype,attr=false){

          switch(ruletype){
                case 'required':
                    return function (v) {
                                console.log(field)
                                console.log(v)
                                return !!v || field.label + ' is required'
                            } 
                            break;
                case 'min':
                    return function (v) {
                                console.log(field)
                                console.log(v)
                                return v.length >= attr.length || field.label + ' must be more than or equal to ' + attr.length + 'characters'
                            } 
                            break;
                        

                case 'max':
                    return function (v) {
                                console.log(field)
                                console.log(v)
                                return v.length <= attr.length || field.label + ' must be less than  ' + attr.length + 'characters'
                            } 
                            break;
            

          }



      }


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
      logRule(v){
          console.log('logRule',v,c);
          return true;
      },

      
      addRules(schema) { // convert laravel rules to v-form rules

        
        let self = this;
        const ruleFunc = this.logRule

          _.each(schema, function(value,key, obj){
                //console.log('obj.key',obj[key])

                if(!obj[key].hasOwnProperty('rules')){
                    obj[key].rules = []
                    
                }

                const rulesStr = obj[key].rules

                const rulesArray =[];

                
                

                if( rulesStr.length > 0){
                   

                    // check for required
                    if (/required/.exec(rulesStr)){                      
                        rulesArray.push(makeRule(obj[key],'required'))
                    }

                    // check for min
                    const minResult = /min:(\d+)/.exec(rulesStr)
                    console.log(minResult[1])
                    if ( minResult[1] > 0 ) {                      
                        rulesArray.push( makeRule(obj[key],'min',{length:minResult[1]}) )
                    }

                    //check for max
                    const maxResult = /max:(\d+)/.exec(rulesStr)      
                     if ( maxResult[1] ) {                      
                        rulesArray.push(makeRule( obj[key], 'max' , {length: maxResult[1]}) )
                    }


                    
                } 

                console.log('RULES',rulesArray)
                
                obj[key].rules = rulesArray
                
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