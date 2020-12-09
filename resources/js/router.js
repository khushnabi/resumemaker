import Vue from 'vue';
import Router from 'vue-router';
import Resumes from "./components/Resume.vue";
import Experiance from './pages/resumes/CreateExp.vue';
import Education from "./pages/resumes/CreateEdu.vue";
import Template1 from "./tempates/Template1.vue";
import CreateResume from "./pages/resumes/create.vue";
import Skill from "./pages/resumes/createSkill.vue"
import Summary from "./pages/resumes/createSummary.vue"
import Final from "./pages/resumes/createFinal"


Vue.use(Router);
const routes = [
    { path: '/resumes', component:Resumes},
    { path: '/resumes/create', component:CreateResume},
    {path: '/resumes/:id/experiance', component:Experiance },
    {path: '/resumes/:id/education', component:Education },
    {path: '/resumes/:id/skill', component:Skill },
    {path: '/resumes/:id/Summary', component:Summary },
    {path: '/resumes/:id/final', component:Final },
    { path: '/resumes/:id/edit', component : CreateResume },
    { path: '/resumes/:id/:user_name', component:Template1 },
    { path: '/resumes/:id', component:Template1 }
];

export default new Router({
    mode: 'history',
    routes
});
