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
                  <p class="text-center h3 text-primary font-weight-bold">New organization</p>
                </div>
                <div class="card-body">
                  <form @submit.prevent="addOrganization" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label class="req">Name</label>
                          <input name="name" type="text" v-model="name" class="form-control" placeholder="Name" required />
                        </div>
                        <div class="form-group">
                          <label class="req">Short Details</label>
                          <input type="text" v-model="short_details" class="form-control" required />
                        </div>
                        <div class="form-group">
                          <label>Email</label>
                          <input type="email" v-model="email" class="form-control" />
                        </div>
                        <div class="form-group">
                          <label>Phone</label>
                          <input type="text" v-model="phone" class="form-control" placeholder />
                        </div>
                        <div class="form-group">
                          <label class="req">Address</label>
                          <input type="text" v-model="address" class="form-control" required />
                        </div>
                      </div>
                      <div class="col-sm-6">	
                        <div class="form-group">
                          <label>Website</label>
                          <input type="text" v-model="website" class="form-control" placeholder="http://" />
                        </div>
                        <div class="form-group">
                          <label>Fax</label>
                          <input type="text" v-model="fax" class="form-control" placeholder />
                        </div>
                        <div class="form-group">
                          <label>Logo</label>
                          <br />
                          <input type="file" class="form-control-file" @change="takeImage" ref="fileInput" />
                        </div>
                        <div class="form-group">
                          <label class="req">Status</label>
                          <select class="form-control" v-model="status" required>
                            <option v-for="(status, index) in statuses" :key="status" :value="index">
                              {{ status }}
                            </option>
                          </select>
                        </div>
                        <div>
                          <button type="submit" class="btn btn-sm btn-success">Save</button>
                        </div>                      
                      </div>
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
  name: 'ControllerAddOrganization',
  mixins: [ScriptLoader],
  components: {
    HeaderBar,
    LeftSidebar,
    FooterBar,
  },
  data() {
    return {
      id: "",
      name: "",
      short_details: "",
      website: "",
      phone: "",
      fax: "",
      email: "",
      address: "",
      company_logo: "",
      statuses: {},
    };
  },

  mounted() {
    this.loadStyleSheets("controller");
    this.loadJsScripts("controller");
    this.getData();
  },

  methods: {
    takeImage(event) {
      let file = event.target.files[0];
      let reader = new FileReader();
      reader.onload = event => {
        this.company_logo = event.target.result;
        console.log(event.target.result);
      };
      reader.readAsDataURL(file);
    },
    getData() {
      this.$Progress.start();
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')     
      axios({ method: "GET", url: "/api/organizations"}).then(
        result => {
          this.statuses = result.data.status;
        },
        error => {
          console.error(error);
        }
      );
      this.$Progress.finish();
    },

    addOrganization() {
      axios.post("/api/organizations" ,{
        user_id: JSON.parse(localStorage.getItem("TTNetwork.user")).id,
        name: this.name,
        short_details: this.short_details,
        website: this.website,
        phone: this.phone,
        fax: this.fax,
        email: this.email,
        address: this.address,
        status: this.status,
        company_logo: this.company_logo
      })
      .then(res => {
        this.user_id = "";
        this.name = "";
        this.short_details = "";
        this.website = "";
        this.phone = "";
        this.fax = "";
        this.email = "";
        this.address = "";
        this.company_logo = "";
        this.status = "";
        this.$router.go(-1);
      })
      .catch(er => {
        console.log(err);
      });
		},			
  },
};
</script>
<style lang="scss" scoped></style>
