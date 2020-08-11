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
                      <h6 class="m-0 font-weight-bold text-primary float-left">{{ question.title }}</h6>
                    </div>
                    <div class="col-2">
                      <router-link class="collapse-item float-right" to="/controller-questions"><button class="btn btn-sm btn-primary">Back</button></router-link>
                    </div>
                  </div>
                </div>

                <div class="card-body">
                  <!-- <pagination :data="policyDetails" @pagination-change-page="getData"></pagination> -->
                  <table class="table">
                    <thead>
                      <tr>
                        <th style="width: 40%;"><b>Answer</b></th>
                        <th style="width: 15%;"><b>Is accepted</b></th>
                        <th style="width: 20%;"><b>Answered by</b></th>
                        <th style="width: 10%;"><b>Status</b></th>
                        <th style="width: 25%;"><b>Action</b></th>
                      </tr>
                    </thead>

                    <tbody>
                      <tr v-for="data in answers" v-bind:key="data.id">
                          <router-link  class="text-decoration-none" :to="`/controller-answer-details/${data.id}`">
                          <td v-html="data.answer" class="text-primary font-weight-bold"></td>
                        </router-link>                        
                        <td>
                            <span v-if="data.is_accepted == 0">Not accepted</span>
                            <span v-else>Accepted</span>
                        </td>
                        <td>{{data.user.name}}</td>
                        <td>
                            <span v-if="data.status == 10" class="badge badge-success">Published</span>
                            <span v-else-if="data.status == 20" class="badge badge-danger">Unpublished</span>
                            <span v-else-if="data.status == 30" class="badge badge-danger">Flagged</span>
                            <span v-else class="badge badge-danger">Draft</span>
                        </td>
                        <td>
                          <router-link :to="`/controller-update-answer/${data.id}`" class="com text-dark">
                            <i class="fa fa-edit"></i>
                          </router-link>
                          <button class="btn pt-0">
                            <DeleteModal v-on:setConfirmation="delete_data" :id="data.id"/>                           
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
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
  name: 'ControllerQuestionAndAnswer',
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
      answers: {},
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
      axios({ method: "GET", url: "/api/question-with-answer/" + question_id }).then(
        response => {
          console.log(response.data);
          this.question = response.data.question;
          this.answers = response.data.answers;
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
    },
  }
};
</script>

<style lang="scss" scoped></style>
