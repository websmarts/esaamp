
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
import Vuetify from 'vuetify';







// Helpers
import colors from 'vuetify/es5/util/colors'
//import apiService from './components/app/lib/apiService';
Vue.use(Vuetify, {
    theme: {
      primary: colors.indigo.darken1, // #E53935
      secondary: colors.indigo.lighten4, // #FFCDD2
      accent: colors.indigo.base // #3F51B5
    }
  })

Vue.component(
    'asset-toolbar',
    require('./components/app/AssetToolbar.vue')
);





const App = require('./components/app/WasherApp.vue');


Vue.config.productionTip = false

// import api from './components/app/lib/apiService.js';
// import apiService from './components/app/lib/apiServiceClass.js';

// const api =  new apiService;

// Vue.prototype.$api = api;



new Vue(
    { 
        el: '#app',
        template:'<App/>',
        components: { App },
        data() {
            return {
                clientname: $Clientdata.name
               
            }
        }
        

    }
);



