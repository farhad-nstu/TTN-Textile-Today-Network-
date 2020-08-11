<style scoped>
.article-title {
  font-size: 30px;
}
</style>

<template>
  <div>
    <div class="wrapper">
      <Header />
      <section class="profile-account-setting">
        <div class="container">
          <div class="account-tabs-setting">
            <div class="row">
              <section class="forum-page">
                <div class="container">
                  <div class="forum-questions-sec">
                    <div class="row">
                      <div class="col-lg-9">
                        <div class="forum-questions">
                          <div class="usr-question">
                            <div class="usr_quest">
                              <h3 class="mb-3 article-title">{{ post.title }}</h3>
                              <p v-html="post.descr" style="padding-bottom: 10px;"></p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3" style>
                        <h3 class="title-wd">
                          <router-link to="/question/create">
                            <button class="btn btn-primary">Ask Question</button>
                          </router-link>
                        </h3>
                      </div>
                    </div>
                    <!--forum-questions-sec end-->
                  </div>
                </div>
              </section>
              <!--forum-page end-->
            </div>
          </div>
          <!--account-tabs-setting end-->
        </div>
      </section>
    </div>
    <Footer />
  </div>
</template>

<script>
import Header from "@/components/user/Header";
import Footer from "@/components/user/Footer";
import ScriptLoader from '@/mixins/ScriptLoader';

export default {
  name: "SingleArticle",
  mixins: [ScriptLoader],
  mounted(){
    this.loadStyleSheets("user");
    this.loadJsScripts("user");
    this.getData();
  },
  data() {
    return {
      post: {}
    };
  },

  components: {
    Header,
    Footer
  },

  mounted() {
    this.getData();
  },

  methods: {
    getData() {
      let post_id = window.location.href.split("/").pop();
      console.log(post_id);
      axios.get("/api/post/" + post_id).then(response => {
        this.post = response.data;
        console.log(this.post);
      });
    }
  }
};
</script>



