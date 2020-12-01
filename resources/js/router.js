import Vue from 'vue';
import Router from 'vue-router';
import Resumes from "./components/Resume.vue";
import Template1 from "./tempates/Template1.vue"

Vue.use(Router);

const routes = [
    { path: '/resumes', component:Resumes},
    { path: '/resumes/:id', component:Resumes},
    { path: '/resumes/:id/:user_name', component:Template1}
];


export default new Router({
    mode: 'history',
    routes
});