
<template>
  <div>
    <Header />
    <main>
      <div class="main-section">
        <div class="container">
          <div class="main-section-data">
            <div class="row">
              <LeftSidebar />
              <div class="col-lg-6 col-md-8 no-pd">
                <div class="main-ws-sec">
                  <div class="post-topbar row mb-3">
                    <div class="col-md-2">
                      <img
                        width="60"
                        v-if="profile_picture"
                        v-bind:src="
                          '/storage/uploads/' +
                            id +
                            '/Users/' +
                            profile_picture
                        "
                      />
                      <img width="60" v-else :src="'/Images/profile/profile_logo.png'" />
                    </div>
                    <div class="col-md-10">
                      <textarea
                        v-model="postData"
                        rows="3"
                        placeholder="Share your thoughts..."
                        class="form-control"
                      ></textarea>
                    </div>
                    <div class="col-md-12">
                      <button
                        @click="submit_post()"
                        class="btn btn-primary btn-sm float-right mt-3"
                      >Post</button>
                      <select class="float-right publish-options" name id>
                        <option value>Sharing options..</option>
                        <option value>Public</option>
                        <option value>Connected People</option>
                        <option value>Private</option>
                      </select>
                    </div>
                    <!--post-st end-->
                  </div>
                  <!--post-topbar end-->
                  <div class="posts-section">
                    <PostCard :articles="articles" />
                    <!--post-bar end-->
                    <div>
                      <ShowEventLists :showEvents="events" />
                    </div>
                    <div class="process-comm">
                      <div class="spinner">
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                      </div>
                    </div>
                    <!--process-comm end-->
                  </div>
                  <!--posts-section end-->
                </div>
                <!--main-ws-sec end-->
              </div>
              <RightSidebar />
            </div>
          </div>
          <!-- main-section-data end-->
        </div>
      </div>
    </main>
    <Footer />
  </div>
</template>
<style scoped>
</style>
<script>
import Header from "@/components/user/Header";
import Footer from "@/components/user/Footer";
import PostCard from "@/pages/user/Feed/PostCard";
import LeftSidebar from "@/pages/user/Feed/LeftSidebar";
import RightSidebar from "@/pages/user/Feed/RightSidebar";
import ShowEventLists from "@/components/user/Event/ShowEventLists";
import ScriptLoader from '@/mixins/ScriptLoader';


export default {
  name: "Feed",
  mixins: [ScriptLoader],

  components: {
    Header,
    Footer,
    ShowEventLists,
    PostCard,
    LeftSidebar,
    RightSidebar
  },
  data() {
    return {
      articles: {},
      events: [],
      postData: "",
      id: JSON.parse(localStorage.getItem("TTNetwork.user")).id,
      profile_picture: JSON.parse(localStorage.getItem("TTNetwork.user"))
        .profile_picture
    };
  },
  mounted() {
    this.loadStyleSheets("user");
    this.loadJsScripts("user");
    this.get_feeds();
  },

  methods: {
    get_feeds() {
      axios.defaults.headers.common["Authorization"] =
        "Bearer " + localStorage.getItem("TTNetwork.jwt");
      axios
        .post("/api/get-feeds", {
          id: this.id,
          page: "1",
          limit: "5"
        })
        .then(result => {
          this.articles = result.data.articles.data;
          this.events = result.data.events.data;
        });
    },


    submit_post() {
      this.$Progress.start();
      axios.defaults.headers.common["Authorization"] =
        "Bearer " + localStorage.getItem("TTNetwork.jwt");
      let id = JSON.parse(localStorage.getItem("TTNetwork.user")).id;
      axios
        .post("/api/submit-post", {
          descr: this.postData,
          user_id: id
        })
        .then(result => {
          this.postData = "";
          this.get_feeds();
          toast.fire({ icon: "success", title: "Post Published!" });
        });
      this.$Progress.finish();
    },


  }
};
</script>

