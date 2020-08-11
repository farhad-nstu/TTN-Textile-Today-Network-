<template>
  	<div class="col-lg-6">		  
		<div class="login-sec">
			<div class="sign_in_sec current">
				<h3>Sign Up</h3>
				<div class="dff-tab current">
					<form  @submit.prevent="register" >
						<div class="row">
							<div class="col-lg-12 no-pdd">
								<div class="sn-field">
									<input type="text" v-model="name" placeholder="Full Name"   required>
									<i class="la la-user"></i>
								</div>
							</div>
							<div class="col-lg-12 no-pdd">
								<div class="sn-field">
									<input type="email" v-model="email" placeholder="Email"  @change="check_email_exist"  required>
									<i class="la la-globe"></i>
								</div>
								<div v-if="emailTaken && email">
									<p class="text-danger">Email Exists!!</p>
								</div>
							</div>
							<div class="col-lg-12 no-pdd">
								<div class="sn-field">
									<input type="tel" v-model="phone" placeholder="Phone" @change="check_phone_exist">
									<i class="la la-globe"></i>
								</div>
								<div v-if="phoneTaken && phone">
									<p class="text-danger">phone Exists!!</p>
								</div>
							</div>
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
								<div class="checky-sec st2">
								<b>Have an account? <router-link class=" py-3 px-0 px-lg-3" to="/sign-in">Login here</router-link></b>
								</div>
							</div>
							<div class="col-lg-12 no-pdd">
								<div class="checky-sec st2">
									<div class="fgt-sec">
										<input type="checkbox" name="cc" id="c2">
										<label for="c2">
											<span></span>
										</label>
										<small>Yes, I understand and agree with the <router-link to="/policy">signup policies</router-link></small>
									</div>
								</div>
							</div>
							<div class="col-lg-12 no-pdd">
								<button  v-if="!phoneTaken && !emailTaken "  class="btn-rounded" type="submit" value="submit">Sign Up</button>
								<button  v-else disabled class=" btn-rounded">Sign Up</button>
								<Loader v-if="shouldShowLoader" /> 
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
  	</div>
</template>
<script>
import Loader from '@/components/Loader';
export default {
	data() {
		return {
			name: "",
			email: "",
			phone: "",
			password: "",
			confirm_password: "",
			emailTaken: false,
			phoneTaken: false,
			color: "",
			size: "",
			shouldShowLoader: false,
		}
	},
	components: {
		Loader  
    },
	methods: {
		check_email_exist(){
			axios.get('api/check-email-exist/'+this.email)
				.then((response) => {
					if (response.data.response == 'error'){
						this.emailTaken=true;
					}
					if(response.data.response == 'success'){
						this.emailTaken = false;
					}
			});
		},
		check_phone_exist(){
			axios.get('api/check-phone-exist/'+this.phone)
				.then((response) => {
					if (response.data.response == 'error'){
						this.phoneTaken=true;
					}
					if(response.data.response == 'success'){
						this.phoneTaken = false;
					}				
			});
		},
		register(e) {
			e.preventDefault()
			if (this.password !== this.confirm_password || this.password.length <= 0) {
				this.password = ""
				this.confirm_password = ""
				return alert('Passwords do not match')
			}
			this.shouldShowLoader = true;
			let name = this.name
			let email = this.email
			let phone = this.phone
			let password = this.password
			let confirm_password = this.confirm_password
			axios.post('api/register', {name, email,phone, password, confirm_password}).then(response => {
				let data = response.data
				localStorage.setItem('TTNetwork.user', JSON.stringify(data.user))
				localStorage.setItem('TTNetwork.jwt', data.token)
				if (localStorage.getItem('TTNetwork.jwt') != null) {
					this.$emit('loggedIn')
					let nextUrl = this.$route.params.nextUrl
					this.$router.push((nextUrl != null ? nextUrl : '/send-verification-email'))
					this.shouldShowLoader = false;
				}
			})
		}
	}
 }
</script>
<style scoped>

</style>

