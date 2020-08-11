<template>
  <div>
    <Header />
    <section class="forum-page">
      <div class="container">
        <div class="forum-questions-sec">
          <div class="row">
            <div class="col-lg-8">
              <div class="forum-questions">
                <div v-for="user in users" :key="user.id" class="usr-question">
                  <div class="usr_img" v-if="user.profile_picture">
                    <img
                      v-bind:src="
                        '/storage/uploads/' +
                          user.id +
                          '/Users/' +
                          user.profile_picture
                      "
                    />
                  </div>
                  <div class="usr_img" v-else>
                    <img v-bind:src="'/Images/profile/profile_logo.png'" />
                  </div>
                  <div class="usr_quest">
                    <router-link :to="`/user-profile/${user.id}`">{{
                      user.name
                    }}</router-link>
                    <ul class="mb-3 mt-1 react-links">
                      <!-- <li>
                        <a prevent href="" title>
                          <i class="fas fa-users"></i> Connections 150
                        </a>
                      </li> -->
                      <li>
                        <a href="" title>
                          <i class="fa fa-arrow-circle-up"></i> Score
                          {{ user.total_score }}
                        </a>
                      </li>
                    </ul>
                    <ul>
                      <li
                        v-html="show_connection_button(user.id)"
                        v-on:click="add_connection(user.id)"
                      ></li>
                    </ul>
                  </div>
                </div>
                <!--usr-question end-->
              </div>
              <!--forum-questions end-->
              <div v-if="events.length" class="post-bar bgclr">
                <h3 class="section-title">Events</h3>
                <div
                  v-for="event in events"
                  :key="event.id"
                  class="result-loop"
                >
                  <div class="wordpressdevlp">
                    <router-link to=""
                      ><h2>{{ event.title }}</h2></router-link
                    >
                    <p>
                      <i class="far fa-clock-o"></i>Starts on
                      {{ event.start_date }}
                    </p>
                  </div>
                </div>
              </div>

              <div v-if="posts.length" class="post-bar bgclr">
                <h3 class="section-title">Posts</h3>
                <div v-for="post in posts" :key="post.id" class="result-loop">
                  <div class="wordpressdevlp">
                    <router-link to=""
                      ><h2>{{ post.title }}</h2></router-link
                    >
                    <p>
                      <i class="far fa-clock-o"></i>Posted {{ post.created_at }}
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="widget widget-user">
                <h3 class="title-wd">Top User of the Week</h3>
                <ul>
                  <li>
                    <div class="usr-msg-details">
                      <div class="usr-ms-img">
                        <img src="images/resources/m-img1.png" alt="" />
                      </div>
                      <div class="usr-mg-info">
                        <h3>Jessica William</h3>
                        <p>Graphic Designer</p>
                      </div>
                      <!--usr-mg-info end-->
                    </div>
                    <span><img src="images/price1.png" alt="" />1185</span>
                  </li>
                  <li>
                    <div class="usr-msg-details">
                      <div class="usr-ms-img">
                        <img src="images/resources/m-img2.png" alt="" />
                      </div>
                      <div class="usr-mg-info">
                        <h3>John Doe</h3>
                        <p>PHP Developer</p>
                      </div>
                      <!--usr-mg-info end-->
                    </div>
                    <span><img src="images/price2.png" alt="" />1165</span>
                  </li>
                  <li>
                    <div class="usr-msg-details">
                      <div class="usr-ms-img">
                        <img src="images/resources/m-img3.png" alt="" />
                      </div>
                      <div class="usr-mg-info">
                        <h3>Poonam</h3>
                        <p>Wordpress Developer</p>
                      </div>
                      <!--usr-mg-info end-->
                    </div>
                    <span><img src="images/price3.png" alt="" />1120</span>
                  </li>
                  <li>
                    <div class="usr-msg-details">
                      <div class="usr-ms-img">
                        <img src="images/resources/m-img4.png" alt="" />
                      </div>
                      <div class="usr-mg-info">
                        <h3>Bill Gates</h3>
                        <p>C & C++ Developer</p>
                      </div>
                      <!--usr-mg-info end-->
                    </div>
                    <span><img src="images/price4.png" alt="" />1009</span>
                  </li>
                </ul>
              </div>
              <!--widget-user end-->
              <div class="widget widget-adver">
                <img src="images/resources/adver-img.png" alt="" />
              </div>
              <!--widget-adver end-->
            </div>
          </div>
        </div>
        <!--forum-questions-sec end-->
      </div>
    </section>
    <Footer />
  </div>
