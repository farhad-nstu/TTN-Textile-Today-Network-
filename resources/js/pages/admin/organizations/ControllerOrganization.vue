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
                        <p class="text-center h3 text-primary font-weight-bold">Organizations</p>
                    </div>
                    <div class="col-2">
                      <router-link class="collapse-item float-right" to="/controller-add-organization"><button class="btn btn-sm btn-primary">Add new</button></router-link>
                    </div>
                  </div>
                </div>

                <div class="card-body">                 
                  <table class="table">
                    <thead>
                      <tr>
                        <th width="30%">Name</th>
                        <th width="20%">Email</th>
                        <th width="25%">Phone</th>
                        <th width="5%">Status</th>
                        <th width="20%">Options</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="organization in organizations.data" v-bind:key="organization.id">
                        <router-link :to="`/controller-organization-details/${organization.id}`">
                          {{ organization.name }}
                        </router-link>
                        <td>{{ organization.email }}</td>
                        <td>{{ organization.phone }}</td>
                        <td>
                          <span v-if="organization.status == 10" class="badge badge-success">Active</span>
                          <span v-else class="badge badge-danger">Inactive</span>
                        </td>
                        <td>
                          <router-link :to="`/controller-update-organization/${organization.id}`" class="btn">
                            <i class="fa fa-edit"></i>
                          </router-link>
                          <button class="btn">
                            <DeleteModal v-on:setConfirmation="delete_data" :id="organization.id"/>                           
                          </button>
                          <router-link :to="`/controller-organization-details/${organization.id}`" class="btn">
                            <i class="fa fa-eye"></i>
                          </router-link>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <pagination :data="organizations" @pagination-change-page="get_data"></pagination>
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
  name: 'ControllerOrganization',
  mixins: [ScriptLoader],
  components: {
    HeaderBar,
    LeftSidebar,
    FooterBar,
    DeleteModal,
  },
  data() {
    return {
      organizations: {},
    };
  },

  mounted() {
    this.loadStyleSheets("controller");
    this.loadJsScripts("controller");
    this.get_data();
  },

  methods: {
    takeImage(event) {
      let file = event.target.files[0];
      let reader = new FileReader();
      reader.onload = event => {
        this.company_logo = event.target.result;
        console.log(event.target.result);
      };
      reader.readAsDataURL(file);
    },

    get_data(page = 1) {
      this.$Progress.start();
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')     
      axios({ method: "GET", url: "/api/organizations?page=" + page }).then(
        result => {
          this.organizations = result.data.organizations;
        },
        error => {
          console.error(error);
        }
      );
      this.$Progress.finish();
    },

    delete_data(id) {
      axios.delete(`/api/organizations/${id}`)
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
