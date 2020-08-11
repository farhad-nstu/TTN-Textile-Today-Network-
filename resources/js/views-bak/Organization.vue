<template>
  <div>
    <div class="row">
      <div class="col-md-8">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">organizations</h6>
          </div>

          <div class="card-body">
            <pagination :data="organizations" @pagination-change-page="getData"></pagination>
            <table class="table">
              <thead>
                <tr>
                  <td>Name</td>
                  <td>Status</td>
                  <td>Options</td>
                </tr>
              </thead>

              <tbody>
                <tr v-for="organization in organizations.data" v-bind:key="organization.id">
                  <td>{{ organization.name }}</td>
                  <td>
                    <span v-if="organization.status == 10" class="badge badge-success">Active</span>
                    <span v-else class="badge badge-danger">Inactive</span>
                  </td>
                  <td v-if="edit == false">
                    <button
                      @click="editData(organization)"
                      class="btn btn-primary btn-sm btn-circle"
                    >
                      <i class="fas fa-pen"></i>
                    </button>
                    <button
                      @click="deleteData(organization.id)"
                      class="btn btn-danger btn-sm btn-circle"
                    >
                      <i class="fas fa-trash"></i>
                    </button>
                  </td>
                  <td v-else>
                    <button
                      disabled
                      @click="editData(organization)"
                      class="btn btn-primary btn-sm btn-circle"
                    >
                      <i class="fas fa-pen"></i>
                    </button>
                    <button
                      disabled
                      @click="deleteData(organization.id)"
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
            <form @submit.prevent="addUpdate" enctype="multipart/form-data">
              <div class="form-group">
                <label class="req">Name</label>
                <input
                  name="name"
                  type="text"
                  v-model="name"
                  class="form-control"
                  placeholder="Name"
                  required
                />
              </div>
              <div class="form-group">
                <label class="req">Short Details</label>
                <input type="text" v-model="short_details" class="form-control" required />
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="email" v-model="email" class="form-control" />
              </div>
              <div class="form-group">
                <label>Phone</label>
                <input type="text" v-model="phone" class="form-control" placeholder />
              </div>
              <div class="form-group">
                <label class="req">Address</label>
                <input type="text" v-model="address" class="form-control" required />
              </div>
              <div class="form-group">
                <label>Website</label>
                <input type="text" v-model="website" class="form-control" placeholder="http://" />
              </div>
              <div class="form-group">
                <label>Fax</label>
                <input type="text" v-model="fax" class="form-control" placeholder />
              </div>
              <div class="form-group">
                <label>Logo</label>
                <br />
                <input type="file" class="form-control-file" @change="takeImage" ref="fileInput" />
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
      organizations: {},
      id: "",
      name: "",
      short_details: "",
      website: "",
      phone: "",
      fax: "",
      email: "",
      address: "",
      company_logo: "",
      status: "10",
      statuses: {},
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
        this.company_logo = event.target.result;
        console.log(event.target.result);
      };
      reader.readAsDataURL(file);
    },

    getData(page = 1) {
      this.$Progress.start();
      axios({ method: "GET", url: "/api/organizations?page=" + page }).then(
        result => {
          console.log(result.data);
          this.organizations = result.data.organizations;
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
          .post("/api/organizations", {
            name: this.name,
            short_details: this.short_details,
            website: this.website,
            phone: this.phone,
            fax: this.fax,
            email: this.email,
            address: this.address,
            status: this.status,
            company_logo: this.company_logo
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
          .put(`/api/organizations/${this.id}`, {
            name: this.name,
            short_details: this.short_details,
            website: this.website,
            phone: this.phone,
            fax: this.fax,
            email: this.email,
            address: this.address,
            company_logo: this.company_logo,
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

    editData(organization) {
      this.id = organization.id;
      this.name = organization.name;
      this.short_details = organization.short_details;
      this.website = organization.website;
      this.phone = organization.phone;
      this.email = organization.email;
      this.address = organization.address;
      this.status = organization.status;
      this.edit = true;
    },

    deleteData(id) {
      if (confirm("Are You Sure?")) {
        axios
          .delete(`/api/organizations/${id}`)
          .then(res => {
            this.clearForm();
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
      this.name = "";
      this.short_details = "";
      this.website = "";
      this.phone = "";
      this.email = "";
      this.address = "";
      this.company_logo = "";
      this.status = "";
      this.$refs.fileInput.value = "";
    }
  }
};
</script>

<style lang="scss" scoped></style>
