<template>
  <div id="app">
  <router-view />
    <vue-progress-bar></vue-progress-bar>
  </div>
</template>

<script>
import Vue from "vue";
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

export default {
  name: "App"
};
</script>
