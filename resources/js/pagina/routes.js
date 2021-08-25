import Vue from 'vue';
import VueRouter from 'vue-router'
import pages_router from './pages/pages.routes.js'
import pages_component from '../pagina/pages/pages.vue'

Vue.use(VueRouter)

const routes = [
  { 
    path: "/", 
    component:pages_component,
    children: pages_router
  }
];

const app_router = new VueRouter({
mode: 'hash',
routes,  
});

export default app_router;