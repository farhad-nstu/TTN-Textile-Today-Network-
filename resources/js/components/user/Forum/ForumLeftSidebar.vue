<template>
	<div>      
		<div class="acc-leftbar">
			<div class="nav nav-tabs" id="nav-tab" role="tablist">
				<a type="button" class="font-weight-bold  btn-primary" :class="{'active': myQuestion}" v-on:click="set_content_type('my_questions')">
					<i class="fa fa-question-circle"></i>My Question
				</a>
				<a type="button" class="font-weight-bold btn-primary" :class="{'active': myAnswer}" v-on:click="set_content_type('my_answers')">
					<i class="fa fa-check-square"></i>My Answer
				</a>
			</div>
		</div>
	</div>
</template>
<script>
export default {
	name: 'ForumLeftSidebar',
	data() {
		return { 
			name: "",
			myQuestion: false,
			myAnswer: false,
		}
	},   

	methods:{
		set_content_type(contentType){
			if(contentType == 'my_questions'){
				this.myQuestion = true;
				this.myAnswer = false;
			} else{
				this.myQuestion = false;
				this.myAnswer = true;
			}
			this.$emit('leftSideBarClicked', contentType);
		}
	}
}
</script>
<style scoped>
	.btn {
		float: left;
		text-align: left;
	}
</style>