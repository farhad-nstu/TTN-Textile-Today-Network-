<template>
  <div>
    <LeftSidebar/>
    <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <HeaderBar/>
                <div class="container-fluid" >                
                    <div class="row">
                      <div class="col-md-7">
                        <div class="card shadow mb-4">
                          <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary float-left">Profile Setting</h6>
                          </div>
                          <div class="card-body">
                             <p>Accessable Table List</p>
                            <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">Table Name</th>
                                  <th scope="col">Description</th>
                                  <th scope="col">Access</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr v-for="profile in profileSetting" v-bind:key="profile.id">
                                  <td>{{profile.table_name}}</td>
                                  <td>{{profile.description}}</td>
                                  <td>
                                    <span v-if="profile.status == 0" class="badge badge-danger">Inactive</span>
                                    <span v-else class="badge badge-success">Active</span>
                                  </td>
                                  <td v-if="edit == false">
                                    <button @click="editData(profile)" class="btn btn-primary btn-sm btn-circle">
                                      <i class="fas fa-pen"></i>
                                    </button>
                                    <button
                                      @click="deleteData(profile.id)"
                                      class="btn btn-danger btn-sm btn-circle"
                                    >
                                      <i class="fas fa-trash"></i>
                                    </button>
                                  </td>
                                  <td v-else>
                                    <button
                                      disabled
                                      @click="editData(profile)"
                                      class="btn btn-primary btn-sm btn-circle"
                                    >
                                      <i class="fas fa-pen"></i>
                                    </button>
                                    <button
                                      disabled
                                      @click="deleteData(profile.id)"
                                      class="btn btn-danger btn-sm btn-circle"
                                    >
                                      <i class="fas fa-trash"></i>
                                    </button>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="card shadow mb-4">
                          <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary float-left">Add new</h6>                            
                          </div>
                          <div class="card-body">
                            <p>Add table for user profile page</p>
                            <form @submit.prevent="addUpdate" enctype="multipart/form-data">
                              <div class="form-group">
                                <label class="req">Table Name</label>
                                <input v-model="table_name" type="text" class="form-control" placeholder="table name" required />
                              </div>
                              <div class="form-group">
                                <label class="req">Description</label>
                                <textarea   class="form-control" name="description" id="" cols="30" rows="5"  v-model="description" required> </textarea>
                              </div>
                              <div class="form-group">
                                <label class="req">Status</label>
                                <select class="form-control" v-model="status" required>
                                  <option v-for="(status, index) in profileStatus" v-bind:key="index" :value="index">{{ status }}</option>
                                </select>
                              </div>
                              <div v-if="edit == false">
                                <button type="submit" class="btn btn-success">Save</button>
                              </div>
                              <div v-else>
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button @click="clearForm()" class="btn btn-danger">Cancel</button>
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
  name: 'ControllerUserPrivacyStatus',
  mixins: [ScriptLoader],
  components: {
      HeaderBar,
      LeftSidebar,
      FooterBar
  },
  data() {
    return {
      profileSetting: {},
      profileStatus: {},
      id: "",
      table_name: "",
      description: "",
      status: "",
      edit: false
    };
  },

  mounted() {
    var page = window.location.href.split('/').pop();
    this.loadStyleSheets(page);
    this.loadJsScripts(page);
    this.getData();
  },
  methods: {
    getData() {
      this.$Progress.start();
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
      axios({ method: "GET", url: "/api/user-privacy-status" }).then(
        result => {
          console.log(result.data);
          this.profileSetting = result.data.profileSetting;
          this.profileStatus = result.data.profileStatus;
        },
        error => {
          console.error(error);
        }
      );
      this.$Progress.finish();
    },

    addUpdate() {
      if (this.edit == false) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
        axios
          .post("/api/user-privacy-status", {
            table_name: this.table_name,
            description: this.description,
            status: this.status,
          })
          .then(res => {
            this.clearForm();
            this.getData();
            toast.fire({
              icon: "success",
              title: "Saved!"
            });
          })
          .catch(er => {
            console.log(err);
          });
      } else {
        //update
       axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
        axios
          .put(`/api/user-privacy-status/${this.id}`, {
             table_name: this.table_name,
            description: this.description,
            status: this.status,
          })
          .then(res => {
            this.clearForm();
            this.getData();
            toast.fire({
              icon: "success",
              title: "Updated!"
            });
          })
          .catch(err => {
            console.log(err);
          });
      }
    },

    editData(profile) {
      this.id = profile.id;
      this.table_name = profile.table_name,
      this.description = profile.description,
      this.status = profile.status,
      this.edit = true;
    },

    deleteData(id) {
      if (confirm("Are You Sure?")) {
        axios
          .delete(`/api/user-privacy-status/${id}`)
          .then(res => {
            this.id = "";
            this.getData();
            toast.fire({
              icon: "info",
              title: "Deleted!"
            });
          })
          .catch(err => {
            console.log(err);
          });
      }
    },

    clearForm() {
      this.edit = false;
      this.id = "";
      this.table_name = "";
      this.description ="";
      this.status ="";
    }
  }
};
</script>
<style lang="scss" scoped>
</style>