import Vue from 'vue';
import router from './router';
import App from './components/App';

import VueFlashMessage from 'vue-flash-message';
Vue.use(VueFlashMessage);

import moment from "moment";

Vue.filter("questionFormatDate", function (value) {
  if (value) {
    return moment(String(value)).format("Do MMM YYYY");
  }
});

Vue.filter("formatDate", function(value) {
  if (value) {
   return moment(value).fromNow();
   // return moment(String(value)).format("Y-M-d H:i:s");
  }
});

require("./bootstrap");
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
Vue.config.productionTip = false;

new Vue({
  el: "#app",
  router,
  components: {
    App
  },
  render: h => h(App)
}).$mount("#app");;