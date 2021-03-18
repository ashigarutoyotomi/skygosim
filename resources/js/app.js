/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import VueRouter from 'vue-router';
import { routes } from "./routes";

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.use(VueRouter);

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('admin', require('./Admin.vue').default);

Vue.component('Navbar', require('./components/Navbar.vue').default);
Vue.component('Foot', require('./components/Foot.vue').default);

Vue.component('Login', require('./pages/Auth/Login.vue').default);

Vue.component('HeaderSlider', require('./pages/Home/modules/HeaderSlider.vue').default);
Vue.component('HomeInternetPackages', require('./pages/Home/modules/InternetPackages.vue').default);

Vue.component('InternetHeader', require('./pages/Internet/modules/Header.vue').default);
Vue.component('InternetPackages', require('./pages/Internet/modules/InternetPackages.vue').default);

Vue.component('CheckoutHeader', require('./pages/Checkout/modules/Header.vue').default);
Vue.component('CheckoutForm', require('./pages/Checkout/modules/Form.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const router = new VueRouter({
    routes
});

const app = new Vue({
    router,
    el: '#app',
});
