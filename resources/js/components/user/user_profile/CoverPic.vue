<template>
    <div>
    	 <section class="cover-sec">          
            <div v-if="userData.background_banner">               
                <img  v-if="!newCoverPic"  v-bind:src="'/storage/uploads/'+userData.id+'/Users/'+userData.background_banner" height="350px" >
                <img  v-else v-bind:src="background_banner" height="350px" >
            </div>
            <div v-else>
                <img  v-if="newCoverPic" v-bind:src="background_banner" height="350px" >
                <img v-else v-bind:src="'/images/resources/cover-img.jpg'" height="350px">
            </div>		
			<div class="add-pic-box">
				<div class="container">
					<div class="row no-gutters">
						<div class="col-lg-12 col-sm-12">
                            <div class="text-center">
                            <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#coverModal">Chage cover picture</a>
                            </div>
						</div>
					</div>
				</div>
			</div>
            <div class="modal fade" id="coverModal" tabindex="-1" role="dialog" aria-labelledby="CoverModalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-white" id="exampleModalLongTitle">Change cover picture</h5>
                            <button type="button"  @click="clear" class="close p-0" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                             <form @submit.prevent="update_cover_picture" >
                                <flash-message class="myCustomClass"></flash-message>
                                <div class="modal-body">
                                    <input  type="file" class="form-control" @change="take_cover_image" placeholder ref="fileInput" required/>
                                </div>
                                <div class="modal-footer d-flex justify-content-center">
                                    <button class="btn btn-default">Save</button>
                                    <button @click="clear" class="btn btn-default" type="button" data-dismiss="modal">
                                        Cancel
                                    </button>
                                </div>
                             </form>
                        </div>
                    </div>
                </div>
            </div>
		</section>          
    </div>
</template>

<script>
import VueFlashMessage from 'vue-flash-message';
require('vue-flash-message/dist/vue-flash-message.min.css');
    export default {
      name: 'CoverPic',
        data() {
            return { 
                 userData: {},
                 background_banner: "",
                  newCoverPic:false,
                };
            },	  
        mounted(){
            this.userData = JSON.parse(localStorage.getItem('TTNetwork.user'));
        },
        methods: {
            update_cover_picture() {
             axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')
                axios.put("/api/update-cover-picture/"+JSON.parse(localStorage.getItem('TTNetwork.user')).id, {
                    background_banner: this.background_banner,               
                })
                .then(res => {
                    this.coverUpdate = true;
                    this.newCoverPic = false;
                    this.background_banner = "";
                    localStorage.setItem("TTNetwork.user", JSON.stringify(res.data.user));
                    this.userData = JSON.parse(localStorage.getItem('TTNetwork.user'));
                    $('#coverModal').modal('hide');
                    this.flash('Banner saved  Successfully!','success',{timeout: 2000} );
                     toast.fire({icon: "info", title: "Banner saved  Successfully"});

                })
                .catch(err => {
                    console.log(err);
                });
            },           
            take_cover_image(event) {
                this.newCoverPic = true;
                let file = event.target.files[0];
                let reader = new FileReader();
                reader.onload = event => {
                    this.background_banner = event.target.result;
                    console.log(event.target.result);
                };
                reader.readAsDataURL(file);
            },
            clear(){
                this.newCoverPic = false;
                this.background_banner = "";
            }
        }
    }
</script>