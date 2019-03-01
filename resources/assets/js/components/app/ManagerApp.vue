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

                    <asset-toolbar :currentroute="currentroute"></asset-toolbar>
                            
                    </v-flex>
                </v-layout>

            </v-toolbar>
        
            
        
        <v-container fluid >
        
            <v-layout row align-center>
            <v-flex text-xs-center>
                <transition name="fade" >
                    <router-view :key="$route.params.assetid"></router-view>
                </transition>
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
            currentroute: '',
            loading: window.loading
        }
    },
    methods: {
        setCurrentRoute(){
            let action = this.$route.path
            let res = action.match(/\/([^\/]*)/)
            this.currentroute = res[1]

        }
    },
    watch: {
        '$route' (to, from) {
            // react to route changes...
            // console.log('re-routed to: ',to.path)
            this.assetId = to.params.assetid

            this.setCurrentRoute()
        }
    },
    mounted() {
        this.setCurrentRoute()
    }
}

</script>