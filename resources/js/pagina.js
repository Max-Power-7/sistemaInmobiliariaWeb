require('./bootstrap');
window.Vue = require('vue').default;
try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

Vue.component('app-pagina', require('./pagina/layouts/app.vue').default);

import router from './pagina/routes.js'

const app = new Vue({
    el: '#pagina',
    router,
});