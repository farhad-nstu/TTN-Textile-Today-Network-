<template>
  <div>
    <div class="row">
      <div class="col-md-6">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">Access Points</h6>
          </div>

          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <td>Name</td>
                  <td>Code</td>
                  <td>Status</td>
                  <td>Options</td>
                </tr>
              </thead>

              <tbody>
                <tr v-for="accessPoint in accessPoints.data" v-bind:key="accessPoint.id">
                  <td>{{ accessPoint.access_point_name }}</td>
                  <td>{{ accessPoint.unique_code }}</td>
                  <td>
                    <span v-if="accessPoint.status == 10" class="badge badge-success">Active</span>
                    <span v-else class="badge badge-danger">Inactive</span>
                  </td>
                  <td v-if="edit == false">
                    <button
                      @click="editData(accessPoint)"
                      class="btn btn-primary btn-sm btn-circle"
                    >
                      <i class="fas fa-pen"></i>
                    </button>
                    <button
                      @click="deleteData(accessPoint.id)"
                      class="btn btn-danger btn-sm btn-circle"
                    >
                      <i class="fas fa-trash"></i>
                    </button>
                  </td>
                  <td v-else>
                    <button
                      disabled
                      @click="editData(accessPoint)"
                      class="btn btn-primary btn-sm btn-circle"
                    >
                      <i class="fas fa-pen"></i>
                    </button>
                    <button
                      disabled
                      @click="deleteData(accessPoint.id)"
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
                <label class="req">Access Point Name</label>
                <input
                  v-model="access_point_name"
                  type="text"
                  class="form-control"
                  placeholder
                  required
                />
              </div>

              <div class="form-group">
                <label class="req">Unique Code</label>
                <input type="text" class="form-control" v-model="unique_code" placeholder required />
              </div>

              <div class="form-group">
                <label>Description</label>
                <textarea type="text" class="form-control" v-model="descr" placeholder></textarea>
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
      accessPoints: {},
      id: "",
      access_point_name: "",
      unique_code: "",
      descr: "",
      status: "10",
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
      axios({ method: "GET", url: "/api/access-points" }).then(
        result => {
          console.log(result.data);
          this.accessPoints = result.data.accessPoints;
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
          .post("/api/access-points", {
            access_point_name: this.access_point_name,
            unique_code: this.unique_code,
            descr: this.descr,
            status: this.status
          })
          .then(res => {
            this.access_point_name = "";
            this.unique_code = "";
            this.descr = "";
            this.status = "";
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
          .put(`/api/access-points/${this.id}`, {
            access_point_name: this.access_point_name,
            unique_code: this.unique_code,
            descr: this.descr,
            status: this.status
          })
          .then(res => {
            this.access_point_name = "";
            this.unique_code = "";
            this.descr = "";
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

    editData(accessPoint) {
      this.id = accessPoint.id;
      this.access_point_name = accessPoint.access_point_name;
      this.unique_code = accessPoint.unique_code;
      this.descr = accessPoint.descr;
      this.status = accessPoint.status;
      this.edit = true;
    },

    deleteData(id) {
      if (confirm("Are You Sure?")) {
        axios
          .delete(`/api/access-points/${id}`)
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
      this.access_point_name = "";
      this.unique_code = "";
      this.descr = "";
      this.status = "";
    }
  }
};
</script>

<style lang="scss" scoped></style>
