<template>
   <div>
            <div v-for="article in articles" :key="article.id" class="post-bar">
                      <div class="post_topbar">
                        <div class="usy-dt">
                          <img
                            width="60"
                            v-if="article.user.profile_picture"
                            v-bind:src="
                                '/storage/uploads/' +
                                  article.user.id +
                                  '/Users/' +
                                  article.user.profile_picture
                              "
                            />

                          <img width="60" v-else v-bind:src="'/Images/profile/profile_logo.png'" />

                          <div class="usy-name">
                            <h3>{{article.user.name}}</h3>
                            <span>
                              <img width="13px" src="images/clock.png" alt />** min ago
                            </span>
                          </div>
                        </div>
                      </div>

                      <div class="job_descp">
                        <h3>{{article.title}}</h3>

                        <p>
                          {{article.descr}}
                          <router-link :to="`/article/${article.id}`" title>view more</router-link>
                        </p>
                      </div>
                      <PostCardFooter :article="article" />
            </div>
    </div>
</template>

<script>
import PostCardFooter from "@/pages/user/Feed/PostCardFooter";
export default {
      name: "PostCard",
      props: {
        articles: {}
      },
      components: {
        PostCardFooter
      }
}
</script>

<style lang="scss" scoped>

</style>