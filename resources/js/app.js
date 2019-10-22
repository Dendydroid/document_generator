
require('./bootstrap');

window.Vue = require('vue');

import VueMaterial from 'vue-material';
import 'vue-material/dist/vue-material.min.css';

Vue.use(VueMaterial);

import MainPage from './components/MainPage';
import Navbar from './components/Navbar';
import Settings from './components/Settings';
import SettingsAdmin from './components/SettingsAdmin';
import Register from './components/Register';
import Login from './components/Login';
import Profile from './components/Profile';
import ManageData from './components/ManageData';
import ManageDepartments from './components/ManageDepartments';
import ManageSpecialities from './components/ManageSpecialities';
import ManageGroups from './components/ManageGroups';
import ManageSubjects from './components/ManageSubjects';
import ManageStudents from './components/ManageStudents';
import ZajavaIspit from './components/ZajavaIspit';
import ZvedenaVidomist from './components/ZvedenaVidomist';
import VpiskaOzinok from './components/VpiskaOzinok';
import Vidomist1Mod from './components/Vidomist1Mod';
import Vidomist2Mod from './components/Vidomist2Mod';
import VidomistKR from './components/VidomistKR';

Vue.component('main-page', MainPage);
Vue.component('navbar', Navbar);
Vue.component('settings', Settings);
Vue.component('settings-admin', SettingsAdmin);
Vue.component('register', Register);
Vue.component('login', Login);
Vue.component('profile', Profile);
Vue.component('manage-data', ManageData);
Vue.component('manage-departments', ManageDepartments);
Vue.component('manage-specialities', ManageSpecialities);
Vue.component('manage-groups', ManageGroups);
Vue.component('manage-subjects', ManageSubjects);
Vue.component('manage-students', ManageStudents);
Vue.component('zajava-ispit', ZajavaIspit);
Vue.component('zvedena-vidomist', ZvedenaVidomist);
Vue.component('vpiska-ozinok', VpiskaOzinok);
Vue.component('vidomist-mod-1', Vidomist1Mod); 
Vue.component('vidomist-mod-2', Vidomist2Mod);
Vue.component('vidomist-kr', VidomistKR);

const app = new Vue({
    el: '#app'
});

