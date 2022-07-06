require('./bootstrap');
import Vue from "vue";
import App from "./App.vue";
import router from "./router"
import ViewUI from 'view-design';
import 'view-design/dist/styles/iview.css';
import axios from './axios';
import Show from './components/showResume.vue'
import Another from './components/showAnother.vue'

Vue.component('Show', Show)
Vue.component('Another', Another)

Vue.prototype.a = '123Show';Another

Vue.mixin({
	data:function() {
		return {
			glob:'hellow wrold'
		}
	}
});





Vue.mixin(axios);

axios.data().globalVar = 'hahahhah'
console.log(axios.data().globalVar)


Vue.use(ViewUI);

new Vue({
    render: h=>h(App),
    router
}).$mount("#root")
