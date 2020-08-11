<template>
  <div>
    <div class="wrapper">

      <div v-if="user">         
        <Header /> 
          <section class="profile-account-setting">
            <div class="container-fluid">
              <div class="account-tabs-setting">
                <div class="row">
        
                  <div class="col-lg-3">
                    <div class="acc-leftbar">
                      <div class="nav nav-tabs" id="nav-tab" role="tablist" v-for="data in policies" v-bind:key="data.id">
                        <a href="#Signup" 
                          @click="clicked(data.id)"
                          class="font-weight-bold border-bottom btn-primary h2" style="color: #007bff;" :class="{'active text-white': data.id == policy.id}" >
                          {{ data.title }}
                        </a>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-9">
                    <div class="post-bar"> 
                      <div class="row">
                        <p class="text-justify font-weight-bold text-primary h3"> {{policy.title}}</p> 
                      </div>
                      <div class="row mb-4">
                        <p class="" v-html="policy.descr"></p> 
                      </div>              
                      <div class="mb-4" v-for="policyDetail in policy.policy_details" v-bind:key="policyDetail.id">
                        <div class="row">
                          <p class="text-justify font-weight-bold text-primary h6 p-0">{{policyDetail.section_name}}</p> <br>                             
                        </div> 
                        <div class="row mb-2">
                          <p class="" v-html="policyDetail.details"></p>
                        </div>  
                      </div>                              
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </section>
        <Footer />   
      </div> 

      <div v-else>
        <LandingPageHeader />   
          <section class="profile-account-setting mt-5 pt-5">
            <div class="container-fluid">
              <div class="account-tabs-setting">
                <div class="row">

                  <div class="col-lg-3 pr-4">
                    <div class="acc-leftbar">
                      <div class="nav nav-tabs" id="nav-tab" role="tablist" v-for="data in policies" v-bind:key="data.id">
                        <a href="#Signup" 
                          @click="clicked(data.id)"
                          class="font-weight-bold h4" :class="{'active text-white': data.id == policy.id}" >
                          {{ data.title }}
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-9">
                    <div class="post-bar">
                      <div class="row">                     
                        <p class="text-justify font-weight-bold text-primary h3"> {{policy.title}}</p>  
                        <div class="col">
                          <router-link to="/sign-up">
                            <button class="btn btn-sm btn-primary float-right">Join now</button>
                          </router-link>
                        </div>
                      </div> 
                      <div class="row mb-4"> 
                          <p v-html="policy.descr"></p>             
                      </div>
                      <div class="mb-4" v-for="policyDetail in policy.policy_details" v-bind:key="policyDetail.id">
                        <div class="row">
                          <p class="text-justify font-weight-bold text-primary h6 p-0">{{policyDetail.section_name}}</p> <br>
                        </div>
                        <div class="row mb-2">
                           <p class="details" v-html="policyDetail.details"></p>                           
                        </div>
                      </div>
                    </div>                   
                  </div>

                </div>
              </div>
            </div> 
          </section> 
        <LandingPageFooter />
      </div>
  
    </div>
  </div>
</template>

<script>
import Header from "@/components/user/Header";
import Footer from "@/components/user/Footer";
import LandingPageHeader from "@/components/user/LandingPageHeader";
import LandingPageFooter from "@/components/user/LandingPageFooter";
import ScriptLoader from '@/mixins/ScriptLoader';
export default {
  name: 'Policy',
  mixins: [ScriptLoader],
  components: {
    Header,
    Footer,
    LandingPageHeader,
    LandingPageFooter,
  },

  data() {
    return {
      policies: {},
      policy: {},
      id: "",
      user: "",
      Signup: "",
    };
  },

  mounted() {
    this.user = JSON.parse(localStorage.getItem('TTNetwork.user'));
    // this.loadStyleSheets("user");
    // this.loadJsScripts("user");
    if(this.user){
      this.loadStyleSheets("user");
      this.loadJsScripts("user");
    } else {
      this.loadStyleSheets("controller");
      this.loadJsScripts("controller");
    }   
    this.getData();
    this.clicked(1);
  },

  methods: {
    getData() {
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')
      axios({ method: "GET", url: "/api/policies"}).then(
        response => {
          console.log(response.data);
          this.policies = response.data.policies;
        },
        error => {
        console.error(error);
        }
      );
    },

    clicked(id) {    
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')
      axios({ method: "GET", url: "/api/policy/" + id}).then(
        response => {
          this.policy = response.data.policy;
          console.log(this.policy);
        },
        error => {
          console.error(error);
        }
      );      
    },
  }
};
</script>
<style scoped>

</style>
