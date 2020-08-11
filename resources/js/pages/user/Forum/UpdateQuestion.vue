<template>
  <div>
    <div class="wrapper">
      <Header />
      <section class="profile-account-setting">
        <div class="container px-0">
          <div class="account-tabs-setting">
            <div class="row">

              <div class="col-lg-3 px-0">
                <p>Here will be...</p>
              </div>

              <div class="col-lg-6 px-0">
                <section class="forum-page">
                  <div class="container">
                    <div class="forum-questions-sec">
                      <div class="row">
                        <div class="widget widget-user">
                          <div class="border-bottom p-3">
                            <h3 class="font-weight-bold text-center pt-3">Update question</h3>
                          </div>
                          <ul>
                            <li>
                              <div class="usr-msg-details">
                                <form @submit.prevent="update_question">
                                  <div class="form-group">
                                    <label class="cat font-weight-bold mb-2">Select Question Category</label>
                                    <select class="form-control" v-model="question_category_id" required >
                                      <option value>Select Category</option>
                                      <option
                                        v-for="(category, index) in questionCategories" :key="category" :value="index">
                                        {{ category }}
                                      </option>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label class="title font-weight-bold mb-2">Title</label>
                                    <input name="title" type="text" v-model="title" class="form-control" placeholder required />
                                  </div>
                                  <div>
                                    <label class="desc font-weight-bold mb-2">Body</label>
                                    <input type="text" class="form-control" id="summernote_div" v-model="details">
                                  </div>
                                  <div class="form-group">
                                    <label class="status font-weight-bold my-2">Status</label>
                                    <select class="form-control" v-model="status" required>
                                      <option v-for="(status, index) in statuses" :key="status" :value="index">
                                        {{ status }}
                                      </option>
                                    </select>
                                  </div>
                                  <div>
                                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                  </div>
                                </form>
                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
              </div>

              <div class="col-lg-3 px-0">
                <PopularQuestion />
              </div>

            </div>
          </div>
        </div>
      </section>
    </div>
    <Footer />
  </div>
</template>

<script>
import Header from "@/components/user/Header";
import Footer from "@/components/user/Footer";
import PopularQuestion from '@/components/user/Forum/PopularQuestion';
import ScriptLoader from '@/mixins/ScriptLoader';

export default {
  name: 'UpdateQuestion',
	mixins: [ScriptLoader],
  data() {
    return {
      title: "",
      details: "",
      status: "",
      statuses: {},
      question_category_id: "",
      questionCategories: {},
    };
  },

  components: {
    Header,
    Footer,
    PopularQuestion
  },

  mounted() {
    this.loadStyleSheets("user_summernote");
    this.loadJsScripts("user_summernote");
    this.init();
    this.get_data();
  },

  methods: {
    get_data() {
      this.$Progress.start();
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')
      let question_id = window.location.href.split('/').pop();
      axios({ method: "GET", url: "/api/questions/" + question_id }).then(
        response => {
          let question = response.data.question;
          this.questionCategories = response.data.questionCategories;
          this.statuses = response.data.statuses;
          this.question_category_id = question.question_category_id;
          this.title = question.title;
          this.details = question.details;
          console.log(this.details);
          this.status = question.status;
        },
        error => {
          console.error(error);
        }
      );
      this.$Progress.finish();
    },

    init(){
      var vueData = this;
      $(document).ready(() => {
        $('#summernote_div').on('summernote.change', function(we, contents, $editable) {
            vueData.details = contents;
            // console.log(vueData.details);
        });
      });
    },
    
    update_question(){
      let question_id = window.location.href.split('/').pop();
      axios.put(`/api/questions/${question_id}`, {
        title: this.title,
        details: this.details,
        category: this.question_category_id,
        status: this.status,
      })
      .then(result => {
        if(result.data.response == "success"){
          toast.fire({
            icon: "info",
            title: result.data.message,
          });
        }
        toast.fire({
          icon: "info",
          title: "Update is not successfull",
        });
          this.title = "";
          this.details = "";
          this.status = "";
          this.$router.go(-1);
        })
    },
  }
};
</script>




