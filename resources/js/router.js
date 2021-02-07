import Vue from 'vue';
import Router from 'vue-router';
import Resumes from "./components/Resume.vue";
import showResume from "./components/showResume.vue";
import Experiance from './pages/resumes/CreateExp.vue';
import Education from "./pages/resumes/CreateEdu.vue";
import Template1 from "./tempates/Template1.vue";
import CreateResume from "./pages/resumes/create.vue";
import Skill from "./pages/resumes/createSkill.vue"
import Summary from "./pages/resumes/createSummary.vue"
import Final from "./pages/resumes/createFinal"
import Show from "./pages/resumes/show.vue"

import Templates from "./components/templates";


Vue.use(Router);
const routes = [
    { path: '/resumes', component:Resumes},
    { path: '/resumes/:id/:templete/show', component:Show},
    { path: '/resumes/:id/:templete/download', component:Show},
    { path: '/resumes/templates', component: Templates},
    { path: '/resumes/:templete/create', component:CreateResume},
    { path: '/resumes/:templete/:id/experiance', component:Experiance },
    { path: '/resumes/:templete/:id/education', component:Education },
    { path: '/resumes/:templete/:id/skill', component:Skill },
    { path: '/resumes/:templete/:id/Summary', component:Summary },
    { path: '/resumes/:templete/:id/final', component:Final },
    { path: '/resumes/:id/edit', component : CreateResume },
    { path: '/resumes/:id/:user_name', component:Template1 },
];

export default new Router({
    mode: 'history',
    routes
});
