<template>
    <div>
        <LeftSidebar/>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <HeaderBar/>
                <div class="container-fluid" >
                  <div class="row">
                    <div class="col-md-6">
                      <div class="card shadow mb-4">
                        <div class="card-header py-3">
                          <h6 class="m-0 font-weight-bold text-primary float-left">General Settings</h6>
                        </div>

                        <div class="card-body">
                         <pagination :data="settings" @pagination-change-page="getData"></pagination>
                          <table class="table">
                            <thead>
                              <tr>
                                <td>Code Name</td>
                                <td>Code value</td>
                                <td>Status</td>
                                <td>Options</td>
                              </tr>
                            </thead>

                            <tbody>
                              <tr v-for="setting in settings.data" :key="setting.id">
                                <td>{{ setting.code_name }}</td>
                                <td>{{ setting.code_value }}</td>
                                <td>
                                  <span v-if="setting.status == 10" class="badge badge-success">Active</span>
                                  <span v-else class="badge badge-danger">Inactive</span>
                                </td>
                                <td v-if="edit == false">
                                  <button
                                    @click="editData(setting)"
                                    class="btn btn-primary btn-sm btn-circle"
                                  >
                                    <i class="fas fa-pen"></i>
                                  </button>
                                  <button
                                    @click="deleteData(setting.id)"
                                    class="btn btn-danger btn-sm btn-circle"
                                  >
                                    <i class="fas fa-trash"></i>
                                  </button>
                                </td>
                                <td v-else>
                                  <button
                                    disabled
                                    @click="editData(setting)"
                                    class="btn btn-primary btn-sm btn-circle"
                                  >
                                    <i class="fas fa-pen"></i>
                                  </button>
                                  <button
                                    disabled
                                    @click="deleteData(setting.id)"
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
                    <div class="col-md-6">
                      <div class="card shadow mb-4">
                        <div class="card-body">
                          <form @submit.prevent="addUpdate">
                            <div class="form-group">
                              <label class="req">Code Name</label>
                              <input
                                v-model="code_name"
                                type="text"
                                class="form-control"
                                placeholder
                                required
                              />
                            </div>

                            <div class="form-group">
                              <label class="req">Code Label</label>
                              <input type="text" class="form-control" v-model="code_label" placeholder required />
                            </div>

                            <div class="form-group">
                              <label class="req">Code Value</label>
                              <input type="text" class="form-control" v-model="code_value" placeholder required />
                            </div>

                            <div class="form-group">
                              <label>Description</label>
                              <textarea type="text" class="form-control" v-model="code_descr" placeholder></textarea>
                            </div>

                            <div class="form-group">
                              <label class="req">Status</label>
                              <select class="form-control" v-model="status" required>
                                <option v-for="(status, index) in statuses" :key="status" :value="index">
                                  {{
                                  status
                                  }}
                                </option>
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
    name: 'ControllerSetting',
    mixins: [ScriptLoader],
    components: {
        HeaderBar,
        LeftSidebar,
        FooterBar
    },
  data() {
    return {
      settings: {},
      id: "",
      code_name: "",
      code_label: "",
      code_value: "",
      code_descr: "",
      status: "10",
      statuses: {},
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
    getData(page = 1) {
      this.$Progress.start();
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')

      axios({ method: "GET", url: "/api/settings?page=" + page }).then(
        result => {
          this.settings = result.data.settings;
          this.statuses = result.data.statuses;
        },
        error => {
          console.error(error);
        }
      );
      this.$Progress.finish();
    },

    addUpdate() {
      if (this.edit == false) {
        axios
          .post("/api/settings", {
            code_name: this.code_name,
            code_label: this.code_label,
            code_value: this.code_value,
            code_descr: this.code_descr,
            status: this.status
          })
          .then(res => {
            this.clearForm();
            this.getData();
            toast.fire({
              icon: "success",
              title: "Saved!"
            });
          });
      } else {
        //update
        axios
          .put(`/api/settings/${this.id}`, {
            code_name: this.code_name,
            code_label: this.code_label,
            code_value: this.code_value,
            code_descr: this.code_descr,
            status: this.status
          })
          .then(res => {
            this.clearForm();
            this.getData();
            this.edit = false;
            toast.fire({
              icon: "success",
              title: "Updated!"
            });
          });

      }
    },

    editData(setting) {
      this.id = setting.id;
      this.code_name = setting.code_name;
      this.code_label = setting.code_label;
      this.code_value = setting.code_value;
      this.code_descr = setting.code_descr;
      this.status = setting.status;
      this.edit = true;
    },

    deleteData(id) {
      if (confirm("Are You Sure?")) {
        axios
          .delete(`/api/settings/${id}`)
          .then(res => {
            this.id = "";
            this.getData();
            toast.fire({
              icon: "info",
              title: "Deleted!"
            });
          });
      }
    },

    clearForm() {
      this.edit = false;
      this.id = "";
      this.code_name = "";
      this.code_label = "";
      this.code_value = "";
      this.code_descr = "";
      this.status = "10";
    }
  }
};
</script>

<style lang="scss" scoped></style>

