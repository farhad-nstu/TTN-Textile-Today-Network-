<template>
  <div>
    <div class="row">
      <div class="col-md-7">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">Event Types</h6>
          </div>

          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Title</th>
                  <th scope="col">Code</th>
                  <th scope="col">Status</th>
                  <th scope="col">Options</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(eventType) in eventTypes" v-bind:key="eventType.id">
                  <td>{{eventType.title}}</td>
                  <td>{{eventType.type_code}}</td>
                  <td>
                    <span v-if="eventType.status == 10" class="badge badge-success">Active</span>
                    <span v-else class="badge badge-danger">Inactive</span>
                  </td>
                  <td v-if="edit == false">
                    <button @click="editData(eventType)" class="btn btn-primary btn-sm btn-circle">
                      <i class="fas fa-pen"></i>
                    </button>
                    <button
                      @click="deleteData(eventType.id)"
                      class="btn btn-danger btn-sm btn-circle"
                    >
                      <i class="fas fa-trash"></i>
                    </button>
                  </td>
                  <td v-else>
                    <button
                      disabled
                      @click="editData(eventType)"
                      class="btn btn-primary btn-sm btn-circle"
                    >
                      <i class="fas fa-pen"></i>
                    </button>
                    <button
                      disabled
                      @click="deleteData(eventType.id)"
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
            <form @submit.prevent="addUpdate">
              <div class="form-group">
                <label class="req">Title</label>
                <input v-model="title" type="text" class="form-control" placeholder required />
              </div>

              <div class="form-group">
                <label class="req">Code</label>
                <input type="text" class="form-control" v-model="type_code" placeholder required />
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
      eventTypes: {},
      statuses: {},
      id: "",
      title: "",
      type_code: "",
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
      axios({ method: "GET", url: "/api/event-types" }).then(
        result => {
          console.log(result.data);
          this.eventTypes = result.data.eventTypes;
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
          .post("/api/event-types", {
            title: this.title,
            type_code: this.type_code,
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
          .put(`/api/event-types/${this.id}`, {
            title: this.title,
            type_code: this.type_code,
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

    editData(eventType) {
      this.id = eventType.id;
      this.title = eventType.title;
      this.type_code = eventType.type_code;
      this.descr = eventType.descr;
      this.status = eventType.status;
      this.edit = true;
    },

    deleteData(id) {
      if (confirm("Are You Sure?")) {
        axios
          .delete(`/api/event-types/${id}`)
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
      this.type_code = "";
      this.descr = "";
      this.status = "";
    }
  }
};
</script>

<style lang="scss" scoped>
</style>