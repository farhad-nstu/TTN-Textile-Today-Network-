<template>
  <div>
    <div class="wrapper">
      <Header />
      <section class="profile-account-setting">
        <div class="container px-0">
          <div class="account-tabs-setting">
            <div class="row">
              
              <div class="col-lg-3 px-0">
                <p>Here will...</p>
              </div>

              <div class="col-lg-6 px-0">
                <section class="forum-page">
                  <div class="container">
                    <div class="forum-questions-sec">
                      <div class="row">
                        <div class="widget widget-user">
                          <div class="border-bottom p-3">
                            <h3 class="font-weight-bold text-center pt-3">Ask a question</h3>
                            <!-- <h3 class="title-wd" style="background-color: lightblue; color: green; font-size: 30px;">Ask a question</h3> -->
                          </div>
                          <ul>
                            <li>
                              <div class="usr-msg-details">
                                <form @submit.prevent="add_question">
                                  <div class="form-group">
                                    <label class="cat font-weight-bold">Select Question Category</label>
                                    <p class="mb-1">Add a category what your question is about</p>
                                    <select class="form-control" v-model="question_category_id" required >
                                      <option value>Select Category</option>
                                      <option
                                        v-for="(category, index) in categories" :key="category" :value="index">
                                        {{ category }}
                                      </option>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label class="title font-weight-bold">Title</label>
                                    <p class="mb-1">Be specific and imagine you’re asking a question to another person</p>
                                    <input name="title" type="text" v-model="title" class="form-control" placeholder required />
                                  </div>
                                  <div class="mb-3">
                                    <label class="desc font-weight-bold">Body</label>
                                    <p class="mb-1">Include all the information someone would need to answer your question</p>
                                    <input type="text" class="form-control" id="summernote_div" v-model="details"  style="word-wrap: break-word;">
                                  </div>
                                  <div class="form-group">
                                    <label class="status font-weight-bold">Status</label>
                                    <p class="mb-1">Add your question status</p>
                                    <select class="form-control" v-model="status" required>
                                      <option v-for="(status, index) in statuses" :key="status" :value="index">
                                        {{ status }}
                                      </option>
                                    </select>
                                  </div>
                                  <div>
                                    <button type="submit" class="btn btn-sm btn-primary">Post your question</button>
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
  mixins: [ScriptLoader],
  data() {
    return {
      questions: {},
      title: "",
      details: "",
      status: "",
      statuses: {},
      question_category_id: "",
      categories: {},
    };
  },

  components: {
    Header,
    Footer,
    PopularQuestion,
  },

  mounted() {
    this.loadStyleSheets("user_summernote");
    this.loadJsScripts("user_summernote");
    this.init();
    this.getData();
  },

  methods: {
    getData() {
      this.$Progress.start();
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')
      axios({ method: "GET", url: "/api/questions"}).then(
        response => {
          this.categories = response.data.questionCategories;
          this.statuses = response.data.statuses;
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
            console.log(vueData.details);
        });
      });
    },
    
    add_question() {
      axios.post("/api/questions", {
        created_by: JSON.parse(localStorage.getItem("TTNetwork.user")).id,
        question_category_id: this.question_category_id,
        title: this.title,
        details: this.details,
        status: this.status
      })
      .then(result => {
        if(result.data.response == "success"){
          toast.fire({
            icon: "info",
            title: "Question added successfully",
          });
        }
        toast.fire({
          icon: "info",
          title: "Error found in question adding",
        });
        this.$router.go(-1);       
      });
    },
  }
};
</script>




