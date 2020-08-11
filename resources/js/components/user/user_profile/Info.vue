<template>
    <div>
        <div class="user-profile-ov">
		  	<h3>Contact</h3>
			<p> <b>Email: </b> {{userData.email}} </p>	 
			<p><b>Phone:</b>{{userData.phone}} </p>	  			  
		</div>		
      	<div class="user-profile-ov">
			<h3>About Yourself<a href="#" title="" class="overview-open"><i class="fa fa-plus-square"></i></a></h3>
			<p class="text-justify">{{userData.about_yourself}}</p>
		</div>
		<UserExperiences/>
		<UserEducations/>
		<UserSkills/>
		<div class="user-profile-ov">
			<h3>Location<a href="#" title="" class="lct-box-open"><i class="fa fa-plus-square"></i></a></h3>
			<div v-if="userData.country">
				<h4 class="text-bold" >Country :</h4>{{userData.country.name}}
				<p>State: {{userData.state.name}}, City : {{userData.city.name}}, Post Code: {{userData.post_code}} </p>
				<p class="text-bold">Address: </p>{{userData.address}}
			</div>
		</div>			
 		 <div class="overview-box" id="overview-box">
			<div class="overview-edit">
				<h3>About Yourself</h3>
				<span>max 5000 character</span>				
				<form  @submit.prevent="update_about_your_self">
						{{userData.about_yourself}}
					<textarea v-model="about_yourself"  cols="30" rows="10" required></textarea>
					<button type="submit" class="save">Save</button>					
				</form>
				<a href="#" title="" class="close-box"><i class="fas fa-times"></i></a>
			</div>
		</div>
		<div class="overview-box" id="location-box">
			<div class="overview-edit">
				<h3>Location</h3>
				<form @submit.prevent="update_location">
					<div class="datefm">
					 <select v-model="country_id" name="country_id"  @change="load_states" required>
						<option v-for="(country, index) in countries" v-bind:key="index" :value="index">{{ country }}</option>
					</select> 
						<i class="fa fa-globe"></i>
					</div>					
					<div class="datefm">
						 <select v-model="state_id" name="state_id"  @change="load_city" required>
							<option  v-for="(state, index) in states" v-bind:key="index" :value="index" >{{state }}</option>
						</select>
						<i class="fa fa-map-marker"></i>
					</div>
					<div class="datefm">
						<select v-model="city_id" name="city_id" required>
							<option v-for="(city, index) in cities" v-bind:key="index" :value="index">{{ city }}</option>
						</select>
						<i class="fa fa-map-marker"></i>
					</div>
					<div class="datefm">
						<h5>Post Code</h5>
						<div class="cpp-fiel">
							<input type="text" v-model="post_code" placeholder="Post Code" required>
							<i class="la la-globe"></i>
						</div>
					</div>
					<button type="submit" class="save">Save</button>					
				</form>
				<a href="#" title="" class="close-box"><i class="fas fa-times"></i></a>
			</div>
		</div>		 
    </div>
</template>
<script>
import UserEducations from '@/components/user/profile_setting/Education';
import UserExperiences from '@/components/user/profile_setting/Experience';
import UserSkills from '@/components/user/profile_setting/Skill';
export default {
	name: 'Info',
	 components: {
        UserEducations,      
        UserExperiences,      
        UserSkills,      
	},
    data() {
		return { 
		allSkill:{},
		userData:{},
 		countries: {},
        states: {},
		cities: {},		
        country_id : 0,
        state_id : 0,
        city_id : 0,
        post_code :"",
		about_yourself :"",		
		skill_id: "",
		degree_name: "",
		institute_name: "",
		passing_year: "",
		cgpa: "",
		job_title: "",
		company_name: "",
		responsibilities: "",
		joined_at: "",
		left_at: "",
		present: "",
		educationCheck: false,
		educationInvalid: false,
		skillcheck: false,
		skillInvalid: false,
		experienceCheck: false,
		experienceInvalid: false,
		disabled: true,
    	};   
  	},
 	mounted() {
		this.get_all_skills();
		 this.get_user_info();
		this.load_countries();
 	 },
  	methods: {
      	get_all_skills() {	
			axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
			axios({ method: "GET", url: "/api/get-all-skills" }).then(
				result => {
					this.allSkill = result.data.allSkills;
					console.log(this.allSkill);   
				},
				error => {
				console.error(error);
				}
			);
		},
      	get_user_info() {	
			axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');			
			axios({ method: "GET", url: "/api/get-user-info/"+JSON.parse(localStorage.getItem('TTNetwork.user')).id }).then(
				result => {
					this.userData = result.data.userData;
					console.log(this.userData);  
				},
				error => {
				console.error(error);
				}
			);
		},
		update_location() {
			axios
			.put("/api/update-Location/"+JSON.parse(localStorage.getItem('TTNetwork.user')).id, {
				country_id : this.country_id,
				state_id : this.state_id,
				city_id : this.city_id,
				post_code : this.post_code,
			})
			.then(res => {
				if(res.data.response = "success"){
				    toast.fire({icon: "info", title: res.data.message});
				}else{
				    toast.fire({icon: "info", title: res.data.message});
				}
				this.get_user_info();
			})
			.catch(err => {
				console.log(err);
			});
		},
		update_about_your_self() {
			axios
			.put("/api/update-about-your-self/"+JSON.parse(localStorage.getItem('TTNetwork.user')).id, {
				about_yourself : this.about_yourself,
			})
			.then(res => {
				if(res.data.response = "success"){
					toast.fire({icon: "info", title: res.data.message});
               		localStorage.setItem("TTNetwork.user", JSON.stringify(res.data.user));					
					this.about_yourself = "";				
				}else{
					toast.fire({icon: "info", title: "Please insert valid data"});
				}
				this.get_user_info();
			})
			.catch(err => {
				console.log(err);
			});
		},
		load_countries() {
			axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
			axios({ method: "GET", url: "/api/get-countries"}).then(
				result => {
				this.countries = result.data.countries;
				console.log(this.countries);
				},
				error => {
				console.error(error);
				}
			);
		},
		load_states() {
			axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
			axios({ method: "GET", url: "/api/get-states/"+ this.country_id }).then(
				result => {
				console.log(result.data);
				this.states = result.data;
				this.cities = null;				
				},
				error => {
				console.error(error);
				}
			);
		},
		load_city() {
			axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
			axios({ method: "GET", url: "/api/get-cities/"+this.state_id}).then(
				result => {
				console.log(result.data);
				this.cities = result.data;				
				},
				error => {
				console.error(error);
				}
			);		
		},
	}
}
</script>