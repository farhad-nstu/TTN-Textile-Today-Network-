<template>
    <div>
         <div class="user-pro-img">                         
        <div v-if="userData.profile_picture"> 
            <img   v-if="!newPic" class="rounded-circle"  v-bind:src="'/storage/uploads/'+userData.id+'/Users/'+userData.profile_picture" >              
            <img  v-else class="rounded-circle"  v-bind:src="profile_picture" >
        </div>
        <div v-else>
             <img  v-if="newPic" class="rounded-circle" v-bind:src="profile_picture" >
            <img v-else  class="rounded-circle" v-bind:src="'/Images/profile/profile_logo.png'">
        </div>
        <div class="add-dp">
                <a href=""  data-toggle="modal" data-target="#profileModal"><i class="fas fa-camera"></i></a>												
        </div>
        </div>
            <div class="user_pro_status">
                 <ul class="flw-status">
                     <li><span>{{userData.name}}</span></li>
                     <li><span>{{userData.about_yourself}}</span></li>
                </ul>
            </div>
            <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="ProfileModalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-white" id="exampleModalLongTitle">Change profile picture</h5>
                            <button type="button"  @click="clear" class="close p-0" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form  @submit.prevent="update_profile_picture" >
                                <flash-message class="myCustomClass"></flash-message>
                                <div class="modal-body">
                                    <input  type="file" class="form-control" @change="take_image" placeholder ref="fileInput" required/>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-default">Save</button>
                                    <button @click="clear" type="button" class="btn btn-default" data-dismiss="modal">
                                            Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</template>
<script>
import VueFlashMessage from 'vue-flash-message';
require('vue-flash-message/dist/vue-flash-message.min.css');
export default {
    name: 'ProfilePic',
    data() {
        return { 
            userData: {},
                profile_picture: "",
                newPic: false,
            };
        },	  
    mounted(){
        this.userData = JSON.parse(localStorage.getItem('TTNetwork.user'));
    },
    methods: {
        update_profile_picture() {
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')
            axios
            .put("/api/update-profile-picture/"+JSON.parse(localStorage.getItem('TTNetwork.user')).id, {
                profile_picture: this.profile_picture,          
            })
            .then(res => {
                this.picUpdate = true;
                this.newPic = false;
                localStorage.setItem("TTNetwork.user", JSON.stringify(res.data.user));
                this.userData = JSON.parse(localStorage.getItem('TTNetwork.user'));
                 $('#profileModal').modal('hide');
                 this.flash('profile picture saved  Successfully!','success',{timeout: 2000} );
                 toast.fire({icon: "info", title: "profile picture saved  Successfully"});
            })
            .catch(err => {
                console.log(err);
            });
        },
        take_image(event) {
            this.newPic = true;
            let file = event.target.files[0];
            let reader = new FileReader();

            reader.onload = event => {
                this.profile_picture = event.target.result;
                console.log(event.target.result);
            };
            reader.readAsDataURL(file);
        },
        clear(){
            this.profile_picture = "",
            this.newPic = false;
        }
    }
}
</script>