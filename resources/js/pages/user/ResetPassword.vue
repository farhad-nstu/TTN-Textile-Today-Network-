<template>
  <div>
    <div class="wrapper">
		<div class="sign-in-page">
			<div class="signin-popup">
				<div class="signin-pop">
					<div class="row">
						<div class="col-lg-6">
							<div class="cmp-info">
								<div>
								<router-link class="btn btn-light" to="/">
									 <img width="200" src="https://www.textiletoday.com.bd/wp-content/uploads/2018/08/textile-today-logo-1.png" alt="">
								</router-link>
								<p>Textile Today Network,  is a global platform and social networking where businesses and independent professionals connect and collaborate remotely</p>
								</div>
								<img src="images/business-network.jpg" class="image-fluid" alt="">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="login-sec">									
								<div class="sign_in_sec current">
									<h3>Reset your Password</h3>
									<form  @submit.prevent="reset_password" >
										<div class="row">
												<div class="col-lg-12 no-pdd">
													<div class="sn-field">
														<input type="password" v-model="password" placeholder="Password" required>
														<i class="la la-lock"></i>
													</div>
												</div>
												<div class="col-lg-12 no-pdd">
													<div class="sn-field">
														<input type="password" v-model="confirm_password"  placeholder="Repeat Password" required>
														<i class="la la-lock"></i>
													</div>
												</div>
											<div class="col-lg-12 no-pdd">
												<button  class="btn-rounded py-3 px-0 px-lg-3" type="submit">change password</button>
											</div>
											<div v-if="resetCheck && success" class="col-lg-12 no-pdd">
												<h2 class="text-success text-bold">Your password has been changed successfully!</h2>
											<b>Please  <router-link class=" py-3 px-0 px-lg-3" to="/sign-in">Login now!</router-link></b>
											</div>
											<div v-if="!resetCheck && !success" class="col-lg-12 no-pdd">
												<h2 class="text-danger text-bold">Your can't parmit to access! </h2>
											<b>Please  <router-link class=" py-3 px-0 px-lg-3" to="/">back home!</router-link></b>
											</div>
										</div>
									</form >
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<router-link class="btn btn-light" to="/">home</router-link>
		</div>
	</div>
  </div>
</template>
<script>
import axios from "axios";
export default {
        data() {
            return {
                password: "",
				confirm_password: "",
				resetCheck: false,
				success: true,
            }
        },
        methods: {
            reset_password(e) {
            e.preventDefault()
            if (this.password !== this.confirm_password || this.password.length <= 0) {
                this.password = ""
                this.confirm_password = ""
                return alert('Passwords do not match')
            }
            let password = this.password
            let confirm_password = this.confirm_password
            let token = window.location.href.split('/').pop();
            console.log(token);
            axios.put("/api/reset-password", {token,password, confirm_password}).then(response => {
                if(response.data.response == "success"){
					toast.fire({icon: "info", title: response.data.message });
					this.resetCheck = true;
					this.password = "",
					this.confirm_password = ""
				}else{
					toast.fire({icon: "info", title: response.data.message });
				}
            }).catch((error) => {
				console.log(error);
				if(error.response.data.response == "error"){
					toast.fire({icon: "info", title: response.data.message });
					this.resetCheck = false;
					this.success = false;
					this.password = "",
					this.confirm_password = ""
				}
			});
        }
        }
    }
</script>