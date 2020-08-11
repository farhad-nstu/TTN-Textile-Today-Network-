<template>
    <div>
        <LeftSidebar/>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <HeaderBar/>
                <div class="container-fluid" >
                    <div class="row sticky">
                        <div class="col-md-7">
                            <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary float-left">User Types</h6>
                            </div>

                            <div class="card-body">
                                <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="userType in userTypes" v-bind:key="userType.id">
                                    <td>{{ userType.title }}</td>
                                    <td>{{ userType.descr }}</td>
                                    <td v-if="edit == false">
                                        <button @click="editData(userType)" class="btn btn-primary btn-sm btn-circle">
                                        <i class="fas fa-pen"></i>
                                        </button>
                                        <button
                                        @click="deleteData(userType.id)"
                                        class="btn btn-danger btn-sm btn-circle"
                                        >
                                        <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                    <td v-else>
                                        <button
                                        disabled
                                        @click="editData(userType)"
                                        class="btn btn-primary btn-sm btn-circle"
                                        >
                                        <i class="fas fa-pen"></i>
                                        </button>
                                        <button
                                        disabled
                                        @click="deleteData(userType.id)"
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
                                    <label>Description</label>
                                    <input type="text" class="form-control" v-model="descr" placeholder />
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
    name: 'ControllerUserTypes',
    components: {
        HeaderBar,
        LeftSidebar,
        FooterBar
    },
    data() {
        return {
        userTypes: {},
        id: "",
        title: "",
        descr: "",
        edit: false
        };
    },

  mounted() {
    this.getData();
  },

  methods: {
    getData() {
      this.$Progress.start();
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
      axios({ method: "GET", url: "/api/user-types" }).then(
        result => {
          console.log(result.data);
          this.userTypes = result.data;
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
          .post("/api/user-types", {
            title: this.title,
            descr: this.descr
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
          .put(`/api/user-types/${this.id}`, {
            title: this.title,
            descr: this.descr
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

    editData(userType) {
      this.id = userType.id;
      this.title = userType.title;
      this.descr = userType.descr;
      this.edit = true;
    },

    deleteData(id) {
      if (confirm("Are You Sure?")) {
        axios
          .delete(`/api/user-types/${id}`)
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
      this.descr = "";
    }
  }
};
</script>

<style lang="scss" scoped></style>



