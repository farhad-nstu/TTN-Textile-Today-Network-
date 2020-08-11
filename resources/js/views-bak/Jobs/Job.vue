<template>
  <div>
    <div class="row">
      <div class="col">
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
                <label class="req">Job Type</label>
                <select class="form-control" v-model="job_type_id" required>
                  <option v-for="jobType in jobTypes" :value="jobType.id">{{ jobType.title }}</option>
                </select>
              </div>

              <!-- <div class="form-group">
                <label class="req">Organization</label>
                <select class="form-control" v-model="job_type_id" required>
                  <option v-for="jobType in jobTypes" :value="jobType.id">{{ jobType.title }}</option>
                </select>
              </div>-->

              <div class="form-group">
                <label class="req">Job Location</label>
                <input type="text" class="form-control" v-model="job_location" placeholder required />
              </div>

              <div class="form-group">
                <label class="req">Total Vacancy</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="total_vacancy"
                  placeholder
                  required
                />
              </div>

              <div class="form-group">
                <label class="req">Application Deadline</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="application_deadline"
                  placeholder
                  required
                />
              </div>

              <div class="form-group">
                <label class="req">Salary Range</label>
                <input type="text" class="form-control" v-model="salary_range" placeholder required />
              </div>

              <div class="form-group">
                <label class="req">Experience</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="minimum_experience"
                  placeholder
                  required
                />
                <input
                  type="text"
                  class="form-control"
                  v-model="maximum_experience"
                  placeholder
                  required
                />
              </div>

              <div class="form-group">
                <label class="req">Age</label>
                <input type="text" class="form-control" v-model="minimum_age" placeholder required />
                <input type="text" class="form-control" v-model="maximum_age" placeholder required />
              </div>

              <div class="form-group">
                <label class="req">Prefered Gender</label>
                <select class="form-control" v-model="preferred_gender" required>
                  <option>Select Gender</option>
                  <option value="1">Male</option>
                  <option value="2">Female</option>
                </select>
              </div>

              <div class="form-group">
                <label>Reponsibilities</label>
                <textarea type="text" class="form-control" v-model="responsibilities"></textarea>
              </div>

              <div class="form-group">
                <label>Requirements</label>
                <textarea type="text" class="form-control" v-model="requirements"></textarea>
              </div>

              <div class="form-group">
                <label>Other Benefits</label>
                <textarea type="text" class="form-control" v-model="other_benefits"></textarea>
              </div>

              <div class="form-group">
                <label>Special Instruction</label>
                <textarea type="text" class="form-control" v-model="special_instruction"></textarea>
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
      apps: {},
      id: "",
      platform_id: "",
      title: "",
      package_name: "",
      short_descr: "",
      descr: "",
      logo: "",
      promo_video_link: "",
      firebase_api_key: "",
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
        this.logo = event.target.result;
        console.log(event.target.result);
      };
      reader.readAsDataURL(file);
    },

    getData() {
      this.$Progress.start();
      axios({ method: "GET", url: "/api/apps" }).then(
        result => {
          console.log(result.data);
          this.apps = result.data;
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
          .post("/api/apps", {
            title: this.title,
            platform_id: this.platform_id,
            package_name: this.package_name,
            short_descr: this.short_descr,
            logo: this.logo,
            descr: this.descr,
            firebase_api_key: this.firebase_api_key,
            promo_video_link: this.promo_video_link
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
          .put(`/api/apps/${this.id}`, {
            title: this.title,
            platform_id: this.platform_id,
            package_name: this.package_name,
            short_descr: this.short_descr,
            logo: this.logo,
            descr: this.descr,
            firebase_api_key: this.firebase_api_key,
            promo_video_link: this.promo_video_link
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

    editData(app) {
      this.id = app.id;
      this.title = app.title;
      this.platform_id = app.platform_id;
      this.package_name = app.package_name;
      this.short_descr = app.short_descr;
      this.descr = app.descr;
      this.firebase_api_key = app.firebase_api_key;
      this.promo_video_link = app.promo_video_link;
      this.edit = true;
    },

    deleteData(id) {
      if (confirm("Are You Sure?")) {
        axios
          .delete(`/api/apps/${id}`)
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
      this.platform_id = "";
      this.package_name = "";
      this.short_descr = "";
      this.descr = "";
      this.logo = "";
      this.firebase_api_key = "";
      this.promo_video_link = "";
      this.$refs.fileInput.value = "";
    }
  }
};
</script>

<style lang="scss" scoped></style>
