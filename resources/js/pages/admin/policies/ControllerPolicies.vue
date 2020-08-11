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
                        <p class="text-center h3 text-primary font-weight-bold">Policies</p>
                    </div>
                    <div class="col-2">
                      <router-link class="collapse-item float-right" to="/controller-add-policy"><button class="btn btn-sm btn-primary">New Policy</button></router-link>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <table class="table table-responsive">
                    <thead>
                      <tr>
                        <th style="width: 25%;"><b>Title</b></th>
                        <th style="width: 40%;"><b>Description</b></th>
                        <th style="width: 10%;"><b>Status</b></th>
                        <th style="width: 25%;"><b>Action</b></th>
                      </tr>
                    </thead>

                    <tbody>
                      <tr v-for="policy in policies.data" v-bind:key="policy.id">
                        <td>
                          <router-link :to="`/controller-policy-details/${policy.id}`">
                            <a class="text-primary font-weight-bold">{{ policy.title}}</a>
                          </router-link>
                        </td>
                        <td v-html="policy.descr"></td>
                        <td>
                            <span v-if="policy.status == 10" class="badge badge-success">Published</span>
                            <span v-else-if="policy.status == 20" class="badge badge-danger">Unpublished</span>
                            <span v-else class="badge badge-danger">Draft</span>
                        </td>
                        <td>
                          <div class="row">
                            <div class="col">
                              <router-link  class="text-dark" :to="`/controller-update-policy/${policy.id}`">
                                <i class="fa fa-edit"></i>
                              </router-link>
                              
                              <button class="btn pt-0">
                                <DeleteModal v-on:setConfirmation="delete_data" :id="policy.id"/>                           
                              </button> 
                              <router-link class="text-dark pt-0" :to="`/controller-policy-details/${policy.id}`">
                                <i class="fa fa-eye"></i>
                              </router-link>
                              <router-link  class="text-dark pl-2" :to="`/controller-add-policy-details/${policy.id}`">
                                <i class="fa fa-plus-circle"></i>
                              </router-link> 
                            </div>
                          </div>                        
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <pagination :data="policies" @pagination-change-page="get_data"></pagination>
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
  name: 'ControllerPolicies',
  mixins: [ScriptLoader],
  components: {
    HeaderBar,
    LeftSidebar,
    FooterBar,
    DeleteModal,
  },
  data() {
    return {
      policies: {},
      id: "",
      unique_code: "",
      user_id: "",
      title: "",
      descr: "",
      applicable_from: "",
    };
  },

  mounted() {
    this.loadStyleSheets("controller");
    this.loadJsScripts("controller");
    this.get_data();
  },

  methods: {
    get_data(page = 1) {
      this.$Progress.start();
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')     
      axios({ method: "GET", url: "/api/policy-index?page=" + page }).then(
        response => {
          this.policies = response.data.policies;
        },
        error => {
          console.error(error);
        }
      );
      this.$Progress.finish();
    },

    delete_data(id) {
      axios.delete(`/api/policy-index/${id}`)
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

<style lang="scss" scoped>

</style>
