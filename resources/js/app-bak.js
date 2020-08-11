require("./bootstrap");

Vue.component("pagination", require("laravel-vue-pagination"));
import tinymce from 'vue-tinymce-editor'
Vue.component('tinymce', tinymce)

// Vue.use(VueRouter);

// const app = new Vue({
//   router
// }).$mount('#app')

import Vue from "vue";
import VueRouter from "vue-router";

import routes from "./routes";
import App from "./views/App";



const router = new VueRouter({
  mode: "history",
  routes
});
Vue.use(VueRouter);

const app = new Vue({
  el: "#app",
  components: { App },
  router
});

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
      if (localStorage.getItem('TTNetwork.jwt') == null) {
          next({
              path: '/login',
              params: { nextUrl: to.fullPath }
          })
      } else {
          let user = JSON.parse(localStorage.getItem('TTNetwork.user'))
          if (to.matched.some(record => record.meta.is_admin)) {
              if (user.is_admin == 1) {
                  next()
              }
              else {
                  next({ name: 'userboard' })
              }
          }
          // else if (to.matched.some(record => record.meta.is_user)) {
          //     if (user.is_admin == 0) {
          //         next()
          //     }
          //     else {
          //         next({ name: 'admin' })
          //     }
          // }
          else{
              next()

          }
      }
  } else {
      next()
  }
})


// Sweet Alert 2
import Swal from "sweetalert2";
const toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 1000,
  timerProgressBar: true,
  onOpen: toast => {
    toast.addEventListener("mouseenter", Swal.stopTimer);
    toast.addEventListener("mouseleave", Swal.resumeTimer);
  }
});
window.toast = toast;

//Progressbar
import VueProgressBar from "vue-progressbar";
const options = {
  color: "#4e73df",
  failedColor: "#874b4b",
  thickness: "5px",
  transition: {
    speed: "0.5s",
    termination: 300
  },
  autoRevert: true,
  location: "top",
  inverse: false
};
Vue.use(VueProgressBar, options);