</template>

<script>
import Header from "@/components/user/Header";
import Footer from "@/components/user/Footer";
import PulseLoader from "vue-spinner/src/PulseLoader.vue";
import ScriptLoader from '@/mixins/ScriptLoader';

export default {
  name: "Search",
  mixins: [ScriptLoader],
  components: {
    Header,
    Footer,
    PulseLoader
  },
  // props: {
  // 	loading: asd,
  // 	color: blue,
  // 	size: 30
  // },
  data() {
    return {
      users: {},
      events: {},
      posts: {},
      myConnections: {},
      keyword: "",
      user_id: "",
      connection_id: "",
      already_sent: false,
      sent: false,
      blocked: false,
      connected: false,
      loader: false,
      tt: false
    };
  },

  mounted() {
    this.loadStyleSheets("user");
    this.loadJsScripts("user");
    this.search();
  },

  methods: {
    search() {
      let keyword = window.location.href.split("/").pop();
      let fromUserId = JSON.parse(localStorage.getItem("TTNetwork.user")).id;
      this.keyword = keyword;
      this.$Progress.start();
      axios.defaults.headers.common["Authorization"] =
        "Bearer " + localStorage.getItem("TTNetwork.jwt");
      axios
        .post(`/api/search`, { fromUserId, keyword, table_name: "users" })
        .then(result => {
          this.users = result.data.result.users;
          this.myConnections = result.data.myConnections;
          axios
            .post(`/api/search`, { fromUserId, keyword, table_name: "events" })
            .then(result => {
              this.events = result.data.result.events;
              axios
                .post(`/api/search`, {
                  fromUserId,
                  keyword,
                  table_name: "posts"
                })
                .then(result => {
                  this.posts = result.data.result.posts;
                });
            });
        });
      this.$Progress.finish();
    },
    show_connection_button(userId) {
      var isFound = false;
      var i = -1;
      for (i = 0; i < this.myConnections.length; i++) {
        if (userId == this.myConnections[i].connection_id) {
          isFound = true;
          if (this.myConnections[i].blocked) {
            return '<button class="btn btn-default btn-sm">You are not allowed to send request to this person.</button>';
          } else if (this.myConnections[i].is_accepted) {
            return '<button class="btn btn-success btn-sm">Connected</button>';
          } else {
            return '<button class="btn btn-info btn-sm">Request Sent</button>';
          }
          break;
        }
      }
      if (i >= 0 && isFound == false) {
        return '<button class="btn btn-primary btn-sm">Add Connection</button>';
      }
    },
    add_connection(userId) {
      var isFound = false;
      var i = -1;
      for (i = 0; i < this.myConnections.length; i++) {
        if (userId == this.myConnections[i].connection_id) {
          isFound = true;
          break;
        }
      }
      if (i >= 0 && isFound == false) {
        //it means eligible for connection
        this.loader = true;
        axios.defaults.headers.common["Authorization"] =
          "Bearer " + localStorage.getItem("TTNetwork.jwt");
        let user_id = JSON.parse(localStorage.getItem("TTNetwork.user")).id;
        let connection_id = userId;
        axios
          .post("/api/connection-request", {
            user_id: user_id,
            connection_id: connection_id
          })
          .then(result => {
            this.search();
          });
      }
    }
  }
};
</script>
<style scoped>
.bgclr {
  padding-bottom: 60px;
  padding-top: 10px;
  margin-top: 15px;
}
.section-title {
  margin: 0px 0px 15px 0px;
  font-size: 18px;
  font-weight: bold;
  border-bottom: 1px solid #e2dddd;
  padding-bottom: 3px;
}
.result-loop {
  padding-bottom: 20px;
  border-bottom: 1px solid #f3f3f3;
  margin-bottom: 19px;
}
</style>
