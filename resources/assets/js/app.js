/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const Vue = require('vue');

import VueRouter from 'vue-router';
import App from './App.vue';
import {routes} from './routes';
Vue.use(require('vue-resource'));
Vue.use(VueRouter);

Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");

Vue.component('example', require('./components/Example.vue'));

Vue.component('admin', require('./components/Admin.vue'));

Vue.component('business-type', require('./components/modules/business-type/BusinessType.vue'));

Vue.component('create-business-type', require('./components/modules/business-type/Create.vue'));

Vue.component('city-province', require('./components/modules/CityProvince.vue'));

Vue.component('department', require('./components/modules/Department.vue'));

Vue.component('industry', require('./components/modules/Industry.vue'));

const router = new VueRouter({
    mode: 'history',
    routes
});

const app = new Vue({
    el: '#app',
    // router,
    // render: h => h(App)
});
