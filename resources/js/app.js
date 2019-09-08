
require('./bootstrap');

window.Vue = require('vue');

import VueMaterial from 'vue-material';
import 'vue-material/dist/vue-material.min.css';

Vue.use(VueMaterial);

import MainPage from './components/MainPage';
import Navbar from './components/Navbar';
import ManageData from './components/ManageData';
import ManageFaculties from './components/ManageFaculties';

Vue.component('main-page', MainPage);
Vue.component('navbar', Navbar);
Vue.component('manage-data', ManageData);
Vue.component('manage-faculties', ManageFaculties);

const app = new Vue({
    el: '#app'
});

