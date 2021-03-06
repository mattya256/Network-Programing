/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('helloworld_props-component', require('./components/HelloWorldPropsComponent.vue'));

const app = new Vue({
    el: '#hello_vuejs',
    data: {
        showMessage: "Good Morning1 VueJS from Vue App",
        message1: "Good Morning2 VueJS from Vue App",
        message2: "Good Afternoon VueJS from Vue App",
        serverMessage: "",
        serverSelectData: "",
        selected: "",
        isDisplay: "block"
    },
    mounted: function () {
        serverData = getServerData();
        this.serverMessage = serverData.message;
        this.serverSelectData = serverData.select_data;
    },
    methods: {
        changeMessage: function () {
            this.showMessage = this.message2;
        }
    }
});
