<template>
  <div>
    <div class="wrapper">
      <Header/>

      <section class="profile-account-setting">
        <div class="container px-0">
          <div class="account-tabs-setting">
            <div class="row">

              <div class="col-lg-3">
                <ForumLeftSidebar />
              </div>

              <div class="col-lg-6 px-0">
                <!-- <ForumTopbar /> -->
                <Loader v-if="shouldShowLoader" /> 

                <section class="forum-page">                 
                  <div class="forum-questions mb-2 p-2">
                    <div class="usr-question pt-0">               

                      <div class="row border-bottom mb-5" v-if="questionDetails.id">                      
                        <div class="col-2 pr-0 py-2">
                          <div class="usr_img">
                            <router-link :to="`/user-profile/${questionDetails.user.id}`">
                              <img v-if="questionDetails.user.profile_picture" class="rounded-circle"  v-bind:src="'/storage/uploads/'+questionDetails.user.id+'/Users/'+questionDetails.user.profile_picture" > 
                              <img v-else  class="rounded-circle" v-bind:src="'/Images/profile/profile_logo.png'">
                            </router-link>                                
                          </div>
                          <div class="float-left" >
                            <router-link :to="`/user-profile/${questionDetails.user.id}`">
                              <p style="font-size: 10px;">{{ questionDetails.user.name }}</p>
                            </router-link>                                  
                            <p class="com text-dark"><i class="fa fa-question-circle"></i> {{ questionDetails.user.total_questions }}</p>
                            <p class="com text-dark"><i class="fa fa-check-square"></i> {{ questionDetails.user.total_answers }}</p>
                            <p class="com text-dark"><i class="fa fa-star"></i> {{ questionDetails.user.total_score }}</p>
                          </div>
                        </div>
                        <div class="col-10 py-2 pl-0"> <!-- pr-4 -->
                          <div>
                            <p class="h6 text-justify font-weight-bold text-primary"> {{ questionDetails.title}}</p>
                            <p class="text-justify card-text" v-html="questionDetails.details"></p>
                          </div>                              
                          <div class="row border-bottom">
                            <ul class="quest-tags my-3">
                              <span class="badge badge-primary">{{ questionDetails.question_category.title }}</span>
                              <!-- <span class="badge badge-success">{{ questionDetails.total_answer }} Answers</span> -->
                            </ul>
                          </div>
                          <div class="row pt-2">
                            <ul class="react-links">                                  
                              <li><a style="font-size: 14px;"><i class="fa fa-clock-o"></i>{{ questionDetails.created_at|questionFormatDate }} </a></li>
                              <li><a href="javascript:void(0);" class="com text-dark" @click="give_question_up_vote(questionDetails)"><i class="fa fa-plus-circle"></i>&nbsp;<b class="text-primary">{{ questionDetails.up_vote }}</b></a></li>
                              <li><a href="javascript:void(0);" class="com text-dark" @click="give_question_down_vote(questionDetails)"><i class="fa fa-minus-circle"></i>&nbsp;<b class="text-danger">{{ questionDetails.down_vote }}</b></a></li>
                              <li><a title=""><i class="fa fa-eye"></i> {{ questionDetails.total_view }}</a></li>
                              <li class="row" v-if="questionDetails.created_by == loggedInId">
                                <router-link class="com text-dark" :to="`/update-question/${questionDetails.id}`">
                                  <i class="fa fa-edit"></i>
                                </router-link> 
                                <a class="pl-2">
                                  <DeleteModal v-on:setConfirmation="delete_question" :id="questionDetails.id"/>                           
                                </a> 
                              </li>
                            </ul>
                          </div>                        
                        </div>
                      </div>



                      <div class="row border-bottom mb-2">
                        <div class="col float-left">
                          <p v-if="questionDetails.total_answer == 1" class="font-weight-bold text-primary h3">{{ questionDetails.total_answer }} Answer</p>
                          <p v-else class="font-weight-bold text-primary h4">{{ questionDetails.total_answer }} Answers</p>
                        </div>
                      </div>
                      <div class="row border-bottom mb-2" v-for="answer in answers" :key="answer.id">                 
                        <div class="col-2 pr-0 py-2">
                          <div class="usr_img">
                            <router-link :to="`/user-profile/${answer.user.id}`">
                              <img v-if="answer.user.profile_picture" class="rounded-circle"  v-bind:src="'/storage/uploads/'+answer.user.id+'/Users/'+answer.user.profile_picture" > 
                              <img v-else  class="rounded-circle" v-bind:src="'/Images/profile/profile_logo.png'">
                            </router-link>                                
                          </div>
                          <div class="float-left" >
                            <router-link :to="`/user-profile/${answer.user.id}`">
                              <p style="font-size: 10px;">{{ answer.user.name }}</p>
                            </router-link>                                  
                            <p class="com text-dark"><i class="fa fa-question-circle"></i> {{ answer.user.total_questions }}</p>
                            <p class="com text-dark"><i class="fa fa-check-square"></i> {{ answer.user.total_answers }}</p>
                            <p class="com text-dark"><i class="fa fa-star"></i> {{ answer.user.total_score }}</p>
                          </div>
                        </div>
                        <div class="col-10 py-2 pl-0"> <!-- pr-4 -->
                          <div>
                            <p class="text-justify card-text" v-html="answer.answer"></p>
                          </div> 
                          <div class="row border-bottom">
                            <ul class="quest-tags my-3">
                              <a v-if="answer.user_id != loggedInId" href="javascript:void(0);" class="badge badge-success" @click="accept_answer(answer)"><b v-if="answer.is_accepted > 0" >Accepted</b><b v-else >Accept</b></a>
                              <!-- <span class="badge badge-primary">{{ questionDetails.question_category.title }}</span>
                              <span class="badge badge-success">{{ questionDetails.total_answer }} Answers</span> -->
                            </ul>
                          </div>                             
                          <div class="row pt-2">    
                            <ul class="react-links">                              
                              <li><a><i class="fa fa-clock-o"></i>{{ answer.created_at|questionFormatDate }} </a></li>
                              <li><a href="javascript:void(0);" class="com text-dark" @click="give_answer_up_vote(answer.id, answer.created_by)"><i class="fa fa-plus-circle"></i>&nbsp;<b class="text-primary">{{ answer.up_vote }}</b></a></li>
                              <li><a href="javascript:void(0);" class="com text-dark" @click="give_answer_down_vote(answer.id, answer.created_by)"><i class="fa fa-minus-circle"></i>&nbsp;<b class="text-danger">{{ answer.down_vote }}</b></a></li>
                              <li class="row" v-if="answer.user_id == loggedInId">
                                <router-link class="com text-dark" :to="`/update-answer/${answer.id}`">
                                  <i class="fa fa-edit"></i>
                                </router-link> 
                                <a class="pl-2">
                                  <DeleteModal v-on:setConfirmation="delete_answer" :id="answer.id"/>                           
                                </a> 
                              </li>
                            </ul>
                          </div>                             
                        </div>
                      </div>
                        
                      <div class="row mt-5">
                        <div class="col-12">
                            <div class="row mb-2">
                              <div class="col pl-0">
                                <p class="h4 font-weight-bold text-primary float-left">Your Answer</p> 
                              </div>
                            </div>                                 
                            <form @submit.prevent="add_answer(questionDetails)">
                              <div>
                                <input type="text" class="form-control" id="summernote_div" v-model="answer">
                              </div>
                              <div class="form-group">
                                <label class="font-weight-bold my-2">Status</label>
                                <select class="form-control" v-model="status" required>
                                  <option v-for="(status, index) in statuses" :key="status" :value="index">
                                    {{ status }}
                                  </option>
                                </select>
                              </div>
                              <button type="submit" class="btn btn-primary">Post Answer</button>
                            </form>
                        </div>
                      </div>                        

                    </div>  
                  </div>
                </section>
              </div>

              <div class="col-lg-3">
							  <PopularQuestion />
						  </div>

            </div>
          </div>
        </div>
      </section>

    </div>
    <Footer/>    
  </div> 
