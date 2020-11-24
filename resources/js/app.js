require('./bootstrap');
import Vue from "vue";
import App from "./App.vue";
import router from "./router"
import ViewUI from 'view-design';
import  'view-design/dist/styles/iview.css';
import axios from './axios';

Vue.mixin(axios);

Vue.use(ViewUI);

new Vue({
    render: h=>h(App),
    router
}).$mount("#root")