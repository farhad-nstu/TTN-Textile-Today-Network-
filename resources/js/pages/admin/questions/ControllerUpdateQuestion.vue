<template>
  <div>
    <LeftSidebar/>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <HeaderBar/>
        <div class="container-fluid" >
          <div class="row">
            <div class="col-md-12">
              <div class="card shadow mb-4">
                <flash-message class="myCustomClass"></flash-message>

                <div class="card-header py-3">
                  <h3 class="m-0 font-weight-bold text-primary text-center">Update Question</h3>
                </div>
                <div class="card-body">
                  <form @submit.prevent="update_question">
                    <div class="form-group">
                      <label class="req"><b>Select Question Category</b></label>
                      <select class="form-control" v-model="question_category_id" >
                        <option value>Select Category</option>
                        <option
                          v-for="(category, index) in questionCategories" :key="category"
                          :value="index">{{ category }}
                        </option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label class="req">Title</label>
                      <input name="name" type="text" v-model="title" class="form-control" placeholder required />
                    </div>
                    <div class="form-group" style="border: 1px solid;">
                      <label class="req"> Description </label>
                      <input type="text" class="form-control" id="summernote_div" v-model="details">
                    </div>
                    <div class="form-group">
                      <label class="status">Status</label>
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

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <FooterBar/>
  </div>
</template>

<script>
import HeaderBar from '@/components/admin/HeaderBar';
import LeftSidebar from '@/components/admin/LeftSidebar';
import FooterBar from '@/components/admin/FooterBar';
import ScriptLoader from '@/mixins/ScriptLoader';
import VueFlashMessage from "vue-flash-message";
require("vue-flash-message/dist/vue-flash-message.min.css");

export default {
  name: 'ControllerUpdateQuestion',
  mixins: [ScriptLoader],
  components: {
    HeaderBar,
    LeftSidebar,
    FooterBar,
  },
  data() {
    return {
      created_by: "",
      question_category_id: "",
      title: "",
      details: "",
      status: "",
      statuses: {},
      userId: "",
      questionCategories: {},
    };
  },

  mounted() {
    this.loadStyleSheets("controller_summernote");
    this.loadJsScripts("controller_summernote");
    this.init();
    this.getData();
    this.userId = JSON.parse(localStorage.getItem('TTNetwork.user')).id;
  },

  methods: {
    getData() {
      this.$Progress.start();
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')
      let question_id = window.location.href.split('/').pop();
      axios({ method: "GET", url: "/api/question-index/" + question_id }).then(
        response => {
          let question_index = response.data.question_index;
          this.questionCategories = response.data.questionCategories;
          this.statuses = response.data.statuses;
          this.question_category_id = question_index.question_category_id;
          this.title = question_index.title;
          this.status = question_index.status;
          this.details = question_index.details;
          $("#summernote_div").summernote("code", this.details);
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
        });
      });
    },

    update_question() {
      let question_id = window.location.href.split('/').pop();
      axios.put(`/api/question-index/${question_id}`, {
        title: this.title,
        category: this.question_category_id,
        details: this.details,
        status: this.status,
      })
      .then(result => {
        if(result.data.response == "success"){
        // console.log("success");
          this.flash(result.data.message , 'success', {
            timeout: 3000,
          });
        } else {
          this.flash(result.data.message , 'warning', {
            timeout: 3000,
          });
        }
          this.title = "";
          this.details = "";
          this.status = "";
          this.$router.go(-1);
        })
    }
  },
};
</script>

<style lang="scss" scoped></style>
