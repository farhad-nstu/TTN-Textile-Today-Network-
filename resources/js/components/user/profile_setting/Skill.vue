<template>
    <div>  
		<div class="user-profile-ov">
			<h3>Skills <a href="#" title="" class="skills-open"><i class="fa fa-plus-square"></i></a> </h3>
			<ul >		
				<li  v-for="skill in userSkills" :key="skill"><a href="#" title="">{{skill}}</a></li>
			</ul>		
		</div>
		<div class="overview-box" id="skills-box">
			<div class="overview-edit">
				<h3>Skills</h3>
				<ul >		
				<li  v-for="skill in userSkills" :key="skill"><a href="#" title="">{{skill}}</a></li>
				</ul>
				<form  @submit.prevent="add_skills">
					 <select v-model="skill_id" name="skill_id" required>
						<option v-for="(skill, index) in allSkill" v-bind:key="index" :value="index">{{ skill }}</option>
                     </select>
					<button type="submit" class="save">Add</button>					
					<a href="#" title="" class="close-box"><i class="fas fa-times"></i></a>
				</form>
			</div>
		</div>  
    </div>
</template>
<script>
export default {
    name: 'Skill',
    data() {
        return { 
                allSkill:{},
                userSkills:{},
                skill_id: 0,
               skillcheck: false,
               skillInvalid: false,
               
            };
     },
     mounted() {
		this.get_all_skills();
		this.get_user_skills();
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
		get_user_skills() {	
			axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');			
			axios({ method: "GET", url: "/api/get-user-skills/"+JSON.parse(localStorage.getItem('TTNetwork.user')).id }).then(
				result => {
					this.userSkills = result.data.userSkills;  
					// console.log(this.userSkills);
				},
				error => {
				console.error(error);
				}
			);
	    },
  		add_skills() {
			axios
			.put("/api/add-skills/"+JSON.parse(localStorage.getItem('TTNetwork.user')).id, {
				skill_id : this.skill_id,
			})
			.then(res => {
				this.get_user_skills();
				toast.fire({icon: "info", title: "Skill added successfull"});
			})
			.catch(err => {	
				toast.fire({icon: "info", title: "This skill has already been taken!"});
				console.log(err);
			});
		},
    }
}
</script>