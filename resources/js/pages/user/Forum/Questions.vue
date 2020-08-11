<template>
  <div>
    <div class="wrapper">
      <Header/>      
      <section class="profile-account-setting">
        <div class="container px-0">
          <div class="account-tabs-setting">
            <div class="row">
              <div class="col-lg-3 pl-0">
                <ForumLeftSidebar v-on:leftSideBarClicked="get_content_type" />
              </div>
              <div class="col-lg-6 px-0">
                <ForumTopbar  v-on:setQuestions="get_category_id" />
                <Loader v-if="shouldShowLoader" /> 

                
                <!-- My Question -->
                <div v-if="content_type=='my_questions'">               
                  <div class="forum-questions mb-2 px-1 py-3" v-for="question in questions" v-bind:key="question.id">              
                    <div class="row">                     
                      <div class="col-2 pr-0">
                        <div class="usr_img">
                          <router-link :to="`/user-profile/${user.id}`">
                            <img v-if="user.profile_picture" class="rounded-circle"  v-bind:src="'/storage/uploads/'+user.id+'/Users/'+user.profile_picture" > 
                            <img v-else  class="rounded-circle" v-bind:src="'/Images/profile/profile_logo.png'">
                          </router-link>                                
                        </div>
                        <div class="float-left" >
                          <router-link :to="`/user-profile/${user.id}`">
                            <p style="font-size: 10px;">{{ user.name }}</p>
                          </router-link>                                  
                          <p class="text-dark"><i class="fa fa-question-circle"></i> {{ user.total_questions }}</p>
                          <p class="text-dark"><i class="fa fa-check-circle"></i> {{ user.total_answers }}</p>
                          <p class="text-dark"><i class="fa fa-star"></i> {{ user.total_score }}</p>
                        </div>
                      </div>
                      <div class="col-10 pl-0">
                        <div>
                          <router-link :to="`/question-details/${question.id}`">
                            <p class="h6 text-justify font-weight-bold text-primary"> {{ question.title}}</p>
                          </router-link>
                          <p class="text-justify card-text" v-html="question.details"></p>
                        </div>                              
                        <div class="row border-bottom">
                          <ul class="quest-tags my-3">
                            <span class="badge badge-primary">{{ question.question_category.title }}</span>
                            <router-link :to="`/question-details/${question.id}`">
                              <span class="badge badge-success">{{ question.total_answer }} Answers</span>
                            </router-link>
                          </ul>
                        </div>
                        <div class="row pt-2">                                  
                          <div class="col px-0">
                            <ul class="react-links">
                              <li><a style="font-size: 14px;"><i class="fa fa-clock-o"></i>{{ question.created_at|questionFormatDate }} </a></li>
                              <li><a class="text-dark"><i class="fa fa-plus-circle"></i><b class="text-primary">{{ question.up_vote }}</b></a></li>
                              <li><a class="text-dark"><i class="fa fa-minus-circle"></i><b class="text-danger">{{ question.down_vote }}</b></a></li>
                              <li><a><i class="fa fa-eye"></i> {{ question.total_view }}</a></li>
                              <li class="row">
                                <router-link class="text-dark" :to="`/update-question/${question.id}`">
                                  <i class="fa fa-edit"></i>
                                </router-link> 
                                <a class="pl-2">
                                  <DeleteModal v-on:setConfirmation="delete_question" :id="question.id"/>                           
                                </a> 
                              </li>        
                            </ul>
                          </div> 
                        </div>                             
                      </div>
                    </div>
                  </div>
                </div>


                <!-- My Answer -->
                <div v-else-if="content_type=='my_answers'">   
                  <div class="forum-questions mb-2 px-1 py-3" v-for="answer in answers.data" v-bind:key="answer.id">           
                    <div class="row">                      
                      <div class="col-2 pr-0">
                        <div class="usr_img">
                          <router-link :to="`/user-profile/${user.id}`">
                            <img v-if="user.profile_picture" class="rounded-circle"  v-bind:src="'/storage/uploads/'+user.id+'/Users/'+user.profile_picture" > 
                            <img v-else  class="rounded-circle" v-bind:src="'/Images/profile/profile_logo.png'">
                          </router-link>                                
                        </div>
                        <div class="float-left">
                          <router-link :to="`/user-profile/${user.id}`">
                            <p style="font-size: 10px;">{{user.name}}</p>
                          </router-link>                                
                          <p class="com text-dark"><i class="fa fa-question-circle"></i> {{user.total_questions}}</p>
                          <p class="com text-dark"><i class="fa fa-check-circle"></i> {{user.total_answers}}</p>
                          <p class="com text-dark"><i class="fa fa-star"></i> {{user.total_score}}</p>
                        </div>
                      </div>
                      <div class="col-10 pl-0">
                        <div>
                          <router-link :to="`/question-details/${answer.question_id}`">
                            <p class="h6 text-justify font-weight-bold text-primary" v-html=" answer.title"></p>
                          </router-link>
                          <p class="text-justify pb-2" v-html="answer.answer"></p>
                        </div> 
                        <div class="row border-bottom">
                          <ul class="quest-tags my-3" v-if="answer.is_accepted > 0">
                            <span class="badge badge-success">Accepted</span>
                          </ul>
                        </div>                           
                        <div class="row pt-2">  
                          <div class="col px-0">
                            <ul class="react-links">
                              <li><a style="font-size: 14px;"><i class="fa fa-clock-o"></i>{{ answer.created_at|questionFormatDate }} </a></li>
                              <li><a class="com text-dark"><i class="fa fa-plus-circle"></i><b class="text-primary">{{ answer.up_vote }}</b></a></li>
                              <li><a class="com text-dark"><i class="fa fa-minus-circle"></i><b class="text-danger">{{ answer.down_vote }}</b></a></li>
                              <li class="row">
                                <router-link class="com text-dark" :to="`/update-answer/${answer.id}`">
                                  <i class="fa fa-edit"></i>
                                </router-link> 
                                <a class="pl-3">
                                  <DeleteModal v-on:setConfirmation="delete_answer" :id="answer.id"/>                           
                                </a> 
                              </li>
                            </ul> 
                          </div>                                       
                        </div>                                                         
                      </div>
                    </div>
                  </div>
                </div>


                <!-- Question Listing -->
                <div v-else>                 
                  <div class="forum-questions mb-2 px-1 py-3" v-for="question in questions" v-bind:key="question.id">              
                    <div class="row">                     
                      <div class="col-2 pr-0">
                        <div class="usr_img">
                          <router-link :to="`/user-profile/${question.user.id}`">
                            <img v-if="question.user.profile_picture" class="rounded-circle"  v-bind:src="'/storage/uploads/'+question.user.id+'/Users/'+question.user.profile_picture" > 
                            <img v-else  class="rounded-circle" v-bind:src="'/Images/profile/profile_logo.png'">
                          </router-link>                                
                        </div>
                        <div class="float-left" >
                          <router-link :to="`/user-profile/${question.user.id}`">
                            <p style="font-size: 10px;">{{ question.user.name }}</p>
                          </router-link>                                  
                          <p class="com text-dark"><i class="fa fa-question-circle"></i> {{ question.user.total_questions }}</p>
                          <p class="com text-dark"><i class="fa fa-check-circle"></i> {{ question.user.total_answers }}</p>
                          <p class="com text-dark"><i class="fa fa-star"></i> {{ question.user.total_score }}</p>
                        </div>
                      </div>
                      <div class="col-10 pl-0">
                        <div>
                          <router-link :to="`/question-details/${question.id}`">
                            <p class="h6 text-justify font-weight-bold text-primary"> {{ question.title}}</p>
                          </router-link>
                          <p class="text-justify card-text" v-html="question.details"></p>
                        </div>                              
                        <div class="row border-bottom">
                          <ul class="quest-tags my-3">
                            <span class="badge badge-primary">{{ question.question_category.title }}</span>
                            <router-link :to="`/question-details/${question.id}`">
                              <span class="badge badge-success">{{ question.total_answer }} Answers</span>
                            </router-link>
                          </ul>
                        </div>
                        <div class="row pt-2">                                  
                          <div class="col px-0">
                            <ul class="react-links">
                              <li><a style="font-size: 13px;"><i class="fa fa-clock-o"></i>{{ question.created_at| questionFormatDate }}</a></li>
                              <li><a href="javascript:void(0);" class="com text-dark" @click="give_up_vote(question)"><i class="fa fa-plus-circle"></i><b class="text-primary">{{ question.up_vote }}</b></a></li>
                              <li><a href="javascript:void(0);" class="com text-dark" @click="give_down_vote(question)"><i class="fa fa-minus-circle"></i><b class="text-danger">{{ question.down_vote }}</b></a></li>
                              <li><a class="com text-dark"><i class="fa fa-eye"></i> {{ question.total_view }}</a></li>
                              <li class="row" v-if="question.created_by == loggedInId">
                                <router-link class="com text-dark" :to="`/update-question/${question.id}`">
                                  <i class="fa fa-edit"></i>
                                </router-link> 
                                <a class="pl-2">
                                  <DeleteModal v-on:setConfirmation="delete_question" :id="question.id"/>                           
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
              <div class="col-lg-3 pr-0">
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
import ForumTopbar from '@/components/user/Forum/ForumTopbar';
import PopularQuestion from '@/components/user/Forum/PopularQuestion';
import ForumLeftSidebar from '@/components/user/Forum/ForumLeftSidebar';
import DeleteModal from '@/components/DeleteModal';
import ScriptLoader from '@/mixins/ScriptLoader';

