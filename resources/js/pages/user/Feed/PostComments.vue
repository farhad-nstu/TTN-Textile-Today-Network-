<template>
    <div>
        <div class="comment-section">
            <div class="post-comment">
                <div class="comment_box">
                <div class="cm_img">
                    <img
                    width="60"
                    v-if="user_profile.profile_picture"
                    v-bind:src="
                        '/storage/uploads/' +
                        user_profile.id +
                        '/Users/' +
                        user_profile.profile_picture
                    "
                    />
                    <img width="60" v-else :src="'/Images/profile/profile_logo.png'" />
                </div>
                <form @submit.prevent="add_comment(article_id, `Post`)">
                    <input
                    v-model="comment[article_id]"
                    type="text"
                    placeholder="Post a comment..."
                    required
                    />
                    <button type="submit">Comment</button>
                </form>
                </div>
            </div>
            <div class="comment-sec">
                <ul>
                    <li v-for="comment in postComments" :key="comment.id">
                    <div class="comment-list">
                        <div class="cm_img">
                        <img
                            width="60"
                            v-if="comment.user.profile_picture"
                            v-bind:src="
                            '/storage/uploads/' +
                                comment.user.id +
                                '/Users/' +
                                comment.user.profile_picture
                            "
                        />
                        <img width="60" v-else :src="'/Images/profile/profile_logo.png'" />
                        </div>
                        <div class="comment">
                        <h3>{{comment.user.name}}</h3>
                        <!-- <span>
                            <img src="images/clock.png" alt /> 3 min ago
                        </span>-->
                        <div v-if="checkCommentId!=comment.id">
                            <h4 class="mt-2">{{comment.comment}}
                            <div class="dropdown float-right">
                                <a class="float-right comment-options-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                <div style="position: absolute"  class="dropdown-menu" id="comment-options">
                                    <a class="comment-option" @click="edit_comment(comment)" href="javascript:void(0);">Edit</a>
                                    <a class="comment-option" @click="delete_comment(comment)" href="javascript:void(0);">Delete</a>
                                </div>
                            </div>
                            </h4>
                            <div>
                                <ul>
                                    <li>
                                        <a style="font-weight:bold; color:#024ea2" v-if="comment_like_check(comment)" href="javascript:void(0);" class="com"
                                        @click="unlike_comment(comment.id, `Comment`)">
                                        <i class="fa fa-thumbs-up"></i> Like <b v-show="comment.total_likes>0">{{comment.total_likes}}</b>
                                        </a>
                                        <a v-else href="javascript:void(0);" class="com"
                                        @click="like_comment(comment.id, `Comment`)">
                                        <i class="fa fa-thumbs-up"></i> Like <b v-show="comment.total_likes>0">{{comment.total_likes}}</b>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div v-else-if="checkCommentId == comment.id">
                            <form @submit.prevent="update_comment(article_id, comment.id)">
                            <input
                                class="update-comment"
                                v-model="editComment"
                                type="text"
                                required
                            />
                            <button class="btn btn-primary btn-sm" type="submit">Update</button>
                            <button class="btn btn-warning btn-sm" @click="checkCommentId=null">Cancel</button>
                            </form>
                        </div>
                        </div>
                    </div>
                    </li>
                </ul>
            </div>
            <!--post-comment end-->
            </div>
    </div>
</template>

<script>
    export default {
        name: "PostComments",
        props: {
            article_id: Number
        },
        data(){
            return{
                editComment: [],
                checkCommentId: "",
                comment: [],
                postComments:{},
                user_profile: JSON.parse(localStorage.getItem("TTNetwork.user")),
            }
        },
        mounted() {
            this.get_comments();
        },
        methods: {
            get_comments(){
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
                axios({ method: "GET", url: "/api/get-post-comments/"+this.article_id }).then(
                    result => {
                        this.postComments = result.data[0].comments;
                    },
                    error => {
                    console.error(error);
                    }
                );
            },
            add_comment(commentable_id, commentable_type) {
            this.$Progress.start();
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + localStorage.getItem("TTNetwork.jwt");
            axios
                .post("/api/comment", {
                    id: this.user_profile.id,
                    commentable_id: commentable_id,
                    commentable_type: commentable_type,
                    comment: this.comment[commentable_id]
                })
                .then(result => {
                    this.comment[commentable_id] = null;
                    this.get_comments();
                });
            this.$Progress.finish();
            },

            edit_comment(comment){
                this.checkCommentId = comment.id;
                this.editComment = comment.comment;
            },

            delete_comment(comment){
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + localStorage.getItem("TTNetwork.jwt");
            axios
                .post("/api/delete-comment", {
                id: comment.id,
                user_id: JSON.parse(localStorage.getItem("TTNetwork.user")).id,
                commentable_id: comment.commentable_id
                })
                .then(result => {
                this.checkCommentId = null;
                this.get_comments();
                });
            this.$Progress.finish();
            },

            update_comment(article_id, comment_id){
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + localStorage.getItem("TTNetwork.jwt");
            axios
                .post("/api/update-comment", {
                    id: comment_id,
                    comment: this.editComment,
                })
                .then(result => {
                    this.checkCommentId = null;
                    this.get_comments();
                });
            this.$Progress.finish();
            },
            comment_like_check(comment){
            let check = false;
            if(comment.likes.length){
                for(let i=0; i< comment.likes.length; i++){
                    if(comment.likes[i].user_id == this.user_profile.id){
                        check = true;
                        break;
                    }
                }
            }
            return check;
            },
            like_comment(likeable_id, likeable_type) {
            this.$Progress.start();
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + localStorage.getItem("TTNetwork.jwt");
            axios
                .post("/api/like-comment", {
                user_id: this.user_profile.id,
                likeable_id: likeable_id
                })
                .then(result => {
                 this.get_comments();
                });
            this.$Progress.finish();
            },

            unlike_comment(likeable_id, likeable_type) {
            this.$Progress.start();
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + localStorage.getItem("TTNetwork.jwt");
            axios
                .post("/api/unlike-comment", {
                user_id: this.user_profile.id,
                likeable_id: likeable_id,
                })
                .then(result => {
                 this.get_comments();
                });
            this.$Progress.finish();
            },
        }
    }
</script>

<style lang="scss" scoped>

</style>