<template>
  <div>
    <LeftSidebar/>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <HeaderBar/>
        <div class="container-fluid" >
          <div class="row">
            <div class="col">
              <div class>
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary float-left">Post update</h6>
                  </div>
                  <div class="card-body">
                    <form @submit.prevent="update_post">
                      <div class="form-group">
                        <label class="font-weight-bold">Title</label>
                        <input type="text" v-model="title" class="form-control" required />
                      </div>

                      <div class="form-group">
                        <label class="font-weight-bold">Editor content</label>
                        <input type="text" class="form-control" id="summernote_div" v-model="descr">
                      </div>

                      <div class="form-group">
                        <label class="font-weight-bold">Post Type</label>
                        <select class="form-control" v-model="post_type_id" required>
                          <option v-for="type in postTypes" :key="type.id" :value="type.id">
                            {{ type.title }}
                          </option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label class="font-weight-bold">Status</label>
                        <select class="form-control" v-model="status" required>
                          <option v-for="(status, index) in statuses" :key="status" :value="index" >
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
    </div>
    <FooterBar/>
  </div>
</template>
<script>
import HeaderBar from '@/components/admin/HeaderBar';
import LeftSidebar from '@/components/admin/LeftSidebar';
import FooterBar from '@/components/admin/FooterBar';
import ScriptLoader from '@/mixins/ScriptLoader';

export default {
  name: 'ControllerPostCreate',
  mixins: [ScriptLoader],
    mounted(){
      this.loadStyleSheets("controller_summernote");
      this.loadJsScripts("controller_summernote");
      this.get_data();
    },
  components: {
      HeaderBar,
      LeftSidebar,
      FooterBar,
  },

  data() {
    return {
      title: "",
      descr: "",
      post_type_id: "",
      status: "",
      post: {},
      postTypes: {},
      statuses: {},
    };
  },

  methods: {

    // handleAttachmentChanges(event) {
    //   let file = event.attachment.file;
    //     const reader = new FileReader();
    //     reader.onloadend = () => {
    //       this.image = reader.result;
    //     };
    //   reader.readAsDataURL(file);
    //   axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')

    //       axios
    //       .post("/api/images", {
    //         image: this.image
    //       })
    //     .then((result) => {
    //     let url = result.data.name;
    //     let attributes = {
    //       url: "http://ttn.test/images/post_images/" + url,
    //       href: "http://ttn.test/images/post_images/" + url
    //     };
    //      event.attachment.setAttributes(attributes);
    //     })
    // },
    get_data() {
      this.$Progress.start();
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')
      let post_id = window.location.href.split('/').pop();
      axios({ method: "GET", url: "/api/posts/" + post_id }).then(
        result => {
          let post = result.data.post;
          this.statuses = result.data.statuses;
          console.log(this.statuses);
          this.postTypes = result.data.postTypes;
          this.title = post.title;
          this.descr = post.descr;
          $("#summernote_div").summernote("code", this.descr);
          this.post_type_id = post.post_type_id;
          this.status = post.status;
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
            vueData.editorContent = contents;
        });
      });
    },

    update_post() {
			let post_id = window.location.href.split('/').pop();
      axios.put(`/api/posts/${post_id}`, {
          title: this.title,
          descr: this.descr,
          status: this.status,
          post_type_id: this.post_type_id
      })
      .then(res => {
        this.title = "";
        this.post_type_id = "";
        this.descr = "";
        this.status = "";
        this.$router.go(-1);
        toast.fire({
          icon: "success",
          title: "Post Saved !"
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
