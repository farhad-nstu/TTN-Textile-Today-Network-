<template>
  <div>
    <header>
			<div class="container">
				<div class="header-data">
					<div class="logo">
						<p class="h4 text-light">TTN</p>
					</div>
					<div class="search-bar">
						<form @submit.prevent="keyword()">
							<input  v-model="search" type="text" name="search" placeholder="Search...">
							<button  type="submit"><i class="fa fa-search"></i></button>
						</form>
					</div>
					<nav>
						<ul>
							<li>
									<router-link to="/feed">
										<span><img src="/images/icon1.png" alt=""></span>
											Home
									</router-link>
									<!-- <router-link v-else to="/">
										<span><img src="/images/icon1.png" alt=""></span>
											Home
									</router-link> -->
							</li>
							<li>
								<router-link to="/events">
									<a>
										<span><img src="/images/icon3.png" alt=""></span>
										Events
									</a>
								</router-link>
							</li>
							<li>
								<router-link :to="{name: 'UserProfile', params: { id: userData.id}}">
									<a>
										<span><img src="/images/icon4.png" alt=""></span>
										Profiles
									</a>
								</router-link>
							</li>
							<li>
								<router-link to="/forum">
									<span><img src="/images/f.jpg" style="width: 13px;" alt=""></span>
									Forums
								</router-link>
							</li>
								<li>
									<a href="#" title="" class="not-box-openm">
											<span><img src="/images/icon6.png" alt=""></span>
											Messages
									</a>
									<div class="notification-box msg" id="message">
										<div class="nt-title">
											<h4>Setting</h4>
											<a href="#" title="">Clear all</a>
										</div>
										<div class="nott-list">
											<div class="notfication-details">
												<div class="noty-user-img">
													<img src="/images/resources/ny-img1.png" alt="">
												</div>
												<div class="notification-info">
													<router-link to="/messages">
														<h3><a href="messages.html" title="">Jassica William</a> </h3>
														<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do.</p>
														<span>2 min ago</span>
													</router-link>
												</div>
											</div>
												<div class="notfication-details">
													<div class="noty-user-img">
														<img src="/images/resources/ny-img2.png" alt="">
													</div>
													<div class="notification-info">
														<h3><a href="messages.html" title="">Jassica William</a></h3>
														<p>Lorem ipsum dolor sit amet.</p>
														<span>2 min ago</span>
													</div>
												</div>
												<div class="notfication-details">
													<div class="noty-user-img">
														<img src="/images/resources/ny-img3.png" alt="">
													</div>
													<div class="notification-info">
														<h3><a href="messages.html" title="">Jassica William</a></h3>
														<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore et dolore magna aliqua.</p>
														<span>2 min ago</span>
													</div>
												</div>
												<div class="view-all-nots">
														<a href="messages.html" title="">View All Messsages</a>
												</div>
										</div>
									</div>
								</li>
								<li>
									<a href="#" title="" class="not-box-open">
										<span><img src="/images/icon7.png" alt=""></span>
										Notification
									</a>
									<div class="notification-box noti" id="notification">
										<div class="nt-title">
											<h4>Setting</h4>
											<a href="#" title="">Clear all</a>
										</div>
										<div class="nott-list">
											<div v-for="notification in notifications" :key="notification.id" class="notfication-details">
												<div class="noty-user-img">
													<img src="/images/resources/ny-img1.png" alt="">
												</div>
												<div class="notification-info">
													<h3><a href="#" title="">{{notification.data.name}}</a> Sent You a Connection Request</h3>
													<button @click="acceptConnection(notification)" class="btn btn-success btn-sm">Accept</button>
													<button @click="blockConnection(notification)" class="btn btn-warning btn-sm">Block</button>
												</div>
											</div>
											<div class="view-all-nots">
													<a href="#" title="">View All Notification</a>
											</div>
										</div>
									</div>
								</li>
							</ul>
						</nav>
						<div class="menu-btn">
								<a href="#" title=""><i class="fa fa-bars"></i></a>
						</div>
						<div class="user-account">
							<div class="user-info">
								<div v-if="userData.profile_picture">
									<img class="rounded-circle" v-bind:src="'/storage/uploads/'+userData.id+'/Users/'+userData.profile_picture"  width="40px" >
								</div>
								<div v-else>
									<img class="rounded-circle" v-bind:src="'/images/profile/profile_logo.png'"  width="40px">
								</div>
								<a href="#" title="">{{userData.name}}</a>
								<i class="la la-sort-down"></i>
							</div>
							<div class="user-account-settingss">
								<h3>Setting</h3>
								<ul class="us-links">
									<li><a href="/profile-account" title="">Account Setting</a></li>
									<li><a href="#" title="">Terms & Conditions</a></li>
								</ul>
								<h3 class="tc"><a href="sign-in.html" title="">Logout</a></h3>
							</div>
						</div>
				</div>
			</div>
    </header>
  </div>
</template>

<script>
	export default {
		name: 'Header',
		data() {
				return {
						userData:{},
						name:"",
						profile_picture: "",
						notifications:{},
						search: "",
						base_url: base_url
				};
		},
		mounted(){
				// alert(base_url);
				this.getNotification();
				this.userData = JSON.parse(localStorage.getItem('TTNetwork.user'));
		},
		methods: {
			keyword(){
					let keyword = this.search;
					console.log(keyword);
					this.$router.push(
						'/search/' + keyword
					);
					location.reload();
			},
			getNotification() {
					axios({ method: "GET", url: "/api/get-notification/"+JSON.parse(localStorage.getItem('TTNetwork.user')).id }).then(
							result => {
							this.notifications = result.data.notifications;
					},
							error => {
							console.error(error);
							}
					);
			},
			acceptConnection(notification) {
					axios
					.post(`/api/accept-connection`, {
							from: notification.data.id,
							to: notification.notifiable_id
					})
					.then(res => {
							console.log('User Connected')
					})
					.catch(err => {
							console.log(err);
					});
			},
			blockConnection(notification) {
				axios
				.post(`/api/block-connection`, {
						from: notification.data.id,
						to: notification.notifiable_id
				})
				.then(res => {
						console.log('User Block')
				})
				.catch(err => {
						console.log(err);
				});
			}
		}
	}
</script>