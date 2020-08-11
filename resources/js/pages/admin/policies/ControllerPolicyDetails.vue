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
                          <p class="text-center h3 text-primary font-weight-bold">{{ policy.title }}</p>
                      </div>
                      <div class="col-2">
                        <router-link class="collapse-item float-right" to="/controller-policies"><button class="btn btn-sm btn-primary">Back</button></router-link>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <table class="table">
                      <thead>
                        <tr>
                          <th style="width: 35%;"><b>Section name</b></th>
                          <th style="width: 40%;"><b>Description</b></th>
                          <th style="width: 10%;"><b>Status</b></th>
                          <th style="width: 15%;"><b>Action</b></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="detail in policy.policy_details" v-bind:key="detail.id">
                          <td>
                            <p class="text-primary font-weight-bold text-decoration-none">{{ detail.section_name }}</p>
                          </td>
                          <td v-html="detail.details"></td>
                          <td>
                            <span v-if="detail.status == 10" class="badge badge-success">Published</span>
                            <span v-else-if="detail.status == 20" class="badge badge-danger">Unpublished</span>
                            <span v-else class="badge badge-danger">Draft</span>
                          </td>
                          <td>
                            <router-link class="text-dark" :to="`/controller-edit-policy-details/${detail.id}`">
                              <i class="fa fa-edit"></i>
                            </router-link>
                            <button class="btn pt-0">
                              <DeleteModal v-on:setConfirmation="delete_data" :id="detail.id"/>                           
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
  name: 'ControllerPolicyDetails',
  mixins: [ScriptLoader],
  components: {
    HeaderBar,
    LeftSidebar,
    FooterBar,
    DeleteModal
  },

  data() {
    return {
      policy: {},
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
      let policy_id = window.location.href.split('/').pop();
      axios({ method: "GET", url: "/api/policy-details-index/" + policy_id }).then(
        response => {
          this.policy = response.data.policy;
        },
        error => {
          console.error(error);
        }
      );
      this.$Progress.finish();
    },

    delete_data(id) {
      axios.delete(`/api/policy-details/${id}`)
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
