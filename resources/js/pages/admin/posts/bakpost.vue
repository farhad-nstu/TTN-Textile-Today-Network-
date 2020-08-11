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
                  <label class="req">Title</label>
                  <input
                    type="text"
                    v-model="title"
                    class="form-control"
                    required
                  />
                </div>

                <div style="">
                    <label class="desc"><b>Description</b></label>
                    <trix-editor class="trix-content" @trix-attachment-add="handleAttachmentChanges" v-model="details" placeholder="Enter content" localStorage></trix-editor>
                </div>

                <div class="form-group">
                  <label class="req">Post Type</label>
                  <select class="form-control" v-model="post_type_id" required>
                    <option v-for="type in types" :value="type.id">{{
                      type.title
                    }}</option>
                  </select>
                </div>
                <div class="form-group">
                  <label class="req">Status</label>
                  <select class="form-control" v-model="status" required>
                    <option
                      v-for="(status, index) in statuses"
                      :value="index"
                      >{{ status }}</option
                    >
                  </select>
                </div>
                <div>
                  <button type="submit" class="btn btn-primary">Save</button>
                  <button @click="clearForm()" class="btn btn-danger">
                    Cancel
                  </button>
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
import VueTrix from "vue-trix";
export default {
  mixins: [ScriptLoader],
  name: 'PostCreate',
    mounted(){
    var page = window.location.href.split('/').pop();
    this.loadStyleSheets(page);
    this.loadJsScripts(page);
    this.getData();
    },
  components: {
      HeaderBar,
      LeftSidebar,
      FooterBar,
      VueTrix
  },

  data() {
    return {
      posts: {},
      id: "",
      title: "",
      editorContent: "<h1>Editor contents</h1>",
      post_type_id: "",
      status: "",
      types: {},
      image:"",
      statuses: {},
      edit: false,
      add: false
    };
  },

  methods: {

    handleAttachmentChanges(event) {

      let file = event.attachment.file;
        const reader = new FileReader();
        reader.onloadend = () => {
          this.image = reader.result;
        };
      reader.readAsDataURL(file);
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')

          axios
          .post("/api/images", {
            image: this.image
          })
        .then((result) => {
          // console.log(result.data.name);
        let url = result.data.name;
        let attributes = {
          url: "http://ttn.io/images/post_images/" + url,
          href: "http://ttn.io/images/post_images/" + url
        };
         event.attachment.setAttributes(attributes);
        })
    },
    getData(page = 1) {
      this.$Progress.start();
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')
      axios({ method: "GET", url: "/api/posts?page=" + page }).then(
        result => {
          console.log(result.data);
          this.posts = result.data.posts;
          this.types = result.data.postTypes;
          this.statuses = result.data.status;
        },
        error => {
          console.error(error);
        }
      );
      this.$Progress.finish();
    },

    addPost() {

        axios
          .post("/api/posts", {
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
            this.getData();
            this.add = false;
            this.edit = false;
            toast.fire({
              icon: "success",
              title: "Post Saved !"
            });
          })
          .catch(err => {
            console.log(err);
          });
    },

    editData(post) {
      this.edit = true;
      this.id = post.id;
      this.title = post.title;
      this.post_type_id = post.post_type_id;
      this.descr = post.descr;
      this.status = post.status;
    }
  }
};
</script>

<style lang="scss" scoped></style>
