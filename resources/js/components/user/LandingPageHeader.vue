<template>
  	<div>z
		<nav class="nav navbar navbar-expand-lg navbar-collapse fixed-top" id="homeNav">
			<div class="container">
				<router-link class="navbar-brand js-scroll-trigger" to="/">
					<img width="200" src="https://www.textiletoday.com.bd/wp-content/uploads/2018/08/textile-today-logo-1.png" />
				</router-link>

				<div class="collapse navbar-collapse">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item mx-0 mx-lg-1">
							<router-link class="btn-rounded nav-link py-3 px-0 px-lg-3" to="/sign-in">Sign in</router-link>
						</li>
						<li class="nav-item mx-0 mx-lg-1">
							<router-link class="btn-rounded nav-link py-3 px-0 px-lg-3" to="/sign-up">Join now</router-link>
						</li>
					</ul>
				</div>
			</div>
		</nav>
    </div>
</template>

<script>
export default {
    name: 'LandingPageHeader',
    data () {
      return {
      }
    }
}
</script>