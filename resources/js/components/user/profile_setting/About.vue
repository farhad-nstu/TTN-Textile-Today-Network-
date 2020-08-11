<template>
    <div>
        <div class="row">
            <div class="col-12">
                <div class="post-topbar">
                    <ul class="nav nav-pills card-header-pills" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="BasicInformation-tab" data-toggle="tab" href="#BasicInformation" role="tab" aria-controls="BasicInformation" aria-selected="true">Basic Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                        </li>                
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="BasicInformation" role="tabpanel" aria-labelledby="BasicInformation-tab">                                                     
                        <div class="post-bar">
                            <div class="col-12">
                                <a href="#" @click="edit_data" class="float-right" data-toggle="modal" data-target="#edit-info">
                                        <i class="fas fa-pen"></i>
                                </a>
                                <h3 class=" ">User Information</h3>                                           
                            </div>
                            <div class="user-profile-ov">
                                <h3 >Contact</h3>
                                <ul>
                                    <li><p class="font-weight-bold " style="width: 4rem;"> Name : </p > {{userData.name}}</li>
                                    <br>
                                    <li><p class="font-weight-bold " style="width: 4rem;"> Contact : </p> <p><i class="fas fa-phone float-left mr-2"></i>{{userData.phone}}</p>, &nbsp; <p> <i class="fas fa-envelope-open-text float-left mr-2"></i> {{userData.email}} </p></li>
                                    <br>
                                    <li><p class="font-weight-bold " >Date of Birth :</p> {{userData.date_of_birth}}</li>
                                    <br>
                                    <li><p class="font-weight-bold " >About Yourself :</p> {{userData.about_yourself}}</li>
                                    <br>
                                    <li><p class="font-weight-bold " style="width: 4rem;">Address:</p> {{userData.address}}</li>
                                    <br>
                                    <li><p class="font-weight-bold " >Billing Address : :</p> {{userData.billing_address}}</li>
                                    <br>                       
                                </ul>                                    
                            </div>
                            <div>
                                <h3 >Social Links</h3>
                               <ul class="social_links">
                                    <li  v-if="userData.facebook_link"> <a  href="userData.facebook_link"> <img src="/images/icons/fb.png" width="30px" class="m-2"> <p class="mt-2">{{userData.facebook_link}}</p></a></li>
                                    <li  v-if="userData.twitter_link"> <a  href="userData.twitter_link"> <img src="/images/icons/twitter.png" width="30px" class="m-2"><p class="mt-2">{{userData.twitter_link}}</p> </a></li>
                                    <li  v-if="userData.instagram_link"><a href="userData.instagram_link"> <img src="/images/icons/instagram.png" width="30px" class="m-2"><p class="mt-2">{{userData.instagram_link}}</p>  </a></li>           
                                    <li v-if="userData.youtube_link"> <a   href="userData.youtube_link"> <img src="/images/icons/youtube.png" width="30px" class="m-2"><p class="mt-2">{{userData.youtube_link}} </p></a></li> 
                                    <li v-if="userData.linkedin_link"><a   href="userData.linkedin_link"> <img src="/images/icons/linkedin.png" width="30px" class="m-2"><p class="mt-2">{{userData.linkedin_link}}</p>  </a></li>      
                                    <li v-if="userData.website"><a href="userData.website"> <img src="/images/icons/global.png" width="30px" class="m-2"><p class="mt-2">{{userData.website}}</p> </a></li>                                      
                                </ul>     
                            </div>
                        </div>
                        <div class="modal fade" id="edit-info" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <p class="modal-title text-white text-center h5" id="exampleModalScrollableTitle">Edit Information</p>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form  @submit.prevent="update_user_basic_Info">                      
                                        <div class="cp-field">
                                            <h5>Name</h5>
                                            <div class="cpp-fiel">
                                                <input type="text" v-model="name" placeholder="Name" required>
                                                <i class="la la-globe"></i>
                                            </div>
                                        </div>
                                        <div class="cp-field col-6">
                                            <h5>Phone</h5>
                                            <div class="cpp-fiel">
                                                <input type="tel" v-model="phone" placeholder="phone" required>
                                                <i class="la la-globe"></i>
                                            </div>
                                        </div>
                                        <div class="cp-field col-6">
                                            <h5>Alternate phone</h5>
                                            <div class="cpp-fiel">
                                                <input type="tel" v-model="alternate_phone" placeholder="phone">
                                                <i class="la la-globe"></i>
                                            </div>
                                        </div>                                       
                                        <div class="cp-field col-4">
                                            <h5>Country Name</h5> 
                                             <select v-model="country_id" name="country_id" class="form-control"  @change="load_states" required>
                                                <option v-for="(country, index) in countries" v-bind:key="index" :value="index">{{ country }}</option>
                                            </select>                 
                                        </div>
                                        <div class="cp-field col-4">
                                            <h5>State Name</h5>                 
                                             <select v-model="state_id" name="state_id" class="form-control" @change="load_city" required>
                                                <option  v-for="(state, index) in states" v-bind:key="index" :value="index" >{{state }}</option>
                                            </select>
                                        </div>
                                        <div class="cp-field col-4">
                                            <h5>City Name</h5>                 
                                            <select v-model="city_id" class="form-control" name="city_id" required>
                                                <option v-for="(city, index) in cities" v-bind:key="index" :value="index">{{ city }}</option>
                                            </select>
                                        </div>
                                        <div class="cp-field col-6">
                                            <h5>Post Code</h5>
                                            <div class="cpp-fiel">
                                                <input type="text" v-model="post_code" placeholder="">
                                                <i class="la la-globe"></i>
                                            </div>
                                        </div>
                                        <div class="cp-field col-6">
                                            <h5>Date fo birth</h5>
                                            <div class="cpp-fiel">
                                                <input type="date" v-model="date_of_birth" >
                                                <i class="la la-globe"></i>
                                            </div>
                                        </div>
                                        <div class="cp-field">
                                            <h5>Address</h5>
                                            <div class="cpp-fiel">
                                                <input type="text" v-model="address" placeholder="">
                                                <i class="la la-globe"></i>
                                            </div>
                                        </div>
                                        <div class="cp-field">
                                            <h5>About Yourself</h5>
                                            <div class="cpp-fiel">
                                                <textarea v-model="about_yourself" id="" cols="30" rows="3"></textarea>                               
                                            </div>
                                        </div>
                                        <div class="cp-field">
                                            <h5>Billing Address</h5>
                                            <div class="cpp-fiel">
                                                <input type="text" v-model="billing_address" placeholder="">
                                            <i class="la la-globe"></i>                       
                                            </div>
                                        </div>
                                        <div class="cp-field">
                                            <h5>Alternate Billing Address</h5>
                                            <div class="cpp-fiel">
                                                <input type="text" v-model="alternate_billing_address" placeholder="">
                                                <i class="la la-globe"></i>
                                            </div>
                                        </div> 
                                        <div class="cp-field">
                                            <h5>Facebook Link</h5>
                                            <div class="cpp-fiel">
                                                <input type="text" v-model="facebook_link" placeholder="">
                            
                                                <i class="la la-globe"></i>
                                            </div>
                                        </div>
                                        <div class="cp-field">
                                            <h5>Twitter Link</h5>
                                            <div class="cpp-fiel">
                                                <input type="text" v-model="twitter_link" placeholder="">                                   
                                                <i class="la la-globe"></i>
                                            </div>
                                        </div>
                                        <div class="cp-field">
                                            <h5>LinkedIn Link</h5>
                                            <div class="cpp-fiel">
                                                <input type="text" v-model="linkedin_link" placeholder="">                                   
                                                <i class="la la-globe"></i>
                                            </div>
                                        </div>
                                        <div class="cp-field">
                                            <h5>Instagram Link</h5>
                                            <div class="cpp-fiel">
                                                <input type="text" v-model="instagram_link" placeholder="">
                            
                                                <i class="la la-globe"></i>
                                            </div>
                                        </div>
                                        <div class="cp-field">
                                            <h5>Youtube Link</h5>
                                            <div class="cpp-fiel">
                                                <input type="text" v-model="youtube_link" placeholder="">
                            
                                                <i class="la la-globe"></i>
                                            </div>
                                        </div>
                                        <div class="cp-field">
                                            <h5>Website</h5>
                                            <div class="cpp-fiel">
                                                <input type="text" v-model="website" placeholder="">
                            
                                                <i class="la la-globe"></i>
                                            </div>
                                        </div>
                                        <div class="modal-footer ">
                                            <button type="submit" class="btn btn-light m-5 float-right">Save</button>
                                            <button  class="btn btn-light mt-5 float-right" data-dismiss="modal">Close</button>
                                        </div>
                                    </form> 
                                </div>                               
                                </div>
                            </div>
                        </div>                                                               
                    </div> 
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">                                               
                            <CoverPic/>
                    <div class="col-6">
                            <ProfilePic/>                      
                    </div>
                    </div> 
                </div>                   
                                           
            </div>
        </div>                                       
    </div>
