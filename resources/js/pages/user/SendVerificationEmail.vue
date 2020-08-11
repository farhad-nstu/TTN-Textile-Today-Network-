<template>
  <div>
    <div class="wrapper">
		<div class="container mt-2">
			<div class="row mb-0">
				<p class="display-4 text-center offset-2">Thanks for your registration</p>
			</div>
			<div class="row">
					<div class="col-lg-6">
						<div class="cmp-info">
							<div class="col-lg-8">
								<router-link class="btn btn-light" to="/">
										<img width="200" src="https://www.textiletoday.com.bd/wp-content/uploads/2018/08/textile-today-logo-1.png" alt="">
								</router-link>
							</div><!--cm-logo end-->
							<div class="text-justify">
							<p>Textile Today Network,  is a global platform and social networking 
							where businesses and independent professionals connect and collaborate remotely</p>
		
							</div>
					
							<img src="images/home/business-network.jpg" class="image-fluid" height="370px">			
						</div><!--cmp-info end-->
					</div>
					<div class="col-lg-6">
						<div class="cmp-info">
							<p class="text-justify font-weight-bold">Your account has been created. A verification email is sent to your account.
							Please check your mail and click on the activation link.</p>

							<p>After email verification you can login here.<router-link class=" py-3 px-0 px-lg-3" to="/sign-in">Login</router-link>  </p>
						
							<!-- <p class="text-justify text-bold">	We have sent an email with a confirmation link to your email address.
							In order to complete the sign-up process, please click the confirmation link.
							If you do not receive a confirmation email, please check your spam folder.
							Also, please verify that you entered a valid email address in our sign-up form.
							If you need assistance, please contact us. </p> -->
								
						</div><!--cmp-info end-->
					</div>

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
                name: "",
              
            }
        },
        methods: {		
     
        }
    }
</script>