export default {
  name: 'Questions',
  mixins: [ScriptLoader],
  data () {
    return {    
      questions: {},
      shouldShowLoader: false,
      question_id:"",
      userId: 0,
      loggedInId: "",
      categoryId: 0,
      answers: "",
      page: "1",
      limit: "10",
      content_type: 'questions',
      user: JSON.parse(localStorage.getItem('TTNetwork.user')),
    }
  },

  components: {
    Header,
    Footer,
    Loader,
    ForumTopbar,
    PopularQuestion,
    ForumLeftSidebar,
    DeleteModal,
  },

  mounted() {
    this.loadStyleSheets("user");
    this.loadJsScripts("user");
    this.get_questions();
    this.get_my_answers();
    this.loggedInId = JSON.parse(localStorage.getItem('TTNetwork.user')).id;
  },

  methods: {
    get_questions(){
      this.shouldShowLoader = true;
      if(this.content_type == 'questions'){
        this.userId = 0;
      } else if(this.content_type == 'my_questions') {
       this.userId = this.loggedInId;
      }
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
      axios({ method: "GET", url: "/api/get-questions/"+this.userId+"/"+this.categoryId+"/"+this.limit+"/"+this.page}).then(
      result => {                    
          this.questions  = result.data.questions.data;
          console.log(this.questions);    
          this.shouldShowLoader = false;                                  
      error => {
      console.error(error);
      }
      });       
    },

    get_my_answers(){
      if(this.content_type == 'my_answers'){
        this.shouldShowLoader = true;
        this.userId = this.loggedInId;
        axios.defaults.headers.common["Authorization"] = "Bearer " + localStorage.getItem("TTNetwork.jwt");
        axios.post("/api/get-my-answers", {
          userId: this.userId,
          categoryId: this.categoryId,
          page: "1",
          limit: "10"
        })
        .then(result => {
          this.shouldShowLoader = false;
          this.answers  = result.data;                 
        });
      }
    },

    get_content_type(contentType){
      this.content_type = contentType;
      if(this.content_type=='my_questions' || this.content_type=='questions'){
        this.get_questions();
      }
      this.get_my_answers();
    },

    get_category_id(categoryId){
      this.categoryId = categoryId;
      if(this.content_type=='my_questions' || this.content_type=='questions'){
        this.get_questions();
      }
      this.get_my_answers();
    },

    give_up_vote(question){
      var userId = JSON.parse(localStorage.getItem('TTNetwork.user')).id;
      if(userId == question.created_by){
        toast.fire({
          icon: "info",
          title: "You can not vote yourself!"
        });
      } else {
        axios.get(`/api/up-vote/${question.id}/${userId}/questions`).then(result => {
          if(result.data.response == "success"){
            question.up_vote++;
            for(let i = 0; i <this.questions.length; i++){
              if(this.questions[i].user.id == question.user.id){
                this.questions[i].user.total_score+=10;
              }
            }
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

    give_down_vote(question){
      var userId = JSON.parse(localStorage.getItem('TTNetwork.user')).id;
      if(userId == question.created_by){
        toast.fire({
          icon: "info",
          title: "You can not vote yourself!"
        });
      } else {
        axios.get(`/api/down-vote/${question.id}/${userId}/questions`).then(result => {
          if(result.data.response == "success"){
            question.down_vote++;
            for(let i = 0; i <this.questions.length; i++){
              if(this.questions[i].user.id == question.user.id){
                this.questions[i].user.total_score-=5;
              }
            }
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
          this.get_questions();
          // this.questions.slice(id,1);
          // Vue.delete(this.questions, id);

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
    //// Answer Part //////
    delete_answer(id) {
      axios.delete(`/api/delete-answer/${id}`)
        .then(res => {
          this.get_my_answers();
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
  
</style>