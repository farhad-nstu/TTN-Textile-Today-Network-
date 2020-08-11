<template>
  <div>
    <div class="row">
      <div class="col-md-7">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">Services</h6>
          </div>

          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Title</th>
                  <th scope="col">Code</th>
                  <th scope="col">status</th>
                  <th scope="col">Options</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(service) in services" v-bind:key="service.id">
                  <td>{{service.title}}</td>
                  <td>{{service.service_code}}</td>
                  <td>
                    <span v-if="service.status == 10" class="badge badge-success">Active</span>
                    <span v-else class="badge badge-danger">Inactive</span>
                  </td>
                  <td v-if="edit == false">
                    <button @click="editData(service)" class="btn btn-primary btn-sm btn-circle">
                      <i class="fas fa-pen"></i>
                    </button>
                    <button
                      @click="deleteData(service.id)"
                      class="btn btn-danger btn-sm btn-circle"
                    >
                      <i class="fas fa-trash"></i>
                    </button>
                  </td>
                  <td v-else>
                    <button
                      disabled
                      @click="editData(service)"
                      class="btn btn-primary btn-sm btn-circle"
                    >
                      <i class="fas fa-pen"></i>
                    </button>
                    <button
                      disabled
                      @click="deleteData(service.id)"
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
                <label class="req">Code</label>
                <input type="text" class="form-control" v-model="service_code" placeholder required />
              </div>

              <div class="form-group">
                <label>Description</label>
                <input type="text" class="form-control" v-model="descr" placeholder />
              </div>

              <div class="form-group">
                <label class="req">Status</label>
                <select class="form-control" v-model="status" required>
                  <option v-for="(status, index) in statuses" :value="index">{{ status }}</option>
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
      services: {},
      statuses: {},
      id: "",
      title: "",
      service_code: "",
      descr: "",
      status: "10",
      edit: false
    };
  },

  mounted() {
    this.getData();
  },

  methods: {
    getData() {
      this.$Progress.start();
      axios({ method: "GET", url: "/api/services" }).then(
        result => {
          console.log(result.data);
          this.services = result.data.services;
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
          .post("/api/services", {
            title: this.title,
            service_code: this.service_code,
            descr: this.descr,
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
          .put(`/api/services/${this.id}`, {
            title: this.title,
            service_code: this.service_code,
            descr: this.descr,
            status: this.status
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

    editData(service) {
      this.id = service.id;
      this.title = service.title;
      this.service_code = service.service_code;
      this.descr = service.descr;
      this.status = service.status;
      this.edit = true;
    },

    deleteData(id) {
      if (confirm("Are You Sure?")) {
        axios
          .delete(`/api/services/${id}`)
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
      this.service_code = "";
      this.descr = "";
      this.status = "";
    }
  }
};
</script>

<style lang="scss" scoped>
</style>