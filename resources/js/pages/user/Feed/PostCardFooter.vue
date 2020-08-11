<template>
    <div>
        <div class="job-status-bar">
            <ul class="like-com">
                <li>
                    <a style="font-weight:bold; color:#024ea2" v-if="like_check(article)" href="javascript:void(0);" class="com"
                    @click="unlike(article.id, `Post`)">
                    <i class="fa fa-thumbs-up"></i> Like <b v-show="article.total_like>0">{{article.total_like}}</b>
                    </a>
                    <a v-else href="javascript:void(0);" class="com"
                    @click="like(article.id, `Post`)">
                    <i class="fa fa-thumbs-up"></i> Like <b v-show="article.total_like>0">{{article.total_like}}</b>
                    </a>
                </li>
                <li>
                    <a @click="get_comments" href="javascript:void(0);" class="com">
                        <i class="fa fa-comment"></i>
                        Comment <b v-show="article.total_comment>0">{{article.total_comment}}</b>
                    </a>
                </li>
            <li><a href="javascript:void(0);" class="com" data-toggle="modal"  :data-target="'#shareModal'+article.id" title="Share"><i class="fa fa-share"></i>Share &nbsp;</a></li>
            </ul>
            <a href="#">
                <i class="fa fa-eye com"></i>Views 50
            </a>
        </div>
        <PostComments :article_id="article.id" v-if="showComments" />
        <div class="modal fade" :id="'shareModal'+article.id" tabindex="-1" role="dialog" aria-labelledby="shareModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title text-white text-center h5" id="shareModalTitle">Post Sharing</p>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body m-2">
                        <textarea v-model="shareDetails" class="form-control mb-2" placeholder="Say something about this....."></textarea>
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
                                <img width="13px" src="images/clock.png" alt />3 min ago
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
                    </div>
                    <div class="modal-footer" style="background-color:#024ea2; height:60px">
                        <div class="float-right">
                            <button type="button" class="btn btn-sm  text-white" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-sm  text-white" @click="share_post">Share</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import PostComments from "@/pages/user/Feed/PostComments";
    export default {
        name: "PostCardFooter",
        props: {
            article: {}
        },
        data() {
          return {
            shareDetails: "",
            isLiked: false,
            showComments: false,
            id: JSON.parse(localStorage.getItem("TTNetwork.user")).id
          };
        },
        components: {
            PostComments
        },
        methods: {
            get_comments(){
                if(!this.showComments){
                    this.showComments = true;
                }else if(this.showComments){
                    this.showComments = false;
                }
            },
            like_check(article){
            let check = false;
            if(article.likes.length){
                for(let i=0; i< article.likes.length; i++){
                    if(article.likes[i].user_id == this.id){
                        check = true;
                        break;
                    }
                }
            }
            return check;
            },
            like(likeable_id, likeable_type) {
            this.$Progress.start();
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + localStorage.getItem("TTNetwork.jwt");
            axios
                .post("/api/like-post", {
                user_id: this.id,
                likeable_id: likeable_id
                })
                .then(result => {
                this.$parent.$parent.get_feeds();
                });
            this.$Progress.finish();
            },

            unlike(likeable_id, likeable_type) {
            this.$Progress.start();
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + localStorage.getItem("TTNetwork.jwt");
            axios
                .post("/api/unlike-post", {
                user_id: this.id,
                likeable_id: likeable_id,
                })
                .then(result => {
                this.$parent.$parent.get_feeds();
                });
            this.$Progress.finish();
            },
            share_post(){
                this.$Progress.start();
                console.log("sharing...");
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
                axios.post("/api/share-post",{
                    user_id : this.id,
                    shareable_id : this.article.id,
                    shareDetails : this.shareDetails,
                })
                .then(res => {
                    if(res.data.response == "success"){
                        toast.fire({icon: "info", title: res.data.message});
                        this.comment= "";
                        $('#shareModal'+this.article.id).modal('hide');
                    }else{
                        toast.fire({icon: "info", title: res.data.message});
                    }
                })
                .catch(err => {
                        toast.fire({icon: "info", title: "Please enter valid data."});
                        console.log(err);
                });
                this.$Progress.finish();
            },
        }

    }
</script>

<style lang="scss" scoped>

</style>