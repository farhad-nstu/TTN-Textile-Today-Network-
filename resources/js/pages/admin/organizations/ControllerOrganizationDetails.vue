<template>
	<div>
		<LeftSidebar/>
		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content">
				<HeaderBar/>
				<div class="container-fluid" >
				  <div class="row">
						<div class="col-md-12">
							<div class="card shadow mb-4">

								<div class="card-header py-3">
									<div class="row">
										<div class="col-9">
											<h6 class="m-0 font-weight-bold text-primary float-left"><img :src="'/images/company_logo/'+organization.company_logo" /> {{ organization.id }}: {{ organization.name }}</h6>
										</div>
										<div class="col-3">
											<router-link class="collapse-item float-right" to="/controller-organization"><button class="btn btn-sm btn-primary">Back</button></router-link>
										</div>
									</div>
								</div>
								<div class="card-body">
									<p v-html="organization.short_details"></p>
									<p><i class="fa fa-phone"></i>: {{ organization.phone }}</p>
									<p><i class="fa fa-envelope-square"></i> {{ organization.email}}</p>
									<p><i class="fa fa-fax"></i>: {{ organization.fax }}</p>
									<p><i class="fa fa-address-card"></i> {{ organization.address}}</p>
									<p><b>Website</b>: {{ organization.website }}</p>
									<p v-for="user in organization.users" v-bind:key="user.id"><i class="fa fa-user-tie"></i> {{ user.name }}</p>
									<p>
										<label>Status: </label>
										<span v-if="organization.status == 10" class="badge badge-success">Active</span>
										<span v-else class="badge badge-danger">Inactive</span>
									</p>	
									<br>
									<router-link :to="`/controller-update-organization/${organization.id}`" class="btn"><i class="fa fa-edit"></i>
									</router-link>
									<button class="btn">
										<DeleteModal v-on:setConfirmation="delete_data" :id="organization.id"/>                           
									</button>										
								</div>

							</div>
						</div>
				  </div>				  
				</div>
			</div>
		</div>
		<FooterBar/>
	</div>
</template>

<script>
import HeaderBar from '@/components/admin/HeaderBar';
import LeftSidebar from '@/components/admin/LeftSidebar';
import FooterBar from '@/components/admin/FooterBar';
import ScriptLoader from '@/mixins/ScriptLoader';
import DeleteModal from '@/components/DeleteModal';

export default {
	name: 'ControllerOrganizationDetails',
	mixins: [ScriptLoader],
	components: {
		HeaderBar,
		LeftSidebar,
		FooterBar,
		DeleteModal,
	},
  data() {
		return {
			organization: {},
			statuses: {},
			status: "10",
		};
  },

  mounted() {
		this.loadStyleSheets("controller");
    	this.loadJsScripts("controller");
		this.get_data();
  },

  methods: {
		get_data() {
			this.$Progress.start();
			axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')
			let organization_id = window.location.href.split('/').pop();
			axios({ method: "GET", url: "/api/organization-details/" + organization_id }).then(
			response => {
				this.organization = response.data.organization;
			},
			error => {
				console.error(error);
			}
			);
			this.$Progress.finish();
		},

		delete_data(id) {
			axios.delete(`/api/question-index/${id}`)
				.then(res => {
					this.get_data();
					$('#deleteModal'+id).modal('hide');
					toast.fire({
						icon: "info",
						title: "Deleted!"
					});
				})
				.catch(err => {
					console.log(err);
				});
		},
  }
};
</script>

<style lang="scss" scoped></style>
