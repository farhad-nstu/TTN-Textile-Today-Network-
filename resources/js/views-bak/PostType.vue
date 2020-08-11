<template>
  <div>
    <div class="row">
      <div class="col-md-8">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">
              Post Types
            </h6>
          </div>

          <div class="card-body">
            <pagination
              :data="postTypes"
              @pagination-change-page="getData"
            ></pagination>
            <table class="table">
              <thead>
                <tr>
                  <td>Title</td>
                  <td>Type Code</td>
                  <td>Status</td>
                  <td>Options</td>
                </tr>
              </thead>

              <tbody>
                <tr v-for="postType in postTypes.data" v-bind:key="postType.id">
                  <td>{{ postType.title }}</td>
                  <td>{{ postType.type_code }}</td>
                  <td>{{ postType.status }}</td>
                  <td v-if="edit == false">
                    <button
                      @click="editData(postType)"
                      class="btn btn-primary btn-sm btn-circle"
                    >
                      <i class="fas fa-pen"></i>
                    </button>
                    <button
                      @click="deleteData(postType.id)"
                      class="btn btn-danger btn-sm btn-circle"
                    >
                      <i class="fas fa-trash"></i>
                    </button>
                  </td>
                  <td v-else>
                    <button
                      disabled
                      @click="editData(postType)"
                      class="btn btn-primary btn-sm btn-circle"
                    >
                      <i class="fas fa-pen"></i>
                    </button>
                    <button
                      disabled
                      @click="deleteData(postType.id)"
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
      <div class="col-md-4">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">
              Add new
            </h6>
          </div>
          <div class="card-body">
            <form @submit.prevent="addUpdate">
              <div class="form-group">
                <label class="req">Title</label>
                <input
                  type="text"
                  v-model="title"
                  class="form-control"
                  placeholder
                  required
                />
              </div>
              <div class="form-group">
                <label class="req">Type Code</label>
                <input
                  name="name"
                  type="text"
                  v-model="type_code"
                  class="form-control"
                  placeholder
                  required
                />
              </div>
              <div class="form-group">
                <label class="req">Status</label>
                <select class="form-control" v-model="status" required>
                  <option
                    v-for="(status, index) in statuses"
                    v-bind:value="index"
                    >{{ status }}</option
                  >
                </select>
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
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      postTypes: {},
      id: "",
      title: "",
      type_code: "",
      status: "",
      statuses: {},
      edit: false
    };
  },

  mounted() {
    this.getData();
  },

  methods: {
    getData(page = 1) {
      this.$Progress.start();
      axios({ method: "GET", url: "/api/post-types?page=" + page }).then(
        result => {
          console.log(result.data);
          this.postTypes = result.data.postTypes;
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
          .post("/api/post-types", {
            title: this.title,
            type_code: this.type_code,
            status: this.status
          })
          .then(res => {
            this.title = "";
            this.type_code = "";
            this.status = "";
            this.getData();
            toast.fire({
              icon: "success",
              title: "Saved!"
            });
          })

          .catch(err => {
            console.log(err);
          });
      } else {
        //update
        axios
          .put(`/api/post-types/${this.id}`, {
            title: this.title,
            type_code: this.type_code,
            status: this.status
          })
          .then(res => {
            this.title = "";
            this.type_code = "";
            this.status = "";
            this.getData();
            this.edit = false;
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

    editData(postType) {
      this.id = postType.id;
      this.title = postType.title;
      this.type_code = postType.type_code;
      this.status = postType.status;
      this.edit = true;
    },

    deleteData(id) {
      if (confirm("Are You Sure?")) {
        axios
          .delete(`/api/post-types/${id}`)
          .then(res => {
            this.title = "";
            this.getData();
            console.log(res);
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
      this.id = null;
      this.title = "";
      this.type_code = null;
      this.status = null;
    }
  }
};
</script>

<style lang="scss" scoped></style>
