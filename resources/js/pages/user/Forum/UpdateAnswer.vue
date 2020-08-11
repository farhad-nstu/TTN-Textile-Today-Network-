<template>
  <div>
    <div class="wrapper">
      <Header />
      <section class="profile-account-setting">
        <div class="container px-0">
          <div class="account-tabs-setting">
            <div class="row">

              <div class="col px-0">
                <p>Here will...</p>
              </div>

              <div class="col-lg-6 px-0">
                <section class="forum-page">
                  <div class="container">
                    <div class="forum-questions-sec">
                      <div class="row">
                        <div class="widget widget-user">
                          <div class="border-bottom p-3">
                            <h3 class="font-weight-bold text-center pt-3">Update answer</h3>
                          </div>
                          <ul>
                            <li>
                              <div class="usr-msg-details">
                                <form @submit.prevent="update_my_answer">
                                  <div>
                                    <label class="cat font-weight-bold mb-2">Title</label>
                                    <input type="text" class="form-control" id="summernote_div" v-model="answer">
                                  </div>
                                  <div class="form-group">
                                    <label class="cat font-weight-bold my-2">Status</label>
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
	name: 'UpdateAnswer',
	mixins: [ScriptLoader],
  data() {
    return {
      answer: "",
      status: "",
      statuses: {},
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
		this.get_my_answer();
  },

  methods: {
    get_my_answer() {
      this.$Progress.start();
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')
      let answerId = window.location.href.split('/').pop();
      axios({ method: "GET", url: "/api/get-my-answer/" + answerId }).then(
        response => {
          let answer = response.data.answer;
          this.statuses = response.data.statuses;
					this.answer = answer.answer;
					this.status = answer.status;
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
            vueData.answer = contents;
            // console.log(vueData.details);
        });
      });
    },
    
    update_my_answer(){
      let answerId = window.location.href.split('/').pop();
      axios.put(`/api/update-my-answer/${answerId}`, {
        answer: this.answer,
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
          this.$router.go(-1);
        })
    },
  }
};
</script>




