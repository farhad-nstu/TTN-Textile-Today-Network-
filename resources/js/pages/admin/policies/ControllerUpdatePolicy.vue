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
                <flash-message class="myCustomClass"></flash-message>

                <div class="card-header py-3">
                  <p class="text-center h3 text-primary font-weight-bold">Update policy</p>
                </div>
                <div class="card-body">
                  <form @submit.prevent="update_policy">
                    <div class="form-group">
                      <label class="font-weight-bold">Title</label>
                      <input name="name" type="text" v-model="title" class="form-control" placeholder required />
                    </div>
                    <div class="form-group">
                      <label class="font-weight-bold">Description</label>
                      <input type="text" class="form-control" id="summernote_div" v-model="descr">
                    </div>
                    <div class="form-group">
                      <label class="font-weight-bold">Applicable form</label>
                      <input name="name" type="date" v-model="applicable_from" class="form-control" placeholder required />
                    </div>
                    <div class="form-group">
                      <label class="font-weight-bold">Unique code for selection</label>
                      <input name="name" type="text" v-model="unique_code" class="form-control" placeholder required />
                    </div>
                    <div class="form-group">
                      <label class="font-weight-bold">Status</label>
                      <select class="form-control" v-model="status" required>
                        <option v-for="(status, index) in statuses" :key="status" :value="index">
                          {{ status }}
                        </option>
                      </select>
                    </div>
                    <div>
                      <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                  </form>
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
import VueFlashMessage from 'vue-flash-message';
require('vue-flash-message/dist/vue-flash-message.min.css');

export default {
	name: 'ControllerUpdatePolicy',
	mixins: [ScriptLoader],
	components: {
		HeaderBar,
		LeftSidebar,
		FooterBar,
	},
  	data() {
		return {
			unique_code: "",
			title: "",
			descr: "",
			applicable_from: "",
			status: "",
			statuses: {},
		};
  	},

	mounted() {
		this.loadStyleSheets("controller_summernote");
		this.loadJsScripts("controller_summernote");
		this.init();
		this.get_data();
	},

  methods: {
    get_data() {
      	this.$Progress.start();
      	axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')
      	let policy_id = window.location.href.split('/').pop();
      	axios({ method: "GET", url: "/api/policy-index/" + policy_id }).then(
			response => {
				let policy_index = response.data.policy_index;
				this.statuses = response.data.statuses;
				this.id = policy_index.id;
				this.user_id = policy_index.user_id;
				this.unique_code = policy_index.unique_code;
				this.title = policy_index.title;
				this.descr = policy_index.descr;
				this.applicable_from = policy_index.applicable_from;
				this.status = policy_index.status;
				$("#summernote_div").summernote("code", this.descr);
			},
			error => {
				console.error(error);
			}
    	);
      	this.$Progress.finish();
    },

    init(){
      	var vueData = this;
      	$(document).ready(() => {        
			$('#summernote_div').on('summernote.change', function(we, contents, $editable) {
				vueData.descr = contents;
			});
      	});
    },

    update_policy(id) {
     	let policy_id = window.location.href.split('/').pop();
      	axios.put(`/api/policy-index/${policy_id}`, {
        user_id: JSON.parse(localStorage.getItem("TTNetwork.user")).id,
        unique_code: this.unique_code,
        title: this.title,
        descr: this.descr,
        applicable_from: this.applicable_from,
        status: this.status,
      })
      	.then(result => {
        if(result.data.response == "success"){
          this.flash(result.data.message , 'success', {
            timeout: 3000,
          });
          this.$router.go(-1);
        } else {
          this.flash(result.data.message , 'warning', {
            timeout: 3000,
          });
        }
      })
    },
  }
};
</script>
<style lang="scss" scoped></style>
