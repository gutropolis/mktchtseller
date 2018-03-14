import Vue from 'vue'
import VueRouter from 'vue-router'
import axios from 'axios'
import BootstrapVue from 'bootstrap-vue'
import Form from './services/form'

Vue.use(BootstrapVue);
window.Vue = Vue;
Vue.use(VueRouter);
window.axios = axios;
window.Form = Form;

import VueChatScroll from 'vue-chat-scroll'
Vue.use(VueChatScroll)

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('auth_token');

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to esily build robust real-time web applications.
 */

 import Echo from 'laravel-echo'

 window.Pusher = require('pusher-js');

 window.Echo = new Echo({
     broadcaster: 'pusher',
     key: '151a6665be15a27f9c23',
	  cluster: 'ap2',
    encrypted: true
 });
