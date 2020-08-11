<template>
  <div>
    <div class="row">
      <div v-show="edit == true" class="col">
        <div class>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary float-left">Post</h6>
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
                  <label class="req">Description</label>
                  <tinymce id="d1" v-model="descr"></tinymce>
                  <!-- <textarea class="form-control" v-model="descr" name="" id="" cols="30" rows="10"></textarea>  -->
                </div>

                <div class="form-group">
                  <label class="req">Post Type</label>
                  <select class="form-control" v-model="post_type_id" required>
                    <option v-for="type in types" :value="type.id">{{
                      type.title
                    }}</option>
                  </select>
                </div>
                <div class="form-group">
                  <label class="req">Status</label>
                  <select class="form-control" v-model="status" required>
                    <option
                      v-for="(status, index) in statuses"
                      :value="index"
                      >{{ status }}</option
                    >
                  </select>
                </div>
                <div>
                  <button type="submit" class="btn btn-primary">Save</button>
                  <button @click="clearForm()" class="btn btn-danger">
                    Cancel
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div v-show="edit == false" class="col">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">Posts</h6>
            <button
              @click="createPost()"
              class="btn btn-success btn-sm btn-circle float-right"
            >
              <i class="fas fa-plus"></i>
            </button>
          </div>

          <div class="card-body">
            <pagination
              :data="posts"
              @pagination-change-page="getData"
            ></pagination>
            <table class="table">
              <thead>
                <tr>
                  <td>Title</td>
                  <td>Status</td>
                  <td>Options</td>
                </tr>
              </thead>

              <tbody>
                <tr v-for="post in posts.data" v-bind:key="post.id">
                  <td>{{ post.title }}</td>
                  <td>
                    <span class="badge badge-primary" v-if="post.status == 0">Draft</span>
                    <span class="badge badge-success" v-else-if="post.status == 10">Published</span class="badge badge-primary">
                    <span class="badge badge-light" v-else-if="post.status == 20">Unpublished</span class="badge badge-primary">
                    <span class="badge badge-warning" v-else-if="post.status == 30">Flagged</span class="badge badge-primary">
                    <span class="badge badge-danger" v-else>Spam</span class="badge badge-primary">
                  </td>
                  <td v-if="edit == false">
                    <button
                      @click="editData(post)"
                      class="btn btn-primary btn-sm btn-circle"
                    >
                      <i class="fas fa-pen"></i>
                    </button>
                    <button
                      @click="deleteData(post.id)"
                      class="btn btn-danger btn-sm btn-circle"
                    >
                      <i class="fas fa-trash"></i>
                    </button>
                  </td>
                  <td v-else>
                    <button
                      disabled
                      @click="editData(post)"
                      class="btn btn-primary btn-sm btn-circle"
                    >
                      <i class="fas fa-pen"></i>
                    </button>
                    <button
                      disabled
                      @click="deleteData(post.id)"
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
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      posts: {},
      id: "",
      title: "",
      descr: "",
      post_type_id: "",
      status: "",
      types: {},
      statuses: {},
      edit: false,
      add: false,
      config: {
        events: {
          initialized: function () {
            console.log('initialized')
          }
        }
      },
      model: 'Edit Your Content Here!'
    
    };
  },

  mounted() {
    this.getData();
  },

  methods: {
    getValue() {
      var overview = this.$refs.editor.getVal();
      console.log(overview);
    },
    getData(page = 1) {
      this.$Progress.start();
      axios({ method: "GET", url: "/api/posts?page=" + page }).then(
        result => {
          console.log(result.data);
          this.posts = result.data.posts;
          this.types = result.data.postTypes;
          this.statuses = result.data.status;
        },
        error => {
          console.error(error);
        }
      );
      this.$Progress.finish();
    },

    addUpdate() {
      if (this.add == true) {
        axios
          .post("/api/posts", {
            title: this.title,
            descr: this.descr,
            status: this.status,
            post_type_id: this.post_type_id
          })
          .then(res => {
            this.title = "";
            this.post_type_id = "";
            this.descr = "";
            this.status = "";
            this.getData();
            this.add = false;
            this.edit = false;
            toast.fire({
              icon: "success",
              title: "Post Saved !"
            });
          })
          .catch(err => {
            console.log(err);
          });
      } else {
        //update
        axios
          .put(`/api/posts/${this.id}`, {
            title: this.title,
            descr: this.descr,
            post_type_id: this.post_type_id,
            status: this.status
          })
          .then(res => {
            this.title = "";
            this.post_type_id = "";
            this.descr = "";
            this.status = "";
            this.getData();
            this.edit = false;
            toast.fire({
              icon: "success",
              title: "Post Updated !"
            });
          })

          .catch(err => {
            console.log(err);
          });
      }
    },

    editData(post) {
      this.edit = true;
      this.id = post.id;
      this.title = post.title;
      this.post_type_id = post.post_type_id;
      this.descr = post.descr;
      this.status = post.status;
    },

    deleteData(id) {
      if (confirm("Are You Sure?")) {
        axios
          .delete(`/api/posts/${id}`)
          .then(res => {
            this.title = "";
            this.getData();
            toast.fire({
              icon: "warning",
              title: "Post Deleted !"
            });
          })

          .catch(err => {
            console.log(err);
          });
      }
    },

    clearForm() {
      this.edit = false;
      this.add = false;
      this.id = "";
      this.title = "";
      this.descr = "";
      this.post_type_id = "";
      this.type_code = "";
      this.status = "";
    },

    createPost() {
      this.add = true;
      this.edit = true;
      this.id = null;
      this.title = null;
      this.descr = "";
      this.post_type_id = null;
      this.type_code = null;
      this.status = null;
    }
  }
};
</script>

<style lang="scss" scoped></style>
