<template>
  	<div class="col-lg-6">
		<div class="login-sec">
			<div v-if="!validUser" class="col-lg-12 no-pdd">
				<h3 class="text-danger text-center">
				Incorrect Email and/or Password!
				</h3>
				<p class="text-center">Please enter valid email and/or password.</p>
			</div>
			<div v-if="Inactive" class="col-lg-12 no-pdd">
				<h3 class="text-danger text-center">
				Your account does not active
				</h3>
				<p class="text-center">Please check your email and active account.</p>
			</div>

			<div class="sign_in_sec current">
				<h3>Sign in</h3>
				<form @submit.prevent="login">
				<div class="row">
					<div class="col-lg-12 no-pdd">
					<div class="sn-field">
						<input
						type="text"
						v-model="email"
						placeholder="email"
						required
						autofocus
						/>

						<i class="la la-user"></i>
					</div>
					<!--sn-field end-->
					</div>
					<div class="col-lg-12 no-pdd">
					<div class="sn-field">
						<input
						type="password"
						v-model="password"
						placeholder="Password"
						required
						/>
						<i class="la la-lock"></i>
					</div>
					</div>
					<div class="col-lg-12 no-pdd">
					<div class="checky-sec">
						<div class="fgt-sec">
						<input type="checkbox" name="cc" id="c1" />
						<label for="c1">
							<span></span>
						</label>
						<small>Remember me</small>
						</div>
						<!--fgt-sec end-->
						<router-link class="text-" to="/forgotpassword"
						>Forgot Password?</router-link
						>
					</div>
					</div>
					<div class="col-lg-12 no-pdd">
					<div class="checky-sec st2">
						<b
						>No account?
						<router-link
							class="text-bold py-3 px-0 px-lg-3"
							to="/sign-up"
							>Create now!</router-link
						></b
						>
					</div>
					</div>
					<div class="col-lg-12 no-pdd">
						<button class="btn-rounded" type="submit" > Sign in </button>
					</div>
					<Loader v-if="shouldShowLoader" /> 
				</div>
				</form>
			</div>
		</div>
	</div>
</template>

<script>
import Loader from '@/components/Loader';
import axios from "axios";
export default {
	components: {
		Loader,
	},
	data() {
		return {
		email: "",
		password: "",
		validUser: true,
		Inactive: false,
		shouldShowLoader: false,
		};
	},
	methods: {
		login(e) {
			e.preventDefault();
			if (this.password.length > 0) {
			let email = this.email;
			let password = this.password;
			this.shouldShowLoader = true;
			axios.post("api/login", { email, password }).then(response => {
				console.log(response.data);
				this.validUser = true;
				this.Inactive = false;
				let user = response.data.user;
				let role_id = user.role_id;
				let status = user.status;
				localStorage.setItem("TTNetwork.user", JSON.stringify(user));
				localStorage.setItem("TTNetwork.jwt", response.data.token);

				if (localStorage.getItem("TTNetwork.jwt") != null) {
				this.$emit("loggedIn");
				if (this.$route.params.nextUrl != null) {
					this.$router.push(this.$route.params.nextUrl);
				} else {
					this.$router.push(
					role_id == 10 &&  status == 10? "/feed" : '/sign-in'
					);
					this.shouldShowLoader = false;
				}
				}
			}).catch((error) => {
				console.log(error);
				if (error.response.data.err == 'invalidUser') {
					this.validUser = false;
					this.Inactive = false;
					this.shouldShowLoader = false;
				}
				else if(error.response.data.err == 'inActive') {
					this.Inactive = true;
					this.validUser = true;
					this.shouldShowLoader = false;
				}
			});
			}
		}
	}
};
</script>
