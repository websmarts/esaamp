
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
import Router from 'vue-router';
import Vuetify from 'vuetify';





Vue.use(Router)
Vue.use(Vuetify)

Vue.component(
    'asset-toolbar',
    require('./components/app/AssetToolbar.vue')
);

const Dashboard = {template:'<div>Dashboard</div>'};
const AddAsset = {template:'<div>Add Asset</div>'};
const ViewAsset = require('./components/app/AssetView.vue')
const Reports = {template:'<div>Reports</div>'};

const myform = require('./myform.vue');
Vue.component('myform',myform);

const routes = [
    { path: '/', component: Dashboard },
    { path: '/view/:barcode', component: ViewAsset },
    { path: '/add', component: AddAsset },
    { path: '/reports', component: Reports }
  ];

const router = new Router({
    routes
    
});


Vue.config.productionTip = false

new Vue(
    { 
        el: '#app',
        router
        

    }
);



