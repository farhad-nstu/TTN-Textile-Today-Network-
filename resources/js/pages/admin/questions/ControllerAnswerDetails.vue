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
                    <!-- <h6 class="m-0 font-weight-bold text-primary float-left">{{ answer.title }}</h6> -->
                  </div>

                  <div class="card-body">
                    <p><b>Question</b>: {{ answer.question.title }}</p>
                    <label><b>Answer</b>: </label>
                    <p v-html="answer.answer"></p>
                    <p><b>Answered by</b>: {{ answer.user.name }}</p>
                    <p><b>Is accepted</b>: 
                      <span v-if="answer.is_accepted == 0">Not accepted</span>
                      <span v-else>Accepted</span>
                    </p>
                    <p><b>Up vote</b>: {{ answer.up_vote}}</p>
                    <p><b>Down vote</b>: {{ answer.down_vote}}</p>
                    <p><b>Creation time</b>: {{ answer.created_at }}</p>
                    <p>
                      <label>Status: </label>
                      <span v-if="answer.status == 10" class="badge badge-success">Published</span>
                      <span v-else-if="answer.status == 20" class="badge badge-danger">Unpublished</span>
                      <span v-else-if="answer.status == 30" class="badge badge-danger">Flagged</span>
                      <span v-else class="badge badge-danger">Draft</span>
                    </p>
                    
                    <br>
                    <h3>Actions</h3><br>
                    <router-link :to="`/controller-update-answer/${answer.id}`" class="com text-dark"><i class="fa fa-edit"></i>
                    </router-link>
                    <button class="btn pt-0">
                      <DeleteModal v-on:setConfirmation="delete_data" :id="answer.id"/>                           
                    </button>
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
  name: 'ControllerAnswerDetails',
  mixins: [ScriptLoader],
  components: {
      HeaderBar,
      LeftSidebar,
      FooterBar,
      DeleteModal,
  },
  data() {
    return {
      answer: {},
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
      let answer_id = window.location.href.split('/').pop();
      axios({ method: "GET", url: "/api/answer-details/" + answer_id }).then(
        response => {
          this.answer = response.data.answer;
        },
        error => {
          console.error(error);
        }
      );
      this.$Progress.finish();
    },

    delete_data(id) {
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

<style lang="scss" scoped></style>
