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
                          <h6 class="m-0 font-weight-bold text-primary float-left">
                            Countries
                          </h6>
                        </div>

                        <div class="card-body">
                          <nav aria-label="Page navigation example">
                            <ul class="pagination">
                              <li
                                v-bind:class="[{ disabled: !pagination.prev_page_url }]"
                                class="page-item"
                              >
                                <a
                                  class="page-link"
                                  href="#"
                                  @click="fetchCountries(pagination.prev_page_url)"
                                  >Previous</a
                                >
                              </li>

                              <li class="page-item disabled">
                                <a class="page-link text-dark" href="#"
                                  >Page {{ pagination.current_page }} of
                                  {{ pagination.last_page }}</a
                                >
                              </li>

                              <li
                                v-bind:class="[{ disabled: !pagination.next_page_url }]"
                                class="page-item"
                              >
                                <a
                                  class="page-link"
                                  href="#"
                                  @click="fetchCountries(pagination.next_page_url)"
                                  >Next</a
                                >
                              </li>
                            </ul>
                          </nav>
                          <table class="table">
                            <thead>
                              <tr>
                                <td>Name</td>
                                <td>Code</td>
                                <td>Options</td>
                              </tr>
                            </thead>

                            <tbody>
                              <tr v-for="country in countries" v-bind:key="country.id">
                                <td>{{ country.name }}</td>
                                <td>{{ country.country_code }}</td>
                                <td v-if="edit == false">
                                  <button
                                    @click="editCountry(country)"
                                    class="btn btn-primary btn-sm btn-circle"
                                  >
                                    <i class="fas fa-pen"></i>
                                  </button>
                                  <button
                                    @click="deleteCountry(country.id)"
                                    class="btn btn-danger btn-sm btn-circle"
                                  >
                                    <i class="fas fa-trash"></i>
                                  </button>
                                </td>
                                <td v-else>
                                  <button
                                    disabled
                                    @click="editCountry(country)"
                                    class="btn btn-primary btn-sm btn-circle"
                                  >
                                    <i class="fas fa-pen"></i>
                                  </button>
                                  <button
                                    disabled
                                    @click="deleteCountry(country.id)"
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
                          <form @submit.prevent="addCountry">
                            <div class="form-group">
                              <label class="req">Name</label>
                              <input
                                name="name"
                                type="text"
                                v-model="country.name"
                                class="form-control"
                                placeholder
                                required
                              />
                            </div>

                            <div class="form-group">
                              <label class="req">Country Code</label>
                              <input
                                type="text"
                                class="form-control"
                                v-model="country.country_code"
                                name="country_code"
                                placeholder="Ex. BAN"
                                maxlength="6"
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
  name: 'ControllerCountry',
  components: {
      HeaderBar,
      LeftSidebar,
      FooterBar
  },
  data() {
    return {
      countries: [],
      country: {
        id: "",
        name: "",
        country_code: ""
      },
      id: "",
      pagination: {},
      edit: false
    };
  },
  mounted() {
    this.getData();
  },

  // created() {
  //   this.fetchCountries();
  // },

  methods: {
    getData() {
      this.$Progress.start();
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')

      axios({ method: "GET", url: "/api/countries" }).then(
        result => {
          console.log(result.data);
          this.countries = res.data;
          vm.makePagination(res.meta, res.links);
        },
        error => {
          console.error(error);
        }
      );
      this.$Progress.finish();
    },
    // fetchCountries(page_url) {
    //   this.$Progress.start();
    //   axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');

    //   let vm = this;
    //   page_url = page_url || "/api/countries";
    //   fetch(page_url)
    //     .then(res => res.json())
    //     .then(res => {
    //       this.countries = res.data;
    //       vm.makePagination(res.meta, res.links);
    //       this.$Progress.finish();
    //     })
    //     .catch(err => console.log(err));
    // },

    makePagination(meta, links) {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev
      };
      this.pagination = pagination;
    },

    deleteCountry(id) {
      if (confirm("Are you sure?")) {
        fetch(`/api/country/${id}`, {
          method: "delete"
        })
          .then(res => res.json())
          .then(data => {
            this.fetchCountries();
            toast.fire({
              icon: "info",
              title: "Deleted!"
            });
          });
      }
    },

    addCountry() {
      if (this.edit === false) {
        // Add
        fetch("/api/country", {
          method: "post",
          body: JSON.stringify(this.country),
          headers: {
            "content-type": "application/json"
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            this.fetchCountries();
            toast.fire({
              icon: "success",
              title: "Saved!"
            });
          })
          .catch(err => console.log(err));
      } else {
        // Update
        fetch("/api/country", {
          method: "put",
          body: JSON.stringify(this.country),
          headers: {
            "content-type": "application/json"
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            this.fetchCountries();
            toast.fire({
              icon: "success",
              title: "Updated!"
            });
          })
          .catch(err => console.log(err));
      }
    },

    editCountry(country) {
      this.edit = true;
      this.country.id = country.id;
      this.country.id = country.id;
      this.country.name = country.name;
      this.country.country_code = country.country_code;
    },

    clearForm() {
      this.edit = false;
      this.country.id = null;
      this.country.id = null;
      this.country.name = "";
      this.country.country_code = "";
    }
  },

  mounted() {
    console.log("Component mounted.");
  }
};
</script>
