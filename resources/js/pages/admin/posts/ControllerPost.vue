<template>
  <div>
    <LeftSidebar/>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
      <HeaderBar/>
        <div class="container-fluid" >
          <div class="row">
            <div class="col">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary float-left">Posts</h6>
                </div>
                <div class="card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th style="width: 70%"><b>Title</b></th>
                        <th style="width: 10%"><b>Status</b></th>
                        <th style="width: 20%"><b>Options</b></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="post in posts.data" :key="post.id">
                        <td>
                          <router-link :to="`/article/${post.id}`">
                            {{ post.title }}
                          </router-link>
                        </td>
                        <td>
                          <span class="badge badge-primary" v-if="post.status == 0">Draft</span>
                          <span class="badge badge-success" v-else-if="post.status == 10">Published</span>
                          <span class="badge badge-light" v-else-if="post.status == 20">Unpublished</span>
                          <span class="badge badge-warning" v-else-if="post.status == 30">Flagged</span>
                          <span class="badge badge-danger" v-else>Spam</span>
                        </td>
                        <td>
                          <router-link :to="`/controller-update-post/${post.id}`" class="com text-dark">
                            <i class="fa fa-edit"></i>
                          </router-link>
                          <button class="btn pt-0">
                            <DeleteModal v-on:setConfirmation="delete_data" :id="post.id"/>                           
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
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
import DeleteModal from '@/components/DeleteModal';
import ScriptLoader from '@/mixins/ScriptLoader';

export default {
  name: 'ControllerPost',
  mixins: [ScriptLoader],
  components: {
    HeaderBar,
    LeftSidebar,
    FooterBar,
    DeleteModal
  },

  data() {
    return {
      posts: {},
    };
  },

  mounted() {
    this.loadStyleSheets("controller");
    this.loadJsScripts("controller");
    this.getData();
  },

  methods: {
    getData(page = 1) {
      this.$Progress.start();
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')
      axios({ method: "GET", url: "/api/posts?page=" + page }).then(
        result => {
          this.posts = result.data.posts;
        },
        error => {
          console.error(error);
        }
      );
      this.$Progress.finish();
    },

    delete_data(id) {
      axios.delete(`/api/posts/${id}`)
        .then(res => {
          this.getData();
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
