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
								</div><!--cm-logo end-->	
								<img src="images/business-network.jpg" class="image-fluid" alt="">			
							</div><!--cmp-info end-->
						</div>
						<div class="col-lg-6">
							<div class="login-sec">
								<div v-if="checkEmail" class="col-lg-12 no-pdd">
										<h3 class="text-success">Please check your email! </h3>
										<p>We just send you an email message. Inside that message is a link you can use to change your passwrod.</p>
								</div>

								<div v-if="!checkEmail && invalidEmail" class="col-lg-12 no-pdd">
										<h3 class="text-danger">Please enter your valid email!</h3>
								</div>


								<div class="sign_in_sec current">
									<h3>Reset Password</h3>
									<form  @submit.prevent="forgot_password" >
										<div class="row">
											<p>Forgotten your password? Enter your email address below, and we'll email instructions for setting a new one.</p>
											<div class="col-lg-12 no-pdd">
												<div class="sn-field">
													<input type="text" v-model="email" placeholder="email" required autofocus>
                                      
													<i class="la la-user"></i>
												</div><!--sn-field end-->
											</div>
						
											<div class="col-lg-12 no-pdd">
												<button class="btn-rounded py-3 px-0 px-lg-3" type="submit">Send Password reset link</button>
											</div>

											

										</div>
									</form >
									</div><!--sign_in_sec end-->

							</div><!--login-sec end-->
						</div>
					</div>		
				</div><!--signin-pop end-->
			</div><!--signin-popup end-->
			<router-link class="btn btn-light" to="/sign-in">Back</router-link>

		</div><!--sign-in-page end-->


	</div>
  </div>
</template>

<script>
import axios from "axios";
export default {
        data() {
            return {
                email: "",
			   
			   checkEmail: false,
			   invalidEmail: false,
            }
        },
        methods: {
            forgot_password(e) {
                e.preventDefault()
                    axios.get('api/forgot-password/'+this.email)
                    .then((response) => {
                        if (response.data.success == true){
							this.email = ""
                            this.checkEmail=true;
							this.invalidEmail=false;
                        }
                       
						
					
                    }).catch((error) => {
						console.log(error);
						 if(error.response.data.success == false){
                            this.checkEmail = false;
							this.invalidEmail = true;
						}
					});
                
            },
        }
    }
</script>