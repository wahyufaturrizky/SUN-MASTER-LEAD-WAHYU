
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// /*

// import Vue from 'vue'
import Vuetify from 'vuetify'

Vue.use(Vuetify)
// index.js or main.js
import 'vuetify/dist/vuetify.min.css' // Ensure you are using css-loader

// main.styl
// @import '~vuetify/src/stylus/main' // Ensure you are using stylus-loader


import VeeValidate from 'vee-validate'
Vue.use(VeeValidate)

// import ScaleLoader from 'vue-spinner/src/ScaleLoader.vue'
// Vue.use(ScaleLoader)

Vue.component('scale-loader', require('vue-spinner/src/ScaleLoader.vue'));

Vue.use(require('vue-pusher'), {
    api_key: 'db55fa319c255ef163ac',
    options: {
        cluster: 'ap1',
        encrypted: true,
    }
});

// All Component (Global)
// Vue.component('','.')

Vue.component('email-marketing-form', require('./pages/email-marketing/Index.vue'));
// Vue.component('example-component', require('./components/ExampleComponent.vue'));


const appVueEmailMarketing = new Vue({
    el: '#appVueEmailMarketing',
    metaInfo: {
        title: 'Email Marketing'
    }
});
// */