</template>

<script>
import Header from '@/components/user/Header';
import Footer from '@/components/user/Footer';
import Loader from '@/components/Loader';
// import ForumTopbar from '@/components/user/Forum/ForumTopbar';
import PopularQuestion from '@/components/user/Forum/PopularQuestion';
import ForumLeftSidebar from '@/components/user/Forum/ForumLeftSidebar';
import DeleteModal from '@/components/DeleteModal';
import ScriptLoader from '@/mixins/ScriptLoader';

export default {
  name: 'QuestionDetails',
  mixins: [ScriptLoader],
  data () {
    return {    
      questionDetails: {},
      shouldShowLoader: false,
      answers: {},
      up_vote:"",
      like : false,
      dislike: false,
      question_id:"",
      answer: '',
      created_at: '',
      statuses: {},
      status: '',
      userId: "",
      loggedInId: "",
      is_accepted: "",
    }       
  },

  components: {
    Header,
    Footer,
    Loader,
    // ForumTopbar,
    PopularQuestion,
    ForumLeftSidebar,
    DeleteModal,
  },

  mounted() {
    this.loadStyleSheets("user_summernote");
    this.loadJsScripts("user_summernote");
    this.init();
    this.get_data();
    this.loggedInId = JSON.parse(localStorage.getItem('TTNetwork.user')).id;
  },

  methods: {
    get_data() {
      this.shouldShowLoader = true;
      let question_id = window.location.href.split('/').pop();
      axios.get(`/api/question/${question_id}`)
      .then(response => {
        this.questionDetails = response.data.questionDetails;
        this.answers = response.data.answers;
        this.statuses = response.data.statuses;
        this.shouldShowLoader = false;
      });
    },

    init(){
      var vueData = this;
      $(document).ready(() => {
        $('#summernote_div').on('summernote.change', function(we, contents, $editable) {
            vueData.answer = contents;
        });
      });
    },
    
    give_question_up_vote(questionDetails){
      var userId = JSON.parse(localStorage.getItem('TTNetwork.user')).id;
      if(userId == questionDetails.created_by){
        toast.fire({
          icon: "info",
          title: "You can not vote yourself!"
        });
      } else {
        axios.get(`/api/up-vote/${questionDetails.id}/${userId}/questions`).then(result => {
          // this.get_data()
          if(result.data.response == "success"){
            questionDetails.up_vote++;
            questionDetails.user.total_score+=10;
            // for(let i = 0; i <this.questions.length; i++){
            //   if(this.questions[i].user.id == question.user.id){
            //     this.questions[i].user.total_score+=10;
            //   }
            // }
            toast.fire({
              icon: "info",
              title: result.data.message,
            });
          }
          toast.fire({
            icon: "info",
            title: result.data.message,
          });
        });
      }     
    },

    give_question_down_vote(questionDetails){
      var userId = JSON.parse(localStorage.getItem('TTNetwork.user')).id;
      if(userId == questionDetails.created_by){
        toast.fire({
          icon: "info",
          title: "You can not vote yourself!"
        });
      } else {
        axios.get(`/api/down-vote/${questionDetails.id}/${userId}/questions`).then(result => {
          // this.get_data();
          if(result.data.response == "success"){
            questionDetails.down_vote++;
            questionDetails.user.total_score-=5;
            toast.fire({
              icon: "info",
              title: result.data.message,
            });
          }
          toast.fire({
            icon: "info",
            title: result.data.message,
          });
        }); 
      }     
    },

    delete_question(id) {
        axios.delete(`/api/questions/${id}`)
          .then(res => {
            this.get_data();
            $('#deleteModal'+id).modal('hide');
            toast.fire({
              icon: "info",
              title: "Deleted!"
            });
          })
          .catch(err => {
            console.log(err);
          });
    },

    //Answer part
    add_answer(questionDetails) {
      axios
        .post(`/api/answer/${questionDetails.id}`, {
          user_id: JSON.parse(localStorage.getItem('TTNetwork.user')).id,
          answer: this.answer,
          status: this.status,
        })
        .then(result => {
          this.get_data();
          // if(result.data.response == "success") {
          //   questionDetails.total_answer++;
          //   toast.fire({
          //     icon: "info",
          //     title: result.data.message,
          //   });
          // }
          toast.fire({
              icon: "info",
              title: result.data.message,
          });
          this.answer = "";
          this.status = "";
          questionDetails.preventDefault();
        })
      },

    give_answer_up_vote(id, creator){
      var userId = JSON.parse(localStorage.getItem('TTNetwork.user')).id;
      if(userId == creator){
        toast.fire({
          icon: "info",
          title: "You can not vote yourself!"
        });
      } else {
        axios.get(`/api/up-vote/${id}/${userId}/answers`).then(result => {
          this.get_data();
          if(result.data.response != "success"){
            toast.fire({
              icon: "info",
              title: result.data.message,
            });
          }
          toast.fire({
            icon: "info",
            title: result.data.message,
          });
          
        });
      }     
    },

    give_answer_down_vote(id, creator){
      var userId = JSON.parse(localStorage.getItem('TTNetwork.user')).id;
      if(userId == creator){
        toast.fire({
          icon: "info",
          title: "You can not vote yourself!"
        });
      } else {
        axios.get(`/api/down-vote/${id}/${userId}/answers`).then(result => {
          this.get_data();
          if(result.data.response != "success"){
            toast.fire({
              icon: "info",
              title: result.data.message,
            });
          } 
          toast.fire({
            icon: "info",
            title: result.data.message,
          });
        }); 
      }     
    },

    accept_answer(answer){
      var userId = JSON.parse(localStorage.getItem('TTNetwork.user')).id;
        axios.put(`/api/answer/is-accept/${answer.id}/${userId}`, {
          is_accepted: this.is_accepted,         
        })
        .then(result => {
          if(result.data.response == "success"){
            answer.is_accepted++;
            return 'green';
          }
        })              
    },

    delete_answer(id) {
        axios.delete(`/api/delete-answer/${id}`)
          .then(res => {
            this.get_data();
            $('#deleteModal'+id).modal('hide');
            toast.fire({
              icon: "info",
              title: "Deleted!"
            });
          })
          .catch(err => {
            console.log(err);
          });
    },

  }
    
};
</script>

<style scoped>
  .comment-sec ul li {
    float: left;
    width: none;
  }
</style>

