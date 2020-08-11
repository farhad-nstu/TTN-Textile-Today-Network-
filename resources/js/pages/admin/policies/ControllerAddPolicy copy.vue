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

                <div class="card-header py-3">
                  <p class="text-center h3 text-primary font-weight-bold">New Policy</p>
                  <!-- <h6 class="m-0 font-weight-bold text-primary float-left">New Policy</h6> -->
                </div>
                <div class="card-body">
                  <form @submit.prevent="addPolicies">
                    <div class="form-group">
                      <label class="req">Tile</label>
                      <input
                        name="name"
                        type="text"
                        v-model="title"
                        class="form-control"
                        placeholder
                        required
                      />
                    </div>
                    <div class="form-group">
                      <label class="req"><b>Description</b></label>
                      <!-- <Vue-trix
                        class="trix-content" 
                        v-model="descr"
                        localStorage
                      ></Vue-trix> -->
                    </div>                  
                    <div class="form-group">
                      <label class="req">Applicable from</label>
                      <input
                        name="name"
                        type="date"
                        v-model="applicable_from"
                        class="form-control"
                        placeholder
                        required
                      />
                    </div>
                    <div class="form-group">
                      <label class="req">Unique code for selection</label>
                      <input
                        name="name"
                        type="text"
                        v-model="unique_code"
                        class="form-control"
                        placeholder
                        required
                      />
                    </div>
                    <div class="form-group">
                      <label class="status">Status</label>
                      <select class="form-control" v-model="status" required>
                        <option v-for="(status, index) in statuses" :key="status" :value="index">
                          {{
                          status
                          }}
                        </option>
                      </select>
                    </div>
                    <div>
                      <button type="submit" class="btn btn-success">Save</button>
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
// import VueTrix from "vue-trix";
export default {
  name: 'AddPolicy',
  mixins: [ScriptLoader],
  components: {
    HeaderBar,
    LeftSidebar,
    FooterBar,
    VueTrix,
  },

  data() {
    return {
      policies: {},
      id: "",
      unique_code: "",
      user_id: "",
      title: "",
      descr: "",
      applicable_from: "",
      statuses: {},
      status: "10",
      edit: false
    };
  },

  mounted() {
    var page = "add-policy";
    this.loadStyleSheets(page);
    this.loadJsScripts(page);
    this.getData();    
  },

  init(){
    alert('here...');
  },

  methods: {
    getData(page = 1) {
      this.$Progress.start();
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')
      axios({ method: "GET", url: "/api/policy-index?page=" + page }).then(
        response => {
          this.policies = response.data.policies;
          this.statuses = response.data.statuses;
        },
        error => {
          console.error(error);
        }
      );
      this.$Progress.finish();
    },

    addPolicies() {
      axios.post("/api/policy-index", {
        user_id: JSON.parse(localStorage.getItem("TTNetwork.user")).id,
        unique_code: this.unique_code,
        title: this.title,
        descr: this.descr,
        applicable_from: this.applicable_from,
        status: this.status,
      })
      .then(res => {
        this.unique_code = "";
        this.title = "";
        this.descr = "";
        this.applicable_from = "";
        this.status = "";
        this.$router.go(-1);
      })
    } 
  },
};
</script>

<style lang="scss" scoped></style>
