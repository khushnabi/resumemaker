import Vue from 'vue';
import Router from 'vue-router';
import Resumes from "./components/Resume.vue";
import showResume from "./components/showResume.vue";
import Experience from './pages/resumes/CreateExp.vue';
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
    { path: '/templates', component: Templates },
    { path: '/templates/:template/create', component: CreateResume },
    { path: '/resumes', component: Resumes},
    { path: '/resumes/:id/edit', component : CreateResume },
    // { path: '/resumes/:template/create', component: CreateResume },
    // { path: '/resumes/:id/:user_name', component: Template1 },
    { path: '/resumes/:id', component: Show },
    { path: '/resumes/:id/:template/download', component: Show },
    { path: '/resumes/:id/experience', component: Experience },
    { path: '/resumes/:id/education', component: Education },
    { path: '/resumes/:id/skill', component: Skill },
    { path: '/resumes/:id/Summary', component: Summary },
    { path: '/resumes/:id/final', component: Final },
];

export default new Router({
    mode: 'history',
    routes
});
