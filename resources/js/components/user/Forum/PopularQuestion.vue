<template>
	<div>
		<div class="widget widget-user">
      <h3 class="title-wd padding font-weight-bold text-primary">Popular Question</h3>
      <div>
        <ul style="overflow-y: scroll; height: 350px;">
          <li v-for="popularQuestion in popularQuestions" :key="popularQuestion.id" class="px-2 py-1 border-bottom">
            <div class="usr-msg-details">
              <div class="usr-ms-img">
                <img v-if="popularQuestion.user.profile_picture" class="rounded-circle"  v-bind:src="'/storage/uploads/'+popularQuestion.user.id+'/Users/'+popularQuestion.user.profile_picture" > 
                <img v-else  class="rounded-circle" v-bind:src="'/Images/profile/profile_logo.png'">
              </div>
              <div class="usr-mg-info">
                <router-link :to="`/question-details/${popularQuestion.id}`">
                  {{ popularQuestion.title}}...
                </router-link>
                <p style="font-size: 10px;">{{ popularQuestion.user.name }} </p>
              </div>
            </div>
          </li>
        </ul>
      </div>
		</div>
	</div>
</template>
<script>
	export default {
  name: 'PoularQuestion',
  data () {
    return {    
      popularQuestions: {},
    }
  },
  mounted() {
    this.popularQuestion();
  },
  methods: {
    popularQuestion() {
      this.$Progress.start();
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')
      axios({ method: "GET", url: "/api/popular-question"}).then(
        response => {
          console.log(response.data);
          this.shouldShowLoader = false;
          this.popularQuestions = response.data.popularQuestions;
        },
        error => {
          console.error(error);
        }
      );
      this.$Progress.finish();
    },
  }    
};
</script>