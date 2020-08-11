<template>
    <div>
		<div class="user-profile-ov st2">
			<h3>Experience<a href="#" title="" class="exp-bx-open"><i class="fa fa-plus-square"></i></a></h3>
			<div v-for="experience in experiences" :key="experience.id">	
				<div class="job_descp">
					<div class="float-right">
						 <a href="#" title="" class="btn btn-light btn-sm btn-circle exp-bx-open" @click="edit_data(experience)"><i class="fas fa-pen"></i></a>
						 <a href="#" title="" class="btn btn-light btn-sm btn-circle"  @click="delete_experience(experience.id)"><i class="fas fa-trash"></i></a>			
					</div>
					Designation : <h3>{{experience.job_title}}</h3>
					<ul class="job-dt">
						<li>Company : <a href="#" title="">{{experience.company_name}}</a></li>
						<li> Joined at : <span>{{experience.joined_at}}</span></li>
					</ul>
						<h3>Responsibility</h3>
						<p>{{experience.responsibilities}}</p>
					<ul class="skill-tags">
						<li><a href="#" title="">HTML</a></li>
						<li><a href="#" title="">PHP</a></li>
						<li><a href="#" title="">CSS</a></li>
						<li><a href="#" title="">Javascript</a></li>
						<li><a href="#" title="">Wordpress</a></li> 	
					</ul>
				</div>
			</div>        
		</div><!--user-profile-ov end-->
		<div class="overview-box" id="experience-box">
			<div class="overview-edit">
				<h3>Experience</h3>
				<form @submit.prevent="add_or_update_experience">
					<p v-if="experienceCheck" class="text-success">Data insert successfull!</p>
					<p v-if="!experienceCheck && experienceInvalid" class="text-danger">Please insert valid information!</p>
				
					<input type="text" v-model="job_title" placeholder="Job Title" required>
					<input type="text" v-model="company_name" placeholder="Company Name" required>
					
					<div class="datepicky">
						<div class="row">
							<div class="col-lg-6 no-left-pd">
								Joined date
								<div class="datefm">
									<input type="date" v-model="joined_at" placeholder="Joined date" class="datepicker" required>	
									<i class="fa fa-calendar"></i>
								</div>
							</div>
							<div v-if="disabled" class="col-lg-6 no-righ-pd">
									Left Date
								<div class="datefm">
									<input type="date" v-model="left_at" placeholder="Left date" class="datepicker" required>
									<i class="fa fa-calendar"></i>
								</div>
							</div>
						</div>
					</div>
					<div >
					<input class="col-2"  type="checkbox" @click="disableDate"  v-model="present" value="1">
							Currently Working
					</div>					
					<textarea name="responsibilities" placeholder="Responsibilities" id="" cols="30" rows="5" v-model="responsibilities"></textarea>
					<button type="submit" class="save">Save</button>
				</form>
				<a href="#" title="" class="close-box" @click="clear_data()"><i class="fas fa-times"></i></a>
			</div><!--overview-edit end-->
		</div><!--overview-box end-->
    </div>
</template>
<script>
export default {
    name: 'Experience',
    data() {
		return { 
			experiences:  {},
			id: "",
			job_title:  "",
			company_name: "",
			responsibilities: "",
			joined_at: "",
			left_at: "",
			present: "",
			experienceCheck: false,
			experienceInvalid: false,
			disabled: true,
			edit: false,			
		};
	 },
	mounted(){
	this.get_user_experiences();
	},
  	methods: {
	 	get_user_experiences() {	
			axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');			
			axios({ method: "GET", url: "/api/get-user-experiences/"+JSON.parse(localStorage.getItem('TTNetwork.user')).id }).then(
				result => {
					this.experiences = result.data.experiences;  
				},
				error => {
				console.error(error);
				}
			);
	 },
     add_or_update_experience() {
		 if(this.edit == false){
			 axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');			
			axios.put("/api/add-experience/"+JSON.parse(localStorage.getItem('TTNetwork.user')).id, {
			job_title : this.job_title,
			company_name : this.company_name,
			responsibilities : this.responsibilities,
			joined_at : this.joined_at,
			left_at : this.left_at,
		})
		.then(res => {
			if(res.data){
				toast.fire({icon: "info", title: "Experience added successfull!"});
				this.experienceCheck = true;
				this.experienceInvalid = false;
				this.job_title = "";
				this.company_name = "";
				this.responsibilities = "";
				this.joined_at = "";
				this.left_at = "";
			}else{
				this.experienceCheck = false;
				this.experienceInvalid = true;
			}
			this.get_user_experiences();
		})
		.catch(err => {
			console.log(err);
		});
	}else if(this.edit == true){
		axios.put("/api/update-experience/"+this.id, {
				job_title : this.job_title,
				company_name : this.company_name,
				responsibilities : this.responsibilities,
				joined_at : this.joined_at,
				left_at : this.left_at,
			})
			.then(res => {
				if(res.data.response == 'Success'){
					toast.fire({icon: "info", title: "data update successfull!"});
					this.experienceCheck = true;
					this.experienceInvalid = false;
					this.job_title = "";
					this.company_name = "";
					this.responsibilities = "";
					this.joined_at = "";
					this.left_at = "";
					
				}else{
					this.experienceCheck = false;
					this.experienceInvalid = true;
					toast.fire({icon: "info", title: "Please insert valid data!"});

				}
				this.edit = false;
				this.get_user_experiences();
			})
			.catch(err => {
				console.log(err);
					this.edit = false;
			});
		}		
	},
	edit_data(experience) {
		this.id = experience.id;
		this.job_title = experience.job_title;
		this.company_name = experience.company_name;
		this.responsibilities = experience.responsibilities;
		this.joined_at = experience.joined_at;
		this.left_at = experience.left_at;
		this.edit = true;
	},
	delete_experience(id) {
		if (confirm("Are You Sure?")) {
			axios
			.delete(`/api/delete-experience/${id}`)
			.then(res => {				
				this.get_user_experiences();
				console.log(res);
				toast.fire({
				icon: "info",
				title: "Deleted!"
				});
			})
			.catch(err => {
				console.log(err);
			});
		}
	},
	clear_data(){
		this.id = "";
		this.job_title ="";
		this.company_name = "";
		this.responsibilities = "";
		this.joined_at = "";
		this.left_at = "";
		this.edit = false;
	},
	
 	disableDate(){
		if(this.present == 1){
			this.disabled = true;
			this.left_at= "";
		}else{
			this.disabled = false;
			this.left_at= "";
		}
		
     },
    }
}
</script>