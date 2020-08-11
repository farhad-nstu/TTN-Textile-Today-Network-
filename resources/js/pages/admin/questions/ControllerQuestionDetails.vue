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

                <div class="card-header py-3">
                  <div class="row">
                    <div class="col-10">
                        <p class="float h6 text-primary font-weight-bold">{{ question.title }}</p>
                    </div>
                    <div class="col-2">
                      <router-link class="collapse-item float-right" to="/controller-questions"><button class="btn btn-sm btn-primary">Back</button></router-link>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <p v-html="question.details"></p>                  
                  <p><b>Category</b>: <span class="badge badge-primary">{{ question.question_category.title }}</span></p>
                  <p><b>Asked by</b>: {{ question.user.name }}</p>
                  <p><b>Up vote</b>: {{ question.up_vote}}</p>
                  <p><b>Down vote</b>: {{ question.down_vote}}</p>
                  <p><b>Total views</b>: {{ question.total_view}}</p>
                  <p><b>Creation time</b>: {{ question.created_at }}</p>
                  <p>
                    <label><b>Status</b>: </label>
                    <span v-if="question.status == 10" class="badge badge-success">Published</span>
                    <span v-else-if="question.status == 20" class="badge badge-danger">Unpublished</span>
                    <span v-else-if="question.status == 30" class="badge badge-danger">Flagged</span>
                    <span v-else class="badge badge-danger">Draft</span>
                  </p><br>
                  <div>
                    <router-link :to="`/controller-update-question/${question.id}`" class="com text-dark">
                      <i class="fa fa-edit"></i>
                    </router-link> 
                    <button class="btn pt-0 pl-2">
                      <DeleteModal v-on:setConfirmation="delete_data" :id="question.id"/>                           
                    </button> 
                    <router-link :to="`/controller-question-with-answer/${question.id}`" class="btn btn-primary btn-sm">
                      Answers
                    </router-link>
                  </div>          
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
import DeleteModal from '@/components/DeleteModal';

export default {
  name: 'ControllerQuestionDetails',
  mixins: [ScriptLoader],
  components: {
    HeaderBar,
    LeftSidebar,
    FooterBar,
    DeleteModal,
  },
  data() {
    return {
      question: {},
    };
  },

  mounted() {
    this.loadStyleSheets("controller");
    this.loadJsScripts("controller");
    this.get_data();
  },

  methods: {
    get_data() {
      this.$Progress.start();
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')
      let question_id = window.location.href.split('/').pop();
      axios({ method: "GET", url: "/api/single-question/" + question_id }).then(
        response => {
          this.question = response.data.question;
        },
        error => {
          console.error(error);
        }
      );
      this.$Progress.finish();
    },

    delete_data(id) {
      axios.delete(`/api/question-index/${id}`)
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

<style lang="scss" scoped></style>
