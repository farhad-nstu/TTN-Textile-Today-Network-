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
                                <h6 class="m-0 font-weight-bold text-primary float-left">Badges</h6>
                            </div>

                            <div class="card-body">
                                <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Color Code</th>
                                    <th scope="col">status</th>
                                    <th scope="col">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="badge in badges" v-bind:key="badge.id">
                                    <td>{{ badge.title }}</td>
                                    <td>{{ badge.color_code }}</td>
                                    <td>
                                        <span v-if="badge.status == 10" class="badge badge-success">Active</span>
                                        <span v-else class="badge badge-danger">Inactive</span>
                                    </td>
                                    <td v-if="edit == false">
                                        <button @click="editData(badge)" class="btn btn-primary btn-sm btn-circle">
                                        <i class="fas fa-pen"></i>
                                        </button>
                                        <button @click="deleteData(badge.id)" class="btn btn-danger btn-sm btn-circle">
                                        <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                    <td v-else>
                                        <button
                                        disabled
                                        @click="editData(badge)"
                                        class="btn btn-primary btn-sm btn-circle"
                                        >
                                        <i class="fas fa-pen"></i>
                                        </button>
                                        <button
                                        disabled
                                        @click="deleteData(badge.id)"
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
                                <form @submit.prevent="addUpdate" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="req">Title</label>
                                    <input v-model="title" type="text" class="form-control" placeholder required />
                                </div>

                                <div class="form-group">
                                    <label class="req">Color Code</label>
                                    <input type="text" class="form-control" v-model="color_code" placeholder required />
                                </div>

                                <div class="form-group">
                                    <label class="req">Score Needed</label>
                                    <input type="text" class="form-control" v-model="score_needed" placeholder required />
                                </div>

                                <div class="form-group">
                                    <label>Logo</label>
                                    <br />
                                    <input
                                    type="file"
                                    class="form-control-file"
                                    @change="takeImage"
                                    placeholder
                                    ref="fileInput"
                                    />
                                </div>

                                <div class="form-group">
                                    <label class="req">Status</label>
                                    <select class="form-control" v-model="status" required>
                                    <option v-for="(status, index) in statuses" :value="index">
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

export default {
    name: 'ControllerBadges',
    components: {
        HeaderBar,
        LeftSidebar,
        FooterBar
    },
  data() {
    return {
      badges: {},
      statuses: {},
      id: "",
      title: "",
      color_code: "",
      icon: "",
      score_needed: "",
      status: "10",
      edit: false
    };
  },

  mounted() {
    this.getData();
  },

  methods: {
    takeImage(event) {
      let file = event.target.files[0];
      let reader = new FileReader();
      reader.onload = event => {
        this.icon = event.target.result;
        console.log(event.target.result);
      };
      reader.readAsDataURL(file);
    },

    getData() {
      this.$Progress.start();
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')
      axios({ method: "GET", url: "/api/badges" }).then(
        result => {
          console.log(result.data);
          this.badges = result.data.badges;
          this.statuses = result.data.status;
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
          .post("/api/badges", {
            title: this.title,
            color_code: this.color_code,
            score_needed: this.score_needed,
            status: this.status,
            icon: this.icon
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
          .put(`/api/badges/${this.id}`, {
            title: this.title,
            color_code: this.color_code,
            score_needed: this.score_needed,
            status: this.status,
            icon: this.icon
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

    editData(badge) {
      this.id = badge.id;
      this.title = badge.title;
      this.color_code = badge.color_code;
      this.score_needed = badge.score_needed;
      this.status = badge.status;
      this.edit = true;
    },

    deleteData(id) {
      if (confirm("Are You Sure?")) {
        axios
          .delete(`/api/badges/${id}`)
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
      this.color_code = "";
      this.score_needed = "";
      this.status = "";
      this.icon = "";
      this.$refs.fileInput.value = "";
    }
  }
};
</script>

<style lang="scss" scoped></style>

