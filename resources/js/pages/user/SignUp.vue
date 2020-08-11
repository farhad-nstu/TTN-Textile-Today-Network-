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
									<SignUpForm />
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
import SignUpForm from '@/components/user/SignUpForm';
import LandingPageHeader from '@/components/user/LandingPageHeader';
import LandingPageFooter from '@/components/user/LandingPageFooter';
import ScriptLoader from '@/mixins/ScriptLoader';

export default {
	name: 'SignUp',
	mixins: [ScriptLoader],
	mounted(){
      	var page = window.location.href.split('/').pop();
		this.loadStyleSheets("user_login");
		this.loadJsScripts("user_login");
	},
	components: {

		SigningPageLeftBar,
		SignUpForm,
		LandingPageHeader,
		LandingPageFooter,
	}
}
</script>