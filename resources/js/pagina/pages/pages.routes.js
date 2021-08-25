import InicioComponent from './inicio.vue'
import InfoHabitacionesComponent from './info-habitaciones.vue'
import InfoPerfilComponent from './info-perfil.vue'
// import axios from "axios";
// Vue.use(VueRouter)listarMenu(){
let page_routes =[
  { path: "inicio", component: InicioComponent, name: 'Inicio' },,
  { path: "info-habitaciones", component: InfoHabitacionesComponent, name: 'InfoHabitaciones' },
  { path: "info-perfil/:id", component: InfoPerfilComponent, name: 'InfoPerfil' },
  { path: "", redirect: { name: 'Inicio' }},
];
export default page_routes;