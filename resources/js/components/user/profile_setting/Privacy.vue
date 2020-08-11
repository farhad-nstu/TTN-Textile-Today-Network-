<template>
    <div>
         <form class="radio-form" @submit.prevent="change_user_Privacy">
        <div class="row">
            <div class="col-12">
            <h3>Privacy</h3>
        </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
              <div class="dropdown privacydropd">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Who can see your community</a>
                    <div class="dropdown-menu">
                        <p>Choose who can see your community</p>
                        <div class="row">
                            <div class="col-md-9 col-sm-12">
                                

                                <div class="custom-control custom-checkbox">
                                    <input type="radio"  v-model="communityStatus" value="20">
                                    <label>Everyone</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="radio"   v-model="communityStatus" value="10">
                                    <label >Friends</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="radio" v-model="communityStatus" value="0">
                                    <label>Only Me</label>
                                </div>
                             

                            </div>
                            <div class="col-md-3 col-sm-12">
                                <p v-if="communityStatus == 0" style="float: right;">Only Me</p>
                                <p v-if="communityStatus == 10" style="float: right;">Friends</p>
                                <p v-if="communityStatus == 20" style="float: right;">Everyone</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
        <hr>
        <div class="row">
            <div class="col-12">                
              <div class="dropdown privacydropd">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Who can see your working history</a>
                    <div class="dropdown-menu">
                        <p>Choose who can see your working history</p>
                        <div class="row">
                            <div class="col-md-9 col-sm-12">
                               
                                <div class="custom-control custom-checkbox">
                                    <input type="radio"  v-model="workingHistoryStatus" value="20">
                                    <label>Everyone</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="radio"   v-model="workingHistoryStatus" value="10">
                                    <label >Friends</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="radio" v-model="workingHistoryStatus" value="0">
                                    <label>Only Me</label>
                                </div>
                           
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <p v-if="workingHistoryStatus == 0" style="float: right;">Only Me</p>
                                <p v-if="workingHistoryStatus == 10" style="float: right;">Friends</p>
                                <p v-if="workingHistoryStatus == 20" style="float: right;">Everyone</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
        <hr>
        <div class="row">
            <div class="col-12">
              <div class="dropdown privacydropd">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Who can see your sosical links</a>
                    <div class="dropdown-menu">
                        <p>Choose who can see your social links</p>
                        <div class="row">
                            <div class="col-md-9 col-sm-12">
                               
                                <div class="custom-control custom-checkbox">
                                    <input type="radio"  v-model="socialLinkStatus" value="20">
                                    <label>Everyone</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="radio"   v-model="socialLinkStatus" value="10">
                                    <label >Friends</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="radio" v-model="socialLinkStatus" value="0">
                                    <label>Only Me</label>
                                </div>
                           
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <p v-if="socialLinkStatus == 0" style="float: right;">Only Me</p>
                                <p v-if="socialLinkStatus == 10" style="float: right;">Friends</p>
                                <p v-if="socialLinkStatus == 20" style="float: right;">Everyone</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
        <hr>
        <div class="row">
            <div class="col-12">
              <div class="dropdown privacydropd">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Who can see your skills</a>
                    <div class="dropdown-menu">
                        <p>Choose who can see your skills</p>
                        <div class="row">
                            <div class="col-md-9 col-sm-12">
                               
                                <div class="custom-control custom-checkbox">
                                    <input type="radio"  v-model="professionStatus" value="20">
                                    <label>Everyone</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="radio"   v-model="professionStatus" value="10">
                                    <label >Friends</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="radio" v-model="professionStatus" value="0">
                                    <label>Only Me</label>
                                </div>
                           
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <p v-if="professionStatus == 0" style="float: right;">Only Me</p>
                                <p v-if="professionStatus == 10" style="float: right;">Friends</p>
                                <p v-if="professionStatus == 20" style="float: right;">Everyone</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <div class="privabtns">
                   <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
        </div>
          </form>
    </div>
                              
</template>

<script>
export default {
    name: 'Privacy',
    data() {
        return{
            communityStatus: "",
            workingHistoryStatus: "",
            socialLinkStatus: "",
            professionStatus: "",          
            profileStatus:{},           
        }
     },
    mounted() {
        this.get_user_privay_data();
    },
     methods: {
        get_user_privay_data() {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
            axios({ method: "GET", url: "/api/get-user-privay-data/"+JSON.parse(localStorage.getItem('TTNetwork.user')).id }).then(
                result => {
                    this.profileStatus = result.data;
                    for(let i=0; i<this.profileStatus.length; i++){
                        if(this.profileStatus[i].profile_setting_id == 3)
                            this.communityStatus = this.profileStatus[i].status;   
                    else if(this.profileStatus[i].profile_setting_id == 10)
                            this.socialLinkStatus = this.profileStatus[i].status;
                    else if(this.profileStatus[i].profile_setting_id == 5)
                            this.workingHistoryStatus = this.profileStatus[i].status;
                    else if(this.profileStatus[i].profile_setting_id == 7)
                            this.professionStatus = this.profileStatus[i].status;

                    }
                },
                error => {
                console.error(error);
                }
            );
        },
        change_user_Privacy() {
            axios
            .put("/api/change-user-Privacy/"+JSON.parse(localStorage.getItem('TTNetwork.user')).id, {
                communityStatus : this.communityStatus,
                workingHistoryStatus : this.workingHistoryStatus,
                socialLinkStatus : this.socialLinkStatus,
                professionStatus : this.professionStatus,             
            })
            .then(res => {
               this.get_user_privay_data();
            })
            .catch(err => {
                console.log(err);
            });
        },
    }
}
</script>