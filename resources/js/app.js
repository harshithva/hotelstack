/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Fragment from 'vue-fragment';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('reservation', require('./components/Reservation.vue').default);
// Vue.component('select-rooms', require('./components/SelectRoom.vue').default);
Vue.component('room-details', require('./components/RoomDetails.vue').default);


Vue.use(Fragment.Plugin);

const eventHub = new Vue() // Single event hub

// Distribute to components using global mixin
Vue.mixin({
    data: function () {
        return {
            eventHub: eventHub
        }
    }
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#panel',
    data: {
        selected: [],
        buttonDisabled: 0
    },
    methods: {
        selectRoom(room) {
            console.log("Hello");

            if (!this.selected.includes(room)) {
                this.selected.push(room);
                this.buttonDisabled = 1;
            } else {
                this.selected.pop(room);
            }
        }
    }
});
