import Vue from 'vue';
import Router from 'vue-router';
import Resumes from "./components/Resume.vue";

Vue.use(Router);

const routes = [
    { path: '/resumes', component:Resumes}
];


export default new Router({
    mode: 'history',
    routes
});