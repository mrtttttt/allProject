// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'

import "@/assets/css/base.css"
// import "@/assets/css/mui.css"
import "@/assets/fonts/mui.ttf"

//vux
import { AlertPlugin, ToastPlugin,ConfirmPlugin } from 'vux'

Vue.use(AlertPlugin)
Vue.use(ToastPlugin)
Vue.use(ConfirmPlugin)

/*router.afterEach((to,from,next) => {
  window.scrollTo(0,0);
});*/


// Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
