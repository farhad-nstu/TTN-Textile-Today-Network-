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
                          <h6 class="m-0 font-weight-bold text-primary float-left">Apps</h6>
                        </div>

                        <div class="card-body">
                          <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Platform</th>
                                <th scope="col">Description</th>
                                <th scope="col">Options</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr v-for="app in apps" v-bind:key="app.id">
                                <td>{{ app.title }}</td>
                                <td v-if="app.platform_id == 1">Android</td>
                                <td v-else>iOS</td>
                                <td>{{ app.short_descr }}</td>
                                <td v-if="edit == false">
                                  <button
                                    @click="editData(app)"
                                    class="btn btn-primary btn-sm btn-circle"
                                  >
                                    <i class="fas fa-pen"></i>
                                  </button>
                                  <button
                                    @click="deleteData(app.id)"
                                    class="btn btn-danger btn-sm btn-circle"
                                  >
                                    <i class="fas fa-trash"></i>
                                  </button>
                                </td>
                                <td v-else>
                                  <button
                                    disabled
                                    @click="editData(app)"
                                    class="btn btn-primary btn-sm btn-circle"
                                  >
                                    <i class="fas fa-pen"></i>
                                  </button>
                                  <button
                                    disabled
                                    @click="deleteData(app.id)"
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
                          <h6 class="m-0 font-weight-bold text-primary float-left">
                            Add new
                          </h6>
                        </div>
                        <div class="card-body">
                          <form @submit.prevent="addUpdate" enctype="multipart/form-data">
                            <div class="form-group">
                              <label class="req">Platform</label>
                              <select class="form-control" v-model="platform_id" id required>
                                <option value="1">Android</option>
                                <option value="0">iOS</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label class="req">Title</label>
                              <input
                                v-model="title"
                                type="text"
                                class="form-control"
                                placeholder
                                required
                              />
                            </div>

                            <div class="form-group">
                              <label class="req">Package Name</label>
                              <input
                                type="text"
                                class="form-control"
                                v-model="package_name"
                                placeholder
                                required
                              />
                            </div>

                            <div class="form-group">
                              <label class="req">Short Description</label>
                              <input
                                type="text"
                                class="form-control"
                                v-model="short_descr"
                                placeholder
                                required
                              />
                            </div>

                            <div class="form-group">
                              <label class="req">Description</label>
                              <textarea
                                type="text"
                                class="form-control"
                                v-model="descr"
                                placeholder
                                required
                              ></textarea>
                            </div>

                            <div v-if="edit == true" class="form-group">
                              <label>Logo</label>
                              <br />
                              <input
                                name="logo"
                                type="file"
                                class="form-control-file"
                                @change="takeImage"
                                placeholder
                                ref="fileInput"
                              />
                            </div>
                            <div v-else class="form-group">
                              <label class="req">Logo</label>
                              <br />
                              <input
                                name="logo"
                                type="file"
                                class="form-control-file"
                                @change="takeImage"
                                placeholder
                                ref="fileInput"
                                required
                              />
                            </div>

                            <div class="form-group">
                              <label>Promo Video Link</label>
                              <input
                                type="text"
                                class="form-control"
                                v-model="promo_video_link"
                                placeholder="ex. https://www..."
                              />
                            </div>

                            <div class="form-group">
                              <label class="req">Firebase Api Key</label>
                              <input
                                type="text"
                                class="form-control"
                                v-model="firebase_api_key"
                                placeholder
                                required
                              />
                            </div>
                            <div v-if="edit == false">
                              <button type="submit" class="btn btn-success">Save</button>
                            </div>
                            <div v-else>
                              <button type="submit" class="btn btn-primary">Update</button>
                              <button @click="clearForm()" class="btn btn-danger">
                                Cancel
                              </button>
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
    name: 'ControllerApps',
    mixins: [ScriptLoader],
    mounted(){
        var page = window.location.href.split('/').pop();
        this.loadStyleSheets(page);
        this.loadJsScripts(page);
        this.getData();
    },
    components: {
        HeaderBar,
        LeftSidebar,
        FooterBar
    },
  data() {
    return {
      apps: {},
      id: "",
      platform_id: "",
      title: "",
      package_name: "",
      short_descr: "",
      descr: "",
      logo: "",
      promo_video_link: "",
      firebase_api_key: "",
      edit: false
    };
  },
  methods: {
    takeImage(event) {
      let file = event.target.files[0];

      let reader = new FileReader();
      reader.onload = event => {
        this.logo = event.target.result;
        console.log(event.target.result);
      };
      reader.readAsDataURL(file);
    },

    getData() {
      this.$Progress.start();
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')

      axios({ method: "GET", url: "api/apps" }).then(
        result => {
          console.log(result.data);
          this.apps = result.data;
        },
        error => {
          console.error('Not verified');
          console.error(error);
        }
      );
      this.$Progress.finish();
    },

    addUpdate() {
      if (this.edit == false) {
        axios
          .post("/api/apps", {
            title: this.title,
            platform_id: this.platform_id,
            package_name: this.package_name,
            short_descr: this.short_descr,
            logo: this.logo,
            descr: this.descr,
            firebase_api_key: this.firebase_api_key,
            promo_video_link: this.promo_video_link
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
        axios
          .put(`/api/apps/${this.id}`, {
            title: this.title,
            platform_id: this.platform_id,
            package_name: this.package_name,
            short_descr: this.short_descr,
            logo: this.logo,
            descr: this.descr,
            firebase_api_key: this.firebase_api_key,
            promo_video_link: this.promo_video_link
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

    editData(app) {
      this.id = app.id;
      this.title = app.title;
      this.platform_id = app.platform_id;
      this.package_name = app.package_name;
      this.short_descr = app.short_descr;
      this.descr = app.descr;
      this.firebase_api_key = app.firebase_api_key;
      this.promo_video_link = app.promo_video_link;
      this.edit = true;
    },

    deleteData(id) {
      if (confirm("Are You Sure?")) {
        axios
          .delete(`/api/apps/${id}`)
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
      this.title = "";
      this.platform_id = "";
      this.package_name = "";
      this.short_descr = "";
      this.descr = "";
      this.logo = "";
      this.firebase_api_key = "";
      this.promo_video_link = "";
      this.$refs.fileInput.value = "";
    }
  }
};
</script>

<style lang="scss" scoped></style>

