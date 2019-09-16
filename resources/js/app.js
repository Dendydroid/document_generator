
require('./bootstrap');

window.Vue = require('vue');

import VueMaterial from 'vue-material';
import 'vue-material/dist/vue-material.min.css';

Vue.use(VueMaterial);

import MainPage from './components/MainPage';
import Navbar from './components/Navbar';
import ManageData from './components/ManageData';
import ManageFaculties from './components/ManageFaculties';
import ManageSpecialities from './components/ManageSpecialities';
import ManageGroups from './components/ManageGroups';
import ManageSubjects from './components/ManageSubjects';
import ManageStudents from './components/ManageStudents';

Vue.component('main-page', MainPage);
Vue.component('navbar', Navbar);
Vue.component('manage-data', ManageData);
Vue.component('manage-faculties', ManageFaculties);
Vue.component('manage-specialities', ManageSpecialities);
Vue.component('manage-groups', ManageGroups);
Vue.component('manage-subjects', ManageSubjects);
Vue.component('manage-students', ManageStudents);

const app = new Vue({
    el: '#app'
});

