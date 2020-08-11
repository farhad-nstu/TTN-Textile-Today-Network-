<template>
  <div>
    <LeftSidebar />
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <HeaderBar />
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
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
                    <div class="row">
                      <div class="form-group col">
                        <label class="req">Job Type</label>
                        <select class="form-control" v-model="job_type_id" required>
                          <option
                            v-for="jobType in jobTypes"
                            :value="jobType.id"
                          >{{ jobType.title }}</option>
                        </select>
                      </div>

                      <!-- <div class="form-group">
                <label class="req">Organization</label>
                <select class="form-control" v-model="job_type_id" required>
                  <option v-for="jobType in jobTypes" :value="jobType.id">{{ jobType.title }}</option>
                </select>
                      </div>-->

                      <div class="form-group col">
                        <label class="req">Total Vacancy</label>
                        <input
                          type="text"
                          class="form-control"
                          v-model="total_vacancy"
                          placeholder
                          required
                        />
                      </div>

                      <div class="form-group col">
                        <label class="req">Application Deadline</label>
                        <input
                          type="date"
                          class="form-control"
                          v-model="application_deadline"
                          placeholder
                          required
                        />
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group col">
                        <label class="req">Salary Range</label>
                        <input
                          type="text"
                          class="form-control"
                          v-model="salary_range"
                          placeholder="10000 - 20000"
                          required
                        />
                      </div>
                      <div class="form-group col">
                        <label class="req">Prefered Gender</label>
                        <select class="form-control" v-model="preferred_gender" required>
                          <option>Select Gender</option>
                          <option value="1">Male</option>
                          <option value="2">Female</option>
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label class="req">Experience</label>
                          <div class="row">
                            <div class="col">
                              <input
                                type="text"
                                class="form-control"
                                v-model="minimum_experience"
                                placeholder="min experience"
                                required
                              />
                            </div>
                            <div class="col">
                              <input
                                type="text"
                                class="form-control"
                                v-model="maximum_experience"
                                placeholder="max experience"
                                required
                              />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label class="req">Age</label>
                          <div class="row">
                            <div class="col">
                              <input
                                type="text"
                                class="form-control"
                                v-model="minimum_age"
                                placeholder="min age"
                                required
                              />
                            </div>
                            <div class="col">
                              <input
                                type="text"
                                class="form-control"
                                v-model="maximum_age"
                                placeholder="max age"
                                required
                              />
                            </div>
                          </div>
                        </div>
                      </div>
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

                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label class="req">Job Location</label>
                          <input
                            type="text"
                            class="form-control"
                            v-model="job_location"
                            placeholder
                            required
                          />
                        </div>
                      </div>

                      <div class="col">
                        <div class="form-group">
                          <label class="req">Status</label>
                          <select class="form-control" v-model="status" required>
                            <option v-for="(status, index) in statuses" :value="index">{{ status }}</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success">Publish</button>
                    <button @click="clearForm()" class="btn btn-danger">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <FooterBar />
  </div>
</template>

<script>
import axios from "axios";

import HeaderBar from "@/components/admin/HeaderBar";
import LeftSidebar from "@/components/admin/LeftSidebar";
import FooterBar from "@/components/admin/FooterBar";
import ScriptLoader from "@/mixins/ScriptLoader";
export default {
  mixins: [ScriptLoader],
  name: "ControllerJobCreate",
  components: {
    HeaderBar,
    LeftSidebar,
    FooterBar
  },
  data() {
    return {
      jobTypes: {},
      statuses: {},
      job_type_id: "0",
      title: "",
      job_location: "",
      total_vacancy: "",
      application_deadline: "",
      salary_range: "",
      minimum_experience: "",
      maximum_experience: "",
      minimum_age: "",
      maximum_age: "",
      preferred_gender: "",
      responsibilities: "",
      requirements: "",
      other_benefits: "",
      special_instruction: "",
      status: "20"
    };
  },

  mounted() {
    var page = window.location.href.split("/").pop();
    this.loadStyleSheets(page);
    this.loadJsScripts(page);
    this.getData();
  },

  methods: {
    getData() {
      this.$Progress.start();
      axios({ method: "GET", url: "/api/jobs" }).then(
        result => {
          console.log(result.data);
          this.jobTypes = result.data.jobTypes;
          this.statuses = result.data.status;
        },
        error => {
          console.error(error);
        }
      );
      this.$Progress.finish();
    },

    addUpdate() {
      axios
        .post("/api/jobs", {
          job_type_id: this.job_type_id,
          title: this.title,
          job_location: this.job_location,
          total_vacancy: this.total_vacancy,
          application_deadline: this.application_deadline,
          salary_range: this.salary_range,
          minimum_experience: this.minimum_experience,
          maximum_experience: this.maximum_experience,
          minimum_age: this.minimum_age,
          maximum_age: this.maximum_age,
          preferred_gender: this.preferred_gender,
          responsibilities: this.responsibilities,
          requirements: this.requirements,
          other_benefits: this.other_benefits,
          special_instruction: this.special_instruction,
          status: this.status
        })
        .then(res => {
          this.clearForm();
          toast.fire({
            icon: "success",
            title: "Saved!"
          });
        })
        .catch(er => {
          console.log(err);
        });
    },

    clearForm() {
      this.job_type_id = null;
      this.title = null;
      this.job_location = null;
      this.total_vacancy = null;
      this.application_deadline = null;
      this.salary_range = null;
      this.minimum_experience = null;
      this.maximum_experience = null;
      this.minimum_age = null;
      this.maximum_age = null;
      this.preferred_gender = null;
      this.responsibilities = null;
      this.requirements = null;
      this.other_benefits = null;
      this.special_instruction = null;
      this.status;
    }
  }
};
</script>

<style lang="scss" scoped></style>
