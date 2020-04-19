/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


window.Vue = require('vue');




import {BootstrapVue, IconsPlugin} from 'bootstrap-vue';
import { createPopper } from '@popperjs/core';
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

import Multiselect from 'vue-multiselect'
import ToggleButton from 'vue-js-toggle-button';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


//My components.
Vue.component('my-company',require('./components/company/company_owner/MyCompany').default);
Vue.component('employee-overview',require('./components/employees/company_owner/EmployeeOverview').default);
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('push-notification-index',require('./components/notification/push/company_owner/PushNotificationIndex').default);
Vue.component('navigation',require('./components/partials/dashboard/Navigation').default);

const toastOptions = {
    timeout: 4500,
    position: "top-right"
};


// register globally
Vue.component('multiselect', Multiselect);
Vue.use(Toast, toastOptions);
Vue.use(ToggleButton);
Vue.use(createPopper);
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


require('./bootstrap');
require('./utilities');
require('./polyfills');
require('./jquery-extension');

const app = new Vue({
    el: '#app',
});

//Sidebar toggler here
(function($) {
    "use strict"; // Start of use strict

    // Toggle the side navigation
    // $("#sidebarToggle").on('click', function(e) {
    //     e.preventDefault();
    //     $("body").toggleClass("sidebar-toggled");
    //     $(".sidebar").toggleClass("toggled");
    // });

    // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
    $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
        if ($(window).width() > 768) {
            var e0 = e.originalEvent,
                delta = e0.wheelDelta || -e0.detail;
            this.scrollTop += (delta < 0 ? 1 : -1) * 30;
            e.preventDefault();
        }
    });

    // Scroll to top button appear
    $(document).on('scroll', function() {
        var scrollDistance = $(this).scrollTop();
        if (scrollDistance > 100) {
            $('.scroll-to-top').fadeIn();
        } else {
            $('.scroll-to-top').fadeOut();
        }
    });

    // Smooth scrolling using jQuery easing
    $(document).on('click', 'a.scroll-to-top', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top)
        }, 1000, 'easeInOutExpo');
        event.preventDefault();
    });

})(jQuery); // End of use strict

//end sidebar toggler
