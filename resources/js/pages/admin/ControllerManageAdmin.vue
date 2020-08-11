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
            <h6 class="m-0 font-weight-bold text-primary float-left">Admin List</h6>
          </div>

          <div class="card-body">

            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Status</th>
                  <th scope="col">Options</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="admin in admins" v-bind:key="admin.id">
                  <td>{{ admin.name }}</td>
                  <td>{{ admin.email }}</td>
                  <td>
                    <span class="badge badge-danger" v-if="admin.status == 0">Disabled</span>
                    <span class="badge badge-warning" v-else-if="admin.status == 30">Verified</span class="badge badge-success">
                    <span class="badge badge-success" v-else-if="admin.status == 10">Active</span class="badge badge-primary">
                    <span class="badge badge-light" v-else>Not verified</span class="badge badge-primary">
                  </td>
                  <td>
                    <button v-if="admin.status == 30"  @click="verify(admin.id)" class="btn btn-success btn-sm">
                      Approve
                    </button>
                    <button v-else @click="disapprove(admin.id)" class="btn btn-danger btn-sm">
                      Disprove
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

export default {
  name: 'ControllerManageAdmin',
  components: {
      HeaderBar,
      LeftSidebar,
      FooterBar
  },
  data() {
    return {
      admins: {},
      id: "",
      status: ""
    };
  },

  mounted() {
    this.getData();
  },

  methods: {
    getData(page = 1) {
      this.$Progress.start();
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')
      axios({ method: "GET", url: "/api/admin-list" }).then(
        result => {
          console.log(result.data);
          this.admins = result.data.admins;
        },
        error => {
          console.error(error);
        }
      );
      this.$Progress.finish();
    },

    verify(id) {
      if (confirm("Are You Sure?")) {
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')
        axios
          .put(`/api/admin-verify/${id}`)
          .then(res => {
            this.getData();
            toast.fire({
              icon: "info",
              title: "Verified!"
            });
          })
          .catch(err => {
            console.log(err);
          });
      }
    },

    disapprove(id) {
      if (confirm("Are You Sure?")) {
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')
        axios
          .put(`/api/admin-disapprove/${id}`)
          .then(res => {
            this.getData();
            toast.fire({
              icon: "info",
              title: "Disapproved!"
            });
          })
          .catch(err => {
            console.log(err);
          });
      }
    }
  }
};
</script>

<style lang="scss" scoped></style>
