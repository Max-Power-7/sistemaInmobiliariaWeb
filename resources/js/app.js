/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

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
Vue.component('frm-principal', require('./components/frmPrincipal.vue').default);
Vue.component('frm-cliente', require('./components/frmCliente.vue').default);
Vue.component('frm-empleado', require('./components/frmEmpleado.vue').default);
Vue.component('frm-usuario', require('./components/frmUsuario.vue').default);
Vue.component('frm-localidad', require('./components/frmLocalidad.vue').default);
Vue.component('frm-propietario', require('./components/frmPropietario.vue').default);
Vue.component('frm-propiedad', require('./components/frmPropiedad.vue').default);
Vue.component('frm-notaventa', require('./components/frmNotaVenta.vue').default);
Vue.component('frm-agente', require('./components/frmAgente.vue').default);
Vue.component('frm-pago', require('./components/frmPago.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data : {
        menu : 0
    }
});
