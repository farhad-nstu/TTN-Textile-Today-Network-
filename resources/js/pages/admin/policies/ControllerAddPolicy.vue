<template>
  <div>
    <LeftSidebar/>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <HeaderBar/>
        <div class="container-fluid" >
          <div class="row">
            <div class="col-md-12">
              <div class="card shadow mb-4">
                <flash-message class="myCustomClass"></flash-message>
                <div class="card-header py-3">
                  <p class="text-center h3 text-primary font-weight-bold">New Policy</p>
                  <!-- <h6 class="m-0 font-weight-bold text-primary float-left">New Policy</h6> -->
                </div>
                <div class="card-body">
                  <form @submit.prevent="add_policy">
                    <div class="form-group">
                      <label class="req">Title</label>
                      <input name="name" type="text" v-model="title" class="form-control" />
                    </div>
                    <div class="form-group">
                      <label class="req"><b>Description</b></label>
                      <input type="text" class="form-control" id="summernote_div" v-model="descr">
                    </div>
                    <div class="form-group">
                      <label class="req">Applicable from</label>
                      <input name="name" type="date" v-model="applicable_from" class="form-control" />
                    </div>
                    <div class="form-group">
                      <label class="req">Unique code for selection</label>
                      <input name="name" type="text" v-model="unique_code" class="form-control" />
                    </div>
                    <div class="form-group">
                      <label class="status">Status</label>
                      <select class="form-control" v-model="status">
                        <option v-for="(status, index) in statuses" :key="status" :value="index">
                          {{ status }}
                        </option>
                      </select>
                    </div>
                    <div>
                      <button type="submit" class="btn btn-primary">Save</button>
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
import VueFlashMessage from 'vue-flash-message';
require('vue-flash-message/dist/vue-flash-message.min.css');

export default {
  name: 'ControllerAddPolicy',
  mixins: [ScriptLoader],
  components: {
    HeaderBar,
    LeftSidebar,
    FooterBar,
  },

  data() {
    return {
      id: "",
      unique_code: "",
      user_id: "",
      title: "",
      descr: "",
      applicable_from: "",
      statuses: {},
      status: "",
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
      axios({ method: "GET", url: "/api/policy-index"}).then(
        response => {
          this.statuses = response.data.statuses;
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
            vueData.descr = contents;
            console.log(vueData.descr);
        });
      });
    },

    add_policy() {
        axios.post("/api/policy-index", {
        user_id: JSON.parse(localStorage.getItem("TTNetwork.user")).id,
        unique_code: this.unique_code,
        title: this.title,
        descr: this.descr,
        applicable_from: this.applicable_from,
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
        this.unique_code = "";
        this.title = "";
        this.descr = "";
        this.applicable_from = "";
        this.status = "";
      });
    }
  },
};
</script>

<style lang="scss" scoped></style>
