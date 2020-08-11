<template>
  <div>
    <div>
			<!-- <button :data-target="'#deleteModal'+id" class="btn btn-danger btn-sm btn-circle" data-toggle="modal"><i class="fa fa-trash"></i></button> -->
			<a class="com text-dark" :href="'#deleteModal'+id" data-toggle="modal"><i class="fa fa-trash"></i></a>
		</div>

		<div :id="'deleteModal'+id" class="modal fade">
			<div class="modal-dialog modal-confirm">
				<div class="modal-content">
					<div class="modal-header">			
						<h4 class="modal-title font-weight-bold text-primary">Are you sure want to delete?</h4>	
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<p class="text-primary h5">Do you really want to delete this data? This process cannot be undone.</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
						<button type="button" @click="send_confirmation" class="btn btn-danger">Delete</button>
					</div>
				</div>
			</div>
		</div>     
  </div>
</template>

<script>
export default {
	name: 'DeleteModal',
	props: {
     id: Number,
    },
	methods:{
		send_confirmation(){
			 this.$emit('setConfirmation', this.id);
		}
	}
}
</script>