</template>
<script>
import CoverPic from '@/components/user/user_profile/CoverPic';
import ProfilePic from '@/components/user/user_profile/ProfilePic'
export default {
    name: 'About',
    components: {
        CoverPic,
        ProfilePic,
	},
    data() {
        return { 
            userData: {},
            countries: {},
            states: {},
            cities: {},
            name: "",
            phone: "",
            alternate_phone: "",
            date_of_birth:"",
            country_id:0,
            state_id :0,
            city_id :0,
            post_code :"",
            address :"",
            about_yourself :"",
            billing_address :"",
            alternate_billing_address :"",
            facebook_link :"",
            twitter_link :"",
            linkedin_link :"",
            instagram_link :"",
            youtube_link :"",
            website :"",
            profile_picture: "",
            background_banner: "",
            success: "",
            newPic: false,
            newCoverPic:false,
            picUpdate:false,
            coverUpdate:false,
        };
    },
     mounted() {
      this.userData =JSON.parse(localStorage.getItem('TTNetwork.user'));
      this.load_countries();
    },
  methods: {
    load_countries() {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
        axios({ method: "GET", url: "/api/get-countries"}).then(
            result => {
            this.countries = result.data.countries;
            console.log(this.countries);
            },
            error => {
            console.error(error);
            }
        );
    },
    load_states() {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
        axios({ method: "GET", url: "/api/get-states/"+ this.country_id }).then(
            result => {
            console.log(result.data);
            this.states = result.data;
            this.cities = null;				
            },
            error => {
            console.error(error);
            }
        );
    },
    load_city() {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
        axios({ method: "GET", url: "/api/get-cities/"+this.state_id}).then(
            result => {
            console.log(result.data);
            this.cities = result.data;				
            },
            error => {
            console.error(error);
            }
        );		
    },
    update_user_basic_Info() {
        axios
          .put("/api/update-user-basic-Info/"+JSON.parse(localStorage.getItem('TTNetwork.user')).id, {
            name: this.name,
            phone: this.phone,
            alternate_phone: this.alternate_phone,
            date_of_birth: this.date_of_birth,
            country_id : this.country_id,
            state_id : this.state_id,
            city_id : this.city_id,
            post_code : this.post_code,
            address : this.address,
            about_yourself :this.about_yourself,
            billing_address : this.billing_address,
            alternate_billing_address : this.alternate_billing_address,
            facebook_link : this.facebook_link,
            twitter_link : this.twitter_link,
            linkedin_link : this.linkedin_link,
            instagram_link : this.instagram_link,
            youtube_link : this.youtube_link,
            website : this.website,
          })
          .then(res => {
              if(res.data.response = "success"){
                this.clear_data();
               	localStorage.setItem("TTNetwork.user", JSON.stringify(res.data.user));					
                this.userData =JSON.parse(localStorage.getItem('TTNetwork.user'));             
                toast.fire({icon: "info", title: res.data.message});
                $('#edit-info').modal('hide');                 
              }else{
                 toast.fire({icon: "info", title: res.data.message});                 
              }
          })
          .catch(err => {
            toast.fire({icon: "info", title: "Please insert valid inoformation!!!!"});                 
            console.log(err);
          });
    },
    edit_data(){
       this.name = this.userData.name;
       this.phone = this.userData.phone;
       this.alternate_phone = this.userData.alternate_phone;
       this.date_of_birth = this.userData.date_of_birth;
       this.country_id = this.userData.country_id;
       this.state_id = this.userData.state_id;
       this.city_id = this.userData.city_id;
       this.post_code = this.userData.post_code;
       this.address = this.userData.address;
       this.about_yourself =this.userData.about_yourself;
       this.billing_address = this.userData.billing_address;
       this.alternate_billing_address = this.userData.alternate_billing_address;
       this.facebook_link = this.userData.facebook_link;
       this.twitter_link = this.userData.twitter_link;
       this.linkedin_link = this.userData.linkedin_link;
       this.instagram_link = this.userData.instagram_link;
       this.youtube_link = this.userData.youtube_link;
       this.website = this.userData.website;
    },      
    clear_data(){
       this.name = "";
       this.phone = "";
       this.alternate_phone = "";
       this.date_of_birth = "";
       this.country_id = 0;
       this.state_id = 0;
       this.city_id = 0;
       this.post_code = "";
       this.address = "";
       this.about_yourself = "";
       this.billing_address = "";
       this.alternate_billing_address = "";
       this.facebook_link = "";
       this.twitter_link = "";
       this.linkedin_link = "";
       this.instagram_link = "";
       this.youtube_link = "";
       this.website = "";
      },
    }
}
</script>