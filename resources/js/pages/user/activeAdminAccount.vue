<template>
  <div>
    <div class="wrapper">
		<div class="row">
			<div class="col-lg-6">
				<div class="cmp-info">
					<div>
					<router-link class="btn btn-light" to="/">
							<img width="200" src="https://www.textiletoday.com.bd/wp-content/uploads/2018/08/textile-today-logo-1.png" alt="">
					</router-link>
				<p>Textile Today Network,  is a global platform and social networking where businesses and independent professionals connect and collaborate remotely</p>
					</div><!--cm-logo end-->	
					<img src="images/business-network.jpg" class="image-fluid" alt="">			
				</div><!--cmp-info end-->
			</div>
			<div class="col-lg-6">
				<div v-if="active" class="cmp-info">
					<p class="display-4">Thanks for activated</p>
					<div  v-if="role_id == 1 && status ==30"  class="col-lg-12 no-pdd">
							<p class="text-justify text-bold">Your email has been verified.</p>
							<p class="text-justify text-warning">You can login your account after approved by Admin. Admin will verify your details and access to login in this system.
								Please wait for approved. </p>
					</div>
				</div><!--cmp-info end-->
			</div>
		</div>	
	  </div>		
	</div>
</template>

<script>
import axios from "axios";
export default {
        data() {
            return {
				role_id:"",
				status:"",
                active: false
            }
		},
	 mounted() {
   	 this.active_admin_account();
 	 },
        methods: {
				active_admin_account() {
			let token = window.location.href.split('/').pop();
				console.log(token);
				axios.put("/api/active-admin-account", {token}).then(response => {
						this.active = true;
						let user = response.data.user;
						this.role_id = user.role_id;
						this.status = user.status;
				}).catch((error) => {
						console.log(error);
						 if(error.response.data.success == false){
                            this.active = false;
						}
				});
    		},		
     
        }
    }
</script>