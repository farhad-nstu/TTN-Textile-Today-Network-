<template>
  <div>
    <div class="row">
      <div class="col-md-8">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">Tags</h6>
          </div>

          <div class="card-body">
            <pagination :data="tags" @pagination-change-page="getData"></pagination>
            <table class="table">
              <thead>
                <tr>
                  <td>Name</td>
                  <td>Category</td>
                  <td>status</td>
                  <td>Options</td>
                </tr>
              </thead>

              <tbody>
                <tr v-for="tag in tags.data" v-bind:key="tag.id">
                  <td>{{ tag.tag }}</td>
                  <td>{{ tag.tag_category.title }}</td>
                  <td>
                    <span v-if="tag.status == 10" class="badge badge-success">Active</span>
                    <span v-else class="badge badge-danger">Inactive</span>
                  </td>
                  <td v-if="edit == false">
                    <button @click="editData(tag)" class="btn btn-primary btn-sm btn-circle">
                      <i class="fas fa-pen"></i>
                    </button>
                    <button @click="deleteData(tag.id)" class="btn btn-danger btn-sm btn-circle">
                      <i class="fas fa-trash"></i>
                    </button>
                  </td>
                  <td v-else>
                    <button
                      disabled
                      @click="editData(tag)"
                      class="btn btn-primary btn-sm btn-circle"
                    >
                      <i class="fas fa-pen"></i>
                    </button>
                    <button
                      disabled
                      @click="deleteData(tag.id)"
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
            <h6 class="m-0 font-weight-bold text-primary float-left">Add new</h6>
          </div>
          <div class="card-body">
            <form @submit.prevent="addUpdate">
              <div class="form-group">
                <label class="req">Select Category</label>
                <select class="form-control" v-model="tag_category_id" required>
                  <option
                    v-for="tagCategory in tagCategories"
                    :value="tagCategory.id"
                  >{{ tagCategory.title }}</option>
                </select>
              </div>
              <div class="form-group">
                <label class="req">Name</label>
                <input
                  name="name"
                  type="text"
                  v-model="tag"
                  class="form-control"
                  placeholder
                  required
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
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      tags: {},
      id: "",
      tag_category_id: "1",
      tag: "",
      status: "10",
      statuses: {},
      tagCategories: {},
      edit: false
    };
  },

  mounted() {
    this.getData();
  },

  methods: {
    getData(page = 1) {
      this.$Progress.start();
      axios({ method: "GET", url: "/api/tags?page=" + page }).then(
        result => {
          console.log(result.data);
          this.tags = result.data.tags;
          this.tagCategories = result.data.tagCategories;
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
          .post("/api/tags", {
            tag_category_id: this.tag_category_id,
            tag: this.tag,
            status: this.status
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
          .put(`/api/tags/${this.id}`, {
            tag_category_id: this.tag_category_id,
            tag: this.tag,
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
          })
          .catch(err => {
            console.log(err);
          });
      }
    },

    editData(tag) {
      this.id = tag.id;
      this.tag_category_id = tag.tag_category_id;
      this.tag = tag.tag;
      this.status = tag.status;
      this.edit = true;
    },

    deleteData(id) {
      if (confirm("Are You Sure?")) {
        axios
          .delete(`/api/tags/${id}`)
          .then(res => {
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
      this.tag_category_id = "";
      this.tag = "";
      this.status = "";
    }
  }
};
</script>

<style lang="scss" scoped></style>
