<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
</head>
<body>
  <div id="app">
    <v-app id="inspire">
    
        
        <v-toolbar color="primary" height="85" dark fixed app>
        
            <v-toolbar-title>
                <img src="images/logo-with-tick-white.png" height="45" /><br />
                <span style="font-size:13px">Equipment Safety Audit &amp; Asset Management Portal</span>
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-title class="title" >Alfred Hospital</v-toolbar-title>
            <v-spacer></v-spacer>

            <v-toolbar-items class="hidden-sm-and-down">
                <v-btn  flat><a href="/logout" style="color:white;text-decoration: none">Logout</a></v-btn>
            </v-toolbar-items>
            
        </v-toolbar>
        





        <v-content>
        
            <v-toolbar tile dark flat  color="primary lighten-2" height="90">
                
                    
                <v-layout row align-center justify-center >
                    <v-flex xs12 sm11 md7>

                    <asset-toolbar></asset-toolbar>
                            
                    </v-flex>
                </v-layout>

            </v-toolbar>
        
        <v-container fluid >
        
            <v-layout row align-center>
            <v-flex text-xs-center>
                <router-view></router-view>
            </v-flex>
            


            </v-layout>
        </v-container>
        </v-content>

        <v-footer color="primary" app>
        <span class="white--text">&copy; 2018</span>
        </v-footer>
    </v-app>
  </div>

<script>
    // Global app data
const clientdata = @json($clientdata);

</script>
 
  
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
