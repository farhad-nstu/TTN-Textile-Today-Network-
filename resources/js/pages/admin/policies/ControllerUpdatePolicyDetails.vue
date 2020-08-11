<template>
  <div>
    <LeftSidebar/>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <HeaderBar/>
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card shadow mb-4">

                <div class="card-header py-3">
                  <p class="text-center h3 text-primary font-weight-bold">Update policy details</p>
                  <!-- <h6 class="m-0 font-weight-bold text-primary float-left">Update policy details</h6> -->
                </div>
                <div class="card-body">
                  <form @submit.prevent="update_policy_details">
                    <div class="form-group">
                      <label class="font-weight-bold">Section name</label>
                      <input name="name" type="text" v-model="section_name" class="form-control" placeholder required />
                    </div>
                    <div class="form-group">
                      <label class="font-weight-bold">Description</label>
                      <input type="text" class="form-control" id="summernote_div" v-model="details">
                    </div>
                    <div class="form-group">
                      <label class="font-weight-bold">Mentionable link</label>
                      <input name="name" type="text" v-model="mentionable_link" class="form-control" placeholder required />
                    </div>
                    <div class="form-group py-2">
                      <label class="font-weight-bold">Status</label>
                      <select class="form-control" v-model="status" required>
                        <option v-for="(status, index) in statuses" :key="status" :value="index">
                          {{ status }}
                        </option>
                      </select>
                    </div>
                    <div>
                      <button type="submit" class="btn btn-primary">Update</button>
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
import ScriptLoader from '@/mixins/ScriptLoader';

export default {
  name: 'ControllerUpdatePolicyDetails',
  mixins: [ScriptLoader],
  components: {
    HeaderBar,
    LeftSidebar,
    FooterBar,
  },
  data() {
    return {
      section_name: "",
      details: "",
      status: "",
      mentionable_link: "",
      statuses: {},
    };
  },

  mounted() {
    this.loadStyleSheets("controller_summernote");
    this.loadJsScripts("controller_summernote");
    this.init();
    this.get_data();
  },

  methods: {
    get_data() {
      this.$Progress.start();
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')
      let policy_details_id = window.location.href.split('/').pop();
      axios({ method: "GET", url: "/api/show-policy-details/" + policy_details_id }).then(
        response => {
          let policyDetail = response.data.policyDetail;
          this.statuses = response.data.statuses;
          this.section_name = policyDetail.section_name;
          this.details = policyDetail.details;
          this.mentionable_link = policyDetail.mentionable_link;
          this.status = policyDetail.status;
          $("#summernote_div").summernote("code", this.details);
        },
        error => {
          console.error(error);
        }
      );
      this.$Progress.finish();
    },

    init(){
      var vueData = this;
      $(document).ready(() => {
        $('#summernote_div').on('summernote.change', function(we, contents, $editable) {
            vueData.details = contents;
        });
      });
    },

    update_policy_details(id) {
      let policy_detail_id = window.location.href.split('/').pop();
      axios.put(`/api/update-policy-details/${policy_detail_id}`, {
        section_name: this.section_name,
        details: this.details,
        mentionable_link: this.mentionable_link,
        status: this.status,
      })
      .then(result => {
        if(result.data.response == "success"){
          this.flash(result.data.message , 'success', {
            timeout: 3000,
          });
          this.$router.go(-1);
        } else {
          this.flash(result.data.message , 'warning', {
            timeout: 3000,
          });
        }
      })
    },    
  }
};
</script>

<style lang="scss" scoped></style>
