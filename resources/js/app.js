/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import 'moment/dist/moment.js';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css'

import Vue from 'vue';

window.Vue = require('vue').default;



Vue.use(VueSweetalert2);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('Antecedentes', require('./components/AntecedentesComponent.vue').default);
Vue.component('antecedente-personal', require('./components/AntecedentePersonal.vue').default);
Vue.component('formulario-receta', require('./components/FormularioConsulta.vue').default);
Vue.component('consultas', require('./components/Consultas.vue').default);
Vue.component('lista-pacientes', require('./components/ListaPacientes.vue').default);
Vue.component('nuevo-paciente', require('./components/NuevoPaciente.vue').default);
Vue.component('nuevo-archivo', require('./components/NuevoArchivo.vue').default);
Vue.component('galeria-imagenes', require('./components/GaleriaImagenes.vue').default);
Vue.component('gastos', require('./components/Gastos.vue').default);
Vue.component('apertura-caja', require('./components/AperturaCaja.vue').default);
Vue.component('cierre-caja', require('./components/CierreCaja.vue').default);
Vue.component('nomina', require('./components/Nomina.vue').default);
Vue.component('configuracion', require('./components/Configuracion.vue').default);
Vue.component('calendario', require('./components/Calendario.vue').default);
Vue.component('contabilidad-pagos', require('./components/ContabilidadPagos.vue').default);
Vue.component('cxc', require('./components/CuentasPorCobrar.vue').default);
Vue.component('cxp', require('./components/CuentasPorPagar.vue').default);
Vue.component('reportes', require('./components/ReportesComponent.vue').default);
Vue.component('graficas', require('./components/GraficasComponent.vue').default);
Vue.component('perfiles', require('./components/PerfilesComponent.vue').default);
Vue.component('reportes-medicamentos-admin', require('./components/ReportesMedicamentosAdmin.vue').default);
Vue.component('reportes-consultas-admin', require('./components/ReportesConsultasAdmin.vue').default);
Vue.component('mantenimientos-ciudades-admin', require('./components/MantenimientosCiudadesAdmin.vue').default);
Vue.component('mantenimientos-clinicas-admin', require('./components/MantenimientosClinicasAdmin.vue').default);
Vue.component('mantenimientos-farmacias-admin', require('./components/MantenimientosFarmaciasAdmin.vue').default);
Vue.component('doctor-admin', require('./components/DoctorAdmin.vue').default);
Vue.component('doctor-admin-lista', require('./components/AdminListaDoctor.vue').default);
Vue.component('busqueda-farmacia', require('./components/BusquedaFarmacia.vue').default);
Vue.component('pedidos-farmacia', require('./components/PedidosFarmacia.vue').default);
Vue.component('citas-pendientes', require('./components/CitasPendientes.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));


const app = new Vue({
    el: '#app',
    // vuetify
});
