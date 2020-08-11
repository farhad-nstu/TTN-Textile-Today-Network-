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
                    <h6 class="m-0 font-weight-bold text-primary float-left">Post</h6>
                  </div>
                  <div class="card-body">
                    <form @submit.prevent="addPost">
                      <div class="form-group">
                        <label class="font-weight-bold">Title</label>
                        <input type="text" v-model="title" class="form-control" required />
                      </div>

                      <div class="form-group">
                        <label class="font-weight-bold">Editor content</label>
                        <input type="text" class="form-control" id="summernote_div" v-model="editorContent">
                      </div>

                      <div class="form-group">
                        <label class="font-weight-bold">Post Type</label>
                        <select class="form-control" v-model="post_type_id" required>
                          <option v-for="type in types" :key="type.id" :value="type.id">
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
                        <button type="submit" class="btn btn-primary">Save</button>
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
      var page = window.location.href.split('/').pop();
      this.loadStyleSheets("controller_summernote");
      this.loadJsScripts("controller_summernote");
      this.getData();
    },
  components: {
      HeaderBar,
      LeftSidebar,
      FooterBar,
  },

  data() {
    return {
      title: "",
      editorContent: "<h1>Editor contents</h1>",
      post_type_id: "",
      status: "",
      types: {},
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
    getData() {
      this.$Progress.start();
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')
      axios({ method: "GET", url: "/api/types-status/" }).then(
        result => {
          this.types = result.data.postTypes;
          this.statuses = result.data.status;
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

    addPost() {
      axios.post("/api/posts", {
          title: this.title,
          descr: this.editorContent,
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
