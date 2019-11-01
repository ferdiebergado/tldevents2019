/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('bootstrap4-tagsinput/tagsinput');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

const flatpickr = require("flatpickr");

flatpickr('.flatpickr');

$(document).ready(function () {

    const mobileTagInput = $('.mobile-tagsinput');
    const emailTagInput = $('.email-tagsinput');

    mobileTagInput.tagsinput({
        focusClass: 'custom-focus',
        maxChars: 11
    });

    emailTagInput.tagsinput({
        focusClass: 'custom-focus'
    });

    mobileTagInput.on('beforeItemAdd', function (e) {

        const numeric = /^\d+$/;
        const mobileHelp = $('#mobileHelp');
        mobileHelp.hide();

        if (e.item.length < 11) {
            mobileHelp.text(' Mobile should be exactly 11 digits.');
            mobileHelp.show();
            e.cancel = true;
            return;
        }

        if (!numeric.test(e.item)) {
            mobileHelp.text('Mobile should only contain numbers.');
            mobileHelp.show();
            e.cancel = true;
            return;
        }
    });

    emailTagInput.on('beforeItemAdd', function (e) {
        const emailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
        const emailHelp = $('#emailHelp');

        emailHelp.hide();

        if (!e.item.match(emailformat)) {
            emailHelp.text('Invalid email.');
            emailHelp.show();
            return e.cancel = true;
        }
    })
});