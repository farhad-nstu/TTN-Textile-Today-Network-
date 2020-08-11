<template>
  <div>
		<div class="msgs-list">
			<div class="msg-title">
				<h3>Messages</h3>
				<ul>
					<li><a href="#" title=""><i class="fa fa-cog"></i></a></li>
					<li><a href="#" title=""><i class="fa fa-ellipsis-v"></i></a></li>
				</ul>
			</div>
			<div class="messages-list">
				<ul>
					<li class="active" v-for="user in users" v-bind:key="user.id">
						<div class="usr-msg-details">
							<div class="usr-ms-img">
								<img v-if="user.profile_picture" class="rounded-circle"  v-bind:src="'/storage/uploads/'+user.id+'/Users/'+user.profile_picture" > 
                <img v-else  class="rounded-circle" v-bind:src="'/Images/profile/profile_logo.png'">
								<span class="msg-status"></span>
							</div>
							<div class="usr-mg-info">
								<router-link :to="`messages/${user.id}`">
									<h3>{{ user.name }}</h3>
									<p>Lorem ipsum dolor <img src="images/smley.png" alt=""></p>
								</router-link>
							</div>
							<span class="posted_time">1:55 PM</span>
							<span class="msg-notifc">1</span>
						</div>
					</li>					
				</ul>
			</div>
		</div>
	</div>
</template>
<script>
export default {
	name: 'MessagesLeftSideBar',

	data () {
		return {
			users: {},
		}
	},

	mounted(){
		this.get_users();
	},

	methods: {
		get_users() {
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')
      axios({ method: "GET", url: "/api/users"}).then(
        response => {
          console.log(response.data);
          this.users = response.data;
        },
        error => {
        console.error(error);
        }
      );
    },
	}
}
</script>