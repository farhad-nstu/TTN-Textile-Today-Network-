<template>
	<div class="full-body">
    <LandingPageHeader />
			<section class="block">
				<div class="container">
					<div class="sign-in-page" style="padding:20px;">
						<div class="signin-popup">
							<div class="signin-pop">
								<div class="row">
									<SigningPageLeftBar />
									<SignInForm />
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
    <LandingPageFooter />
  </div>
</template>

<script>
import SigningPageLeftBar from '@/components/user/SigningPageLeftBar';
import SignInForm from '@/components/user/SignInForm';
import LandingPageHeader from '@/components/user/LandingPageHeader';
import LandingPageFooter from '@/components/user/LandingPageFooter';
import ScriptLoader from '@/mixins/ScriptLoader';
export default {
	name: 'SignIn',
	mixins: [ScriptLoader],
	mounted(){
      	// var page = window.location.href.split('/').pop();
		this.loadStyleSheets("user_login");
		this.loadJsScripts("user_login");
	},
	components: {
		SigningPageLeftBar,
		SignInForm,
		LandingPageHeader,
		LandingPageFooter,
	}
}
</script>
<style scoped>
.full-body {
  background-color: #fff !important;
  height: fit-content;
}
.clear {
  clear: both;
}
</style>