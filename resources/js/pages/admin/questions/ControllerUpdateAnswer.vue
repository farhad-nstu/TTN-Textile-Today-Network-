<template>
  <div>
    <LeftSidebar/>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <HeaderBar/>
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card shadow mb-4">

                <div class="card-header py-3">
                  <h3 class="m-0 font-weight-bold text-primary text-center">Update Answer</h3>
                </div>
                <div class="card-body">
                  <form @submit.prevent="update">
                    <div class="form-group">
                      <label class="req">Answer</label>
                      <input type="text" class="form-control" id="summernote_div" v-model="answer">
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
export default {
  name: 'ControllerUpdateAnswer',
  mixins: [ScriptLoader],
  components: {
    HeaderBar,
    LeftSidebar,
    FooterBar,
  },
  data() {
    return {
      question_id: "",
      answer: "",
      statuses: {},
      status: "",
    };
  },

  mounted() {
    this.loadStyleSheets("controller_summernote");
    this.loadJsScripts("controller_summernote");
    this.init();
    this.getData();
  },

  methods: {
    getData() {
      this.$Progress.start();
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')
      let answer_id = window.location.href.split('/').pop();
      axios({ method: "GET", url: "/api/get-answer/" + answer_id }).then(
        response => {
          let answer = response.data.answer;
          this.statuses = response.data.statuses;
          this.question_id = answer.question_id;
          this.answer = answer.answer;
          $("#summernote_div").summernote("code", this.answer);
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
        });
      });
    },

    update() {
      let answer_id = window.location.href.split('/').pop();
      axios.put(`/api/update-answer/${answer_id}`, {
        question_id: this.question_id,
        answer: this.answer,
        status: this.status,
      })
      .then(res => {
        this.question_id = "";
        this.answer = "";
        this.status = "";
        this.$router.go(-1);
      })
      .catch(err => {
        console.log(err);
      });
    },    
  }
};
</script>

<style lang="scss" scoped></style>
