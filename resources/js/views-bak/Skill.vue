<template>
  <div>
    <div class="row">
      <div class="col-md-7">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">Skills</h6>
          </div>

          <div class="card-body">
            <pagination :data="skills" @pagination-change-page="getData"></pagination>

            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Title</th>
                  <th scope="col">Options</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="skill in skills.data" v-bind:key="skill.id">
                  <td>{{ skill.title }}</td>
                  <td v-if="edit == false">
                    <button @click="editData(skill)" class="btn btn-primary btn-sm btn-circle">
                      <i class="fas fa-pen"></i>
                    </button>
                    <button @click="deleteData(skill.id)" class="btn btn-danger btn-sm btn-circle">
                      <i class="fas fa-trash"></i>
                    </button>
                  </td>
                  <td v-else>
                    <button
                      disabled
                      @click="editData(skill)"
                      class="btn btn-primary btn-sm btn-circle"
                    >
                      <i class="fas fa-pen"></i>
                    </button>
                    <button
                      disabled
                      @click="deleteData(skill.id)"
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
export default {
  data() {
    return {
      skills: {},
      id: "",
      title: "",
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

      axios({ method: "GET", url: "/api/skills?page=" + page }).then(
        result => {
          console.log(result.data);
          this.skills = result.data;
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
          .post("/api/skills", {
            title: this.title
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
          .put(`/api/skills/${this.id}`, {
            title: this.title
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

    editData(skill) {
      this.id = skill.id;
      this.title = skill.title;
      this.edit = true;
    },

    deleteData(id) {
      if (confirm("Are You Sure?")) {
        axios
          .delete(`/api/skills/${id}`)
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
    }
  }
};
</script>

<style lang="scss" scoped></style>
