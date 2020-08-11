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
                  <div class="row">
                    <div class="col-10">
                        <p class="text-center h5 text-primary font-weight-bold">Questions</p>
                    </div>
                    <div class="col-2">
                      <router-link class="collapse-item float-right" to="/controller-add-question"><button class="btn btn-sm btn-primary">Add Question</button></router-link>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th style="width: 40%;"><b>Title</b></th>
                        <th style="width: 5%;"><b>Category</b></th>
                        <th style="width: 15%;"><b>Asked by</b></th>
                        <th style="width: 5%;"><b>Status</b></th>
                        <th style="width: 35%;"><b>Action</b></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="question in questions.data" v-bind:key="question.id">
                        <td>
                          <router-link :to="`/controller-question-details/${question.id}`">
                            <p class="text-primary font-weight-bold text-decoration-none"> {{ question.title}}</p>
                          </router-link>
                        </td>
                        <td>{{ question.question_category.title }}</td>
                        <td>{{ question.user.name }}</td>
                        <td>
                          <span v-if="question.status == 10" class="badge badge-success">Published</span>
                          <span v-else-if="question.status == 20" class="badge badge-danger">Unpublished</span>
                          <span v-else-if="question.status == 30" class="badge badge-danger">Flagged</span>
                          <span v-else class="badge badge-danger">Draft</span>
                        </td>
                        <td>                          
                          <router-link :to="`/controller-update-question/${question.id}`" class="com text-dark">
                            <i class="fa fa-edit"></i>
                          </router-link>                          
                          <button class="btn pt-0">
                            <DeleteModal v-on:setConfirmation="delete_data" :id="question.id"/>                           
                          </button>                         
                          <router-link :to="`/controller-question-details/${question.id}`" class="com text-dark pr-2">
                            <i class="fa fa-eye"></i>
                          </router-link> 
                          <router-link :to="`/controller-question-with-answer/${question.id}`" class="btn btn-primary btn-sm">
                            Answers
                          </router-link>                         
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <pagination :data="questions" @pagination-change-page="getData"></pagination>
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
import DeleteModal from '@/components/DeleteModal';
import ScriptLoader from '@/mixins/ScriptLoader';

export default {
  name: 'ControllerQuestions',
  mixins: [ScriptLoader],
  components: {
    HeaderBar,
    LeftSidebar,
    FooterBar,
    DeleteModal,
  },
  data() {
    return {
      questions: {},
    };
  },

  mounted() {
    this.loadStyleSheets("controller");
    this.loadJsScripts("controller");
    this.getData();
  },

  methods: {
    getData(page = 1) {
      this.$Progress.start();
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')     
      axios({ method: "GET", url: "/api/question-index?page=" + page }).then(
        response => {
          this.questions = response.data.questions;
          console.log(this.questions);
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
            this.getData();
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
