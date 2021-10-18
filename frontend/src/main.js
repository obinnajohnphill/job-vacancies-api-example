import Vue from 'vue'
import App from './App.vue'

import { BootstrapVue } from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue)

Vue.use(require('vue-resource'));
Vue.component('pagination', require('laravel-vue-pagination'));

// library.add(faUserSecret)

Vue.config.productionTip = false

// global variable
Vue.prototype.$endpoint = "http://localhost:8082"

new Vue({
  render: h => h(App),
}).$mount('#app')
