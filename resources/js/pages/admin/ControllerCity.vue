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
                          <h6 class="m-0 font-weight-bold text-primary float-left">Cities</h6>
                        </div>

                        <div class="card-body">
                          <pagination :data="cities" @pagination-change-page="getData"></pagination>

                          <table class="table">
                            <thead>
                              <tr>
                                <td>City</td>
                                <td>Country</td>
                                <td>State</td>
                                <td>Options</td>
                              </tr>
                            </thead>

                            <tbody>
                              <tr v-for="city in cities.data" v-bind:key="city.id">
                                <td>{{ city.name }}</td>
                                <td>{{ city.country.name }}</td>
                                <td v-if="city.state == null">empty</td>
                                <td v-else>{{ city.state.name }}</td>
                                <td v-if="edit == false">
                                  <button @click="editData(city)" class="btn btn-primary btn-sm btn-circle">
                                    <i class="fas fa-pen"></i>
                                  </button>
                                  <button @click="deleteData(city.id)" class="btn btn-danger btn-sm btn-circle">
                                    <i class="fas fa-trash"></i>
                                  </button>
                                </td>
                                <td v-else>
                                  <button
                                    disabled
                                    @click="editData(city)"
                                    class="btn btn-primary btn-sm btn-circle"
                                  >
                                    <i class="fas fa-pen"></i>
                                  </button>
                                  <button
                                    disabled
                                    @click="deleteData(city.id)"
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
                              <label class="req">Select Country</label>
                              <select class="form-control" v-model="country_id" required>
                                <option value>Select Country</option>
                                <option v-for="country in countries" v-bind:value="country.id">{{ country.name }}</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label>Select State</label>
                              <select class="form-control" v-model="state_id">
                                <option value>Select State</option>
                                <option v-for="state in states" :key="state" v-bind:value="state.id">
                                  {{
                                  state.name
                                  }}
                                </option>
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
    name: 'ControllerCity',
    components: {
        HeaderBar,
        LeftSidebar,
        FooterBar
    },
  data() {
    return {
      cities: {},
      id: "",
      country_id: "",
      state_id: "",
      name: "",
      countries: {},
      states: {},
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

      axios({ method: "GET", url: "/api/cities?page=" + page }).then(
        result => {
          console.log(result.data);
          this.cities = result.data.cities;
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
          .post("/api/cities", {
            country_id: this.country_id,
            state_id: this.state_id,
            name: this.name
          })
          .then(res => {
            this.country_id = "";
            this.state_id = "";
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
        axios
          .put(`/api/cities/${this.id}`, {
            country_id: this.country_id,
            state_id: this.state_id,
            name: this.name
          })
          .then(res => {
            this.country_id = "";
            this.state_id = "";
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

    editData(city) {
      this.id = city.id;
      this.state_id = city.state_id;
      this.country_id = city.country_id;
      this.name = city.name;
      this.edit = true;
    },

    deleteData(id) {
      if (confirm("Are You Sure?")) {
        axios
          .delete(`/api/cities/${id}`)
          .then(res => {
            this.name = "";
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
      this.country_id = null;
      this.state_id = null;
      this.name = "";
    }
  }
};
</script>

<style lang="scss" scoped></style>
