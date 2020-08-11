<template>
  <div>
    <LeftSidebar/>

    <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <HeaderBar/>
                <div class="container-fluid" >                
                   <div class="row">
      <div class="col-md-8">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">States</h6>
          </div>

          <div class="card-body">
            <pagination
              :data="states"
              @pagination-change-page="getData"
            ></pagination>
            <table class="table">
              <thead>
                <tr>
                  <td>Name</td>
                  <td>Country</td>
                  <td>Options</td>
                </tr>
              </thead>

              <tbody>
                <tr v-for="state in states.data" v-bind:key="state.id">
                  <td>{{ state.name }}</td>
                  <td>{{ state.country.name }}</td>
                  <td v-if="edit == false">
                    <button
                      @click="editData(state)"
                      class="btn btn-primary btn-sm btn-circle"
                    >
                      <i class="fas fa-pen"></i>
                    </button>
                    <button
                      @click="deleteData(state.id)"
                      class="btn btn-danger btn-sm btn-circle"
                    >
                      <i class="fas fa-trash"></i>
                    </button>
                  </td>
                  <td v-else>
                    <button
                      disabled
                      @click="editData(state)"
                      class="btn btn-primary btn-sm btn-circle"
                    >
                      <i class="fas fa-pen"></i>
                    </button>
                    <button
                      disabled
                      @click="deleteData(state.id)"
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
                <label class="req">Select Country</label>
                <select class="form-control" v-model="country_id" required>
                  <option value>Select Country</option>
                  <option
                    v-for="country in countries"
                    v-bind:value="country.id"
                    >{{ country.name }}</option
                  >
                </select>
              </div>
              <div class="form-group">
                <label class="req">Name</label>
                <input
                  name="name"
                  type="text"
                  v-model="name"
                  class="form-control"
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

export default {
  name: 'ControllerState',
  components: {
      HeaderBar,
      LeftSidebar,
      FooterBar
  },
  data() {
    return {
      states: {},
      id: "",
      country_id: "",
      name: "",
      countries: {},
      edit: false
    };
  },

  mounted() {
    this.getData();
  },

  methods: {
    getData(page = 1) {
      this.$Progress.start();
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')

      axios({ method: "GET", url: "/api/states?page=" + page }).then(
        result => {
          console.log(result.data);
          this.states = result.data.states;
          this.countries = result.data.countries;
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
          .post("/api/states", {
            country_id: this.country_id,
            name: this.name
          })
          .then(res => {
            this.country_id = "";
            this.name = "";
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
          .put(`/api/states/${this.id}`, {
            country_id: this.country_id,
            name: this.name
          })
          .then(res => {
            this.country_id = "";
            this.name = "";
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

    editData(state) {
      this.id = state.id;
      this.country_id = state.country_id;
      this.name = state.name;
      this.edit = true;
    },

    deleteData(id) {
      if (confirm("Are You Sure?")) {
        axios
          .delete(`/api/states/${id}`)
          .then(res => {
            this.name = "";
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
      this.id = null;
      this.country_id = null;
      this.name = "";
    }
  }
};
</script>

<style lang="scss" scoped></style>
