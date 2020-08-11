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
                  <p class="text-center h3 text-primary font-weight-bold">New Question</p>
                  <!-- <h6 class="m-0 font-weight-bold text-primary float-left">New Policy</h6> -->
                </div>
                <div class="card-body">
                  <form @submit.prevent="add_question">
                    <div class="form-group">
                        <label class="req"><b>Select Question Category</b></label>
                        <select class="form-control" v-model="question_category_id" required >
                        <option value>Select Category</option>
                        <option
													v-for="(category, index) in categories" :key="category"
													:value="index">{{ category }}
												</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="req"><b>Your Question</b></label>
                        <input name="title" type="text" v-model="title" class="form-control" placeholder required />
                    </div>
                    <div>
                        <label class="req"><b>Description</b></label>
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
                      <button type="submit" class="btn btn-sm btn-success">Save</button>
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
import VueFlashMessage from 'vue-flash-message';
require('vue-flash-message/dist/vue-flash-message.min.css');

export default {
  name: 'ControllerAddQuestion',
  mixins: [ScriptLoader],
  components: {
    HeaderBar,
    LeftSidebar,
    FooterBar
  },

  data() {
    return {
      title: "",
      image: "",
      details: "",
      status: "10",
      statuses: {},
      question_category_id: "",
      categories: {},
    };
  },

  mounted() {
    this.loadStyleSheets("controller_summernote");
    this.loadJsScripts("controller_summernote");
    this.init();
    this.get_data();
  },  
  

  methods: {
    get_data() {
      this.$Progress.start();
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')
      axios({ method: "GET", url: "/api/questions"}).then(
        response => {
						this.categories = response.data.questionCategories;
						// console.log(this.categories);
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
        });
      });
    },

    add_question() {
      console.log(this.details);
      axios.post("/api/question-index", {
        created_by: JSON.parse(localStorage.getItem("TTNetwork.user")).id,
        question_category_id: this.question_category_id,
        title: this.title,
        details: this.details,
        status: this.status
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
        this.created_by = "";
        this.question_category_id = "";
        this.title = "";
        this.details = "";
        this.status = "";
        this.$router.go(-1);
        // this.flash('Question added successfully!', 'success', {
        //   timeout: 2000,
        // });
      });
    } 
  },
};
</script>

<style lang="scss" scoped></style>
