<template>
	<div>
		<footer class="main-footer">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-sm-6">
						<h3 style="color: gray">About</h3>
						<p style="color: #808080;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
						<div style="display: block;height: 30px"></div>
					</div>
					<div style="display: block;height: 30px"></div>
					<div class="col-md-4 col-sm-6">
						<h3 style="color: gray">Useful Links</h3>
						<ul class="footer-menu" style="padding-left: 0;">
							<li>
								<router-link :to="{ }">Home</router-link>
							</li>
							<li>
								<router-link :to="{ }">Events</router-link>
							</li>
							<li>
								<router-link :to="{ }">Trainings</router-link>
							</li>
							<li>
								<router-link :to="{ }">Jobs</router-link>
							</li>
							<li>
								<router-link :to="{ }">Classifieds</router-link>
							</li>
							<li>
								<router-link to="/policy">Policy</router-link>
							</li>
						</ul>
						<div style="display: block;height: 30px"></div>
					</div>

					<div class="col-md-4 col-sm-6" style="color:#808080;">
						<h3 style="color: gray">Contact with us</h3>

						<p style="font-size: 15px; margin-bottom:0">
						<i style="color:#2C81D5" class="fa fa-phone" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;98987987987
						</p>
						<p style="font-size: 15px;margin-bottom:0">
						<i style="color:#2C81D5" class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;info@ttn.com
						</p>

						<div style="display: block;height: 30px"></div>
						<router-link class="send-message-btn" :to="{ }">Send a Message</router-link>
						<div class="col" style="margin-top: 40px;padding-left: 0px;">
						Follow Us: &nbsp;
						<i style="color:#2C81D5" class="fa fa-facebook" aria-hidden="true"></i>&nbsp;&nbsp;
						<i style="color:#2C81D5" class="fa fa-twitter" aria-hidden="true"></i>&nbsp;&nbsp;
						<i style="color:#2C81D5" class="fa fa-linkedin" aria-hidden="true"></i>
						</div>
					</div>
				</div>
			</div>
		</footer>

		<section style="background-color: #2b2f31; color: #fff">
			<div class="container">
				<div class="row">
					<div class="col" align="center">
						<p style="margin: 0; padding: 8px 0px">
							Copyright &copy; 2019
							<router-link style="color:#fff; text-decoration: none;" to="/">Textile Today</router-link>. All Rights Reserved.
						</p>
					</div>
				</div>
			</div>
		</section>
		<br class="clear" />
	</div>
</template>
<script>
export default {
	name: 'LandingPageFooter',
	data () {
		return {

		}
	}
}
</script>

<style scoped>
</style>
