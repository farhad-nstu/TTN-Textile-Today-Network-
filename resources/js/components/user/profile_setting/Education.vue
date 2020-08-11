<template>
    <div>
		<div class="user-profile-ov">
			<h3> Education  <a href="#" title="" class="ed-box-open"><i class="fa fa-plus-square"></i></a></h3>
			<table class="table table-hover table-striped ">
				<thead>
					<tr>
						<th>Degree</th>
						<th>Institute</th>
						<th>Passing Year</th>
						<th>CGPA</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="education in educations" v-bind:key="education.id">
						<td>{{education.degree_name}}</td>
						<td>{{education.institute_name}}</td>
						<td>{{education.passing_year}}</td>
						<td>{{education.cgpa}}</td>
						 <td>
							 <a href="#" title="" class="btn btn-light btn-sm btn-circle ed-box-open" @click="edit_data(education)"><i class="fas fa-pen"></i></a>
							 <a href="#" title="" class="btn btn-light btn-sm btn-circle"  @click="delete_education(education.id)"><i class="fas fa-trash"></i></a>			
                         </td>
	
					</tr>
				</tbody>
			</table>
		</div>
        <div class="overview-box" id="education-box">
			<div class="overview-edit">
				<h3>Education</h3>
				<form @submit.prevent="add_or_update_education">
					<p v-if="educationCheck" class="text-success">Data insert successfull!</p>
					<p v-if="!educationCheck && educationInvalid" class="text-danger">Please insert valid information!</p>
					<input type="text" v-model="institute_name" placeholder="School / University" required>
					
					<input type="text" v-model="degree_name" placeholder="Degree" required>
					
					<div class="datepicky">
						<div class="row">
							<div class="col-lg-6 no-left-pd">
								<div class="datefm">
									<input type="text" v-model="passing_year" placeholder="Passing Year" class="datepicker" required>	
									<i class="fa fa-calendar"></i>
								</div>
							</div>
							<div class="col-lg-6 no-righ-pd">
								<div class="datefm">
									<input type="text" v-model="cgpa" placeholder="Grade/CGPA" class="datepicker" required>
									<i class="fa fa-calendar"></i>
								</div>
							</div>
						</div>
					</div>
					<button v-if="edit == false" type="submit" class="save">Save</button>
					<button v-else type="submit"  class="save">Update</button>				
				</form>
				<a href="#" title="" @click="clear_data()" class="close-box"><i class="fas fa-times"></i></a>
			</div>
		</div>
    </div>                        
</template>

<script>
export default {
    name: 'Education',
    data() {
        return { 
			educations:{},
			id: "",
            degree_name: "",
            institute_name: "",
            passing_year: "",
            cgpa: "",

            educationCheck: false,
			educationInvalid: false,
			edit: false,
        };
    },
	mounted(){
		this.get_user_educations();
	},
  	methods: {
		get_user_educations() {	
			axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');			
			axios({ method: "GET", url: "/api/get-user-educations/"+JSON.parse(localStorage.getItem('TTNetwork.user')).id }).then(
				result => {
					this.educations = result.data.educations;
					//console.log(result.data.educations);  
				},
				error => {
				console.error(error);
				}
			);
		},
  		add_or_update_education() {
			if (this.edit == false) {
				axios
				.put("/api/add-education/"+JSON.parse(localStorage.getItem('TTNetwork.user')).id, {
					institute_name : this.institute_name,
					degree_name : this.degree_name,
					passing_year : this.passing_year,
					cgpa : this.cgpa,
				})
				.then(res => {
					if(res.data.response == "Success"){
						toast.fire({icon: "info", title: "Education added successfull!"});
						this.educationCheck = true;
						this.educationInvalid = false;
						this.institute_name = "";
						this.degree_name = "";
						this.passing_year = "";
						this.cgpa = "";
					}else{
						toast.fire({icon: "info", title: "Please insert valid data!"});
						this.educationCheck = false;
						this.educationInvalid = true;
					}
					 this.edit = false;
					 this.get_user_educations();					 
				})
				.catch(err => {
					console.log(err);
					this.edit = false;
				});
			} else if(this.edit = true){
				axios
				.put("/api/update-education/"+this.id, {
					institute_name : this.institute_name,
					degree_name : this.degree_name,
					passing_year : this.passing_year,
					cgpa : this.cgpa,
				})
				.then(res => {
					if(res.data.response == 'Success'){
						toast.fire({icon: "info", title: "data update successfull!"});
						this.educationCheck = true;
						this.educationInvalid = false;
						this.institute_name = "";
						this.degree_name = "";
						this.passing_year = "";
						this.cgpa = "";
						
					}else{
						this.educationCheck = false;
						this.educationInvalid = true;
						toast.fire({icon: "info", title: "Please insert valid data!"});

					}
					 this.edit = false;
					 this.get_user_educations();
				})
				.catch(err => {
					console.log(err);
					 this.edit = false;
				});
			}
		
		},
		 edit_data(education) {
			this.id = education.id;
			this.degree_name = education.degree_name;
			this.institute_name = education.institute_name;
			this.passing_year = education.passing_year;
			this.cgpa = education.cgpa;
			this.edit = true;
		},
		delete_education(id) {
			if (confirm("Are You Sure?")) {
				axios
				.delete(`/api/delete-education/${id}`)
				.then(res => {				
					this.get_user_educations();
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
			this.degree_name ="";
			this.institute_name = "";
			this.passing_year = "";
			this.cgpa = "";
			this.edit = false;
		}	
  }
}
</script>