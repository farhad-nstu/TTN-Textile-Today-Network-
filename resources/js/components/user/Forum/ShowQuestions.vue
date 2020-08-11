<template>  
  <div>   
		<section class="forum-page py-2">                 
				<div class="forum-questions my-1" v-for="question in showQuestions" v-bind:key="question.id">
					<div class="usr-question">                
						<div class="usr_quest float-left p-0">
							<div class="col-md-12 p-0">
								<div class="row">

									<div  class="col-md-2">
										<div class="usr_img">
											<router-link :to="`/user-profile/${question.id}`">
												<img v-if="question.user.profile_picture" class="rounded-circle"  v-bind:src="'/storage/uploads/'+question.user.id+'/Users/'+question.user.profile_picture" > 
												<img v-else  class="rounded-circle" v-bind:src="'/Images/profile/profile_logo.png'">
											</router-link>                                
										</div>
										<div class="float-left" >
											<router-link :to="`/user-profile/${question.id}`">
												<p style="font-size: 10px;">{{ question.user.name }}</p>
											</router-link>                                
											<p>{{ question.user.total_score }} Scores</p>
											<p>{{ question.user.total_questions }} Questions</p>
											<p>{{ question.user.total_answers }} Answers</p>
										</div>
									</div>
									<div class="col-md-10" style="margin-left: -20px;">
										<div>
											<router-link :to="`/question-details/${question.id}`">
												<p class="text-primary h5"> {{ question.title}}</p>
											</router-link>
											<p v-html="question.details"></p>
										</div>
										
										<div>
											<ul class="quest-tags my-3">
												<span class="badge badge-primary">{{ question.question_category.title }}</span>
												<router-link :to="`/question-details/${question.id}`">
													<span class="badge badge-success">{{ question.total_answer }} Answers</span>
												</router-link>
											</ul>
										</div>
										<div>  
											<ul class="react-links">
												<li><a title="">{{ question.created_at| formatDate }} </a></li>
												<li><a @click.prevent="UpVote(question)" title=""><i :style="like == false ? 'green' : 'black'" class="fas fa-arrow-alt-circle-up"></i><b>{{ question.up_vote }}</b> <b style="color: green">Up Score</b></a></li>
												<li><a @click.prevent="DownVote(question)" title=""><i :style="dislike == false ? 'green' : 'black'" class="fas fa-arrow-alt-circle-down"></i><b>{{ question.down_vote }}</b> <b style="color: red">Down Score</b></a></li>
												<li><a title=""><i class="fas fa-eye"></i> {{ question.total_view }} views </a></li>
												<li v-if="question.created_by == userId">
													<router-link :to="`/update-question/${question.id}`">
														<i class="fas fa-edit"></i>
													</router-link>
													<a @click="deleteData(question.id)">
														<i class="fas fa-trash-alt"></i>
													</a>
												</li>
											</ul> 
										</div>                             
									</div>

								</div>
							</div>
						</div>  
					</div>
				</div>
				<!-- <pagination :data="questions" @pagination-change-page="getData"></pagination>  -->
			</section>   
  </div>
</template>

<script>
export default {
  name: 'ShowQuestions',
  data () {
    return {    
      up_vote:"",
      question_id:"",
      like : false,
      dislike: false,
      userId: "",
    }
  },

	props: {
		showQuestions: {},
	},

  mounted() {
		this.userId = JSON.parse(localStorage.getItem('TTNetwork.user')).id;
		this.getData();
  },
  methods: {

    UpVote(question){
      let like = this.like;
      if(like == false){
        axios.put(`/api/up-votes/${question.id}`, {
          up_vote : question.up_vote + 1,
          })
        .then(response => {
            this.like = true;
            this.getData();
            return 'green';
        })      
      } else {
        axios.put(`/api/up-votes/${question.id}`, {
        up_vote : question.up_vote - 1,
        })
        .then(response => {
          this.like = false
            this.getData()
            return 'black';
        })
      }      
    },

    DownVote(question){
      let dislike = this.dislike;
      if(dislike == false){
        axios.put(`/api/down-votes/${question.id}`, {
          down_vote : question.down_vote + 1,
          })
        .then(response => {
            this.dislike = true;
            this.getData()
            return 'green';
        })  
      } else {
        axios.put(`/api/down-votes/${question.id}`, {
        down_vote : question.down_vote - 1,
        })
        .then(response => {
          this.dislike = false
            this.getData()
            return 'black';
        })
      } 
		},
		
    deleteData(id) {
      if (confirm("Are You Sure?")) {
        axios.delete(`/api/question-index/${id}`)
          .then(res => {
            this.title = "";
            this.getData();
            console.log(res);
            toast.fire({
              icon: "info",
              title: "Deleted!"
            });
          })
          .catch(err => {
            console.log(err);
          });
      }
    },
  }  
}
</script>

<style scoped>
</style>
