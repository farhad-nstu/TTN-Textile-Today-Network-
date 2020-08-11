<template>
  	<div>
        <div class="comment-section">
            <div class="post-comment">
                <div class="comment_box">
                    <div class="cm_img">
                        <img v-if="userData.profile_picture" width="60"  v-bind:src="'/storage/uploads/'+userData.id +'/Users/'+userData.profile_picture"/>
                        <img v-else  width="60" :src="'/Images/profile/profile_logo.png'" />
                    </div>
                    <form @submit.prevent="add_comment">
                        <input v-model="comment" type="text" placeholder="Comment..." required />
                        <button type="submit">Comment</button>
                    </form>
                </div>
            </div>
            <div class="comment-sec">
                <div v-for="comment in eventComments" :key="comment.id" class="comment-list">
                    <div class="cm_img">
                        <router-link :to="{name: 'UserProfile', params: { id: comment.user.id}}">
                            <img v-if="comment.user.profile_picture" width="60"  v-bind:src="'/storage/uploads/'+comment.user.id +'/Users/'+comment.user.profile_picture"/>
                            <img v-else  width="60" :src="'/Images/profile/profile_logo.png'" />
                        </router-link>
                    </div>
                    <div class="comment">
                        <router-link :to="{name: 'UserProfile', params: { id: comment.user.id}}">
                            <h3>{{comment.user.name}}</h3>
                            <span>{{comment.created_at | formatDate}}</span>
                        </router-link>
                        <p v-if="checkCommentId != comment.id" class="text-justify">{{comment.comment}}</p>
                        <div v-if="checkCommentId == comment.id">
                            <form @submit.prevent="update_comment(comment.id)">
                                <div class="comment_box">
                                <input v-model="editComment" type="text" required />
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary mt-1">Update</button>
                                <button class="btn btn-sm btn-warning mt-1" @click="checkCommentId=''" >Cancel</button>
                            </form>
                        </div>
                        <div>
                            <a href="javascript:void(0);" class="com text-dark"  :class="{'font-weight-bold':  comment.likes.length}" title="Like"  @click="like_or_unlike_event(comment)"><i class="fa fa-thumbs-up"></i>Like &nbsp;{{comment.total_likes}}</a>&nbsp;
                        </div>
                        <div v-if="userData.id == comment.user_id && checkCommentId != comment.id">
                            <a href="javascript:void(0);" @click="edit_comment(comment.id,comment.comment)" >Edit</a>&nbsp;
                            <a href="javascript:void(0);" @click="delete_comment(comment.id)">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</template>
<script>
export default {
    name: 'EventComments',
    data() {
		return { 
		comment:"",
		editComment:"",
		userData:{},
		eventComments:{},
        checkCommentId:"",
    	};   
    },
    props: {
     eventId: Number,
    },
     mounted() {
        this.userData = JSON.parse(localStorage.getItem('TTNetwork.user'));
        this.get_comments();
    },
    methods: {
        like_or_unlike_event(comment){
            if(!comment.likes.length){
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
                axios.post("/api/like-event-comment",{
                    user_id : this.userData.id,
                    likeable_id : comment.id,
                })
                .then(res => {
                    if(res.data.response == "success"){ 
                        comment.total_likes++;
                        comment.likes.length = 1;
                        toast.fire({icon: "info", title: res.data.message});
                    }else{
                        toast.fire({icon: "info", title: res.data.message});                  
                    }
                })
                .catch(err => { 
                        console.log(err);
                });
            }else if(comment.likes.length){
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
                axios.post("/api/unlike-event-comment",{
                    user_id : this.userData.id,
                    likeable_id : comment.id,
                })
                .then(res => {
                    if(res.data.response == "success"){ 
                        comment.total_likes--;
                        comment.likes.length = 0;
                        toast.fire({icon: "info", title: res.data.message});
                    }else{
                        toast.fire({icon: "info", title: res.data.message});                  
                    }
                })
                .catch(err => { 
                        console.log(err);
                });
            }
        },
        edit_comment(commentId,comment){
            this.editComment = comment;
            this.checkCommentId = commentId;
        },
        update_comment(commentId){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
            axios.post("/api/update-event-comment",{
                commentId : commentId,
                comment : this.editComment,
            })
            .then(res => {
                if(res.data.response == "success"){ 
                    toast.fire({icon: "info", title: res.data.message});
                    this.editComment= "";
                    this.checkCommentId= "";
                    this.get_comments()
                }else{
                    toast.fire({icon: "info", title: res.data.message});                  
                }
            })
            .catch(err => { 
                    console.log(err);
            });
        },
        add_comment(){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
            axios.post("/api/add-event-comment",{
                user_id : this.userData.id,
                commentable_id : this.eventId,
                comment : this.comment,
            })
            .then(res => {
                if(res.data.response == "success"){ 
                    toast.fire({icon: "info", title: res.data.message});
                    this.comment= "";
                    this.$emit('commentIncrementDecrement',true);
                    this.get_comments()
                }else{
                    toast.fire({icon: "info", title: res.data.message});                  
                }
            })
            .catch(err => { 
                    console.log(err);
            });
        },
        get_comments(){
           axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');			
            axios({ method: "GET", url: "/api/get-event-comments/"+this.eventId+"/"+this.userData.id}).then(
                result => {
                    this.eventComments = result.data.eventComments;                 
                    console.log(this.eventComments);
                },
                error => {
                console.error(error);
                }
            ); 
        },
        delete_comment(commentId) {
            if (confirm("Are yor comfirm to delete?")) {
                axios
                .delete(`/api/delete-event-comment/${commentId}`)
                .then(res => {
                    if(res.data.response == 'success'){
                        toast.fire({icon: "info",title: "Deleted!" });
                        this.$emit('commentIncrementDecrement',false);
                        this.get_comments();
                    }else{
                        toast.fire({icon: "info",title: "Delete failed, Please try again!" });
                    }
                })
                .catch(err => {
                    console.log(err);
                });
            }
        },
    },
};
</script>
