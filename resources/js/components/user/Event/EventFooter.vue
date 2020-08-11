<template>
  	<div>
        <ul class="like-com">
            <li><a href="javascript:void(0);" class="com  text-dark" :class="{'font-weight-bold': eventFooter.like_user_id}" title="Like"  @click="like_or_unlike_event(eventFooter)"><i class="fa fa-thumbs-up"></i>Like &nbsp;{{eventFooter.total_likes}}</a></li> 
            <!-- <li><img  class="rounded-circle" v-bind:src="'/storage/uploads/'+userData.id+'/Users/'+userData.profile_picture"  width="40px" ></li>  -->
            <li><a href="javascript:void(0);" class="com text-dark" title="Comment" @click="get_comments"><i class="fa fa-comment"></i> Comment &nbsp;{{eventFooter.total_comments}}</a></li>
            <li><a href="javascript:void(0);" class="com text-dark" @click="get_connected_users" data-toggle="modal"  :data-target="'#invitationModal'+eventFooter.id" title="Invite"><i class="fa fa-user-plus"></i>Invite &nbsp;</a></li>                              
            <li><a href="javascript:void(0);" class="com text-dark" data-toggle="modal"  :data-target="'#shareModal'+eventFooter.id" title="Share"><i class="fa fa-share"></i>Share &nbsp;</a></li>                              
        </ul>  
        <ul  v-if="userData.id == eventFooter.creator_id" class="like-com float-right mt-2">
            <li> <router-link :to="'/update-event/'+eventFooter.id"><a class="com text-dark" href="" title="Edit">
                <i class="fa fa-edit"></i>
            </a></router-link></li>
            <li>
                <a href="#" class="com text-dark" @click="delete_event(eventFooter.id)" title="Delete"> <i class="fa fa-trash"></i></a>                              
            </li>
        </ul>
        <EventComments v-on:commentIncrementDecrement="comment_increment_decrement" :eventId="eventFooter.id" v-if="displayComments"/>
         <div class="modal fade" :id="'shareModal'+eventFooter.id" tabindex="-1" role="dialog" aria-labelledby="shareModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                 <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title text-white text-center h5" id="shareModalTitle">Event Sharing</p>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body m-2">
                        <textarea v-model="comment" class="form-control mb-2" placeholder="Say something about this....."></textarea>
                        <ShareEvent :event="eventFooter" />
                    </div> 
                    <div class="modal-footer" style="background-color:#024ea2; height:60px">
                        <div class="float-right">
                            <button type="button" class="btn btn-sm  text-white" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-sm  text-white" @click="share_event">Share</button>
                        </div>
                    </div>                                
                </div>
            </div>
        </div>
         <div class="modal fade" :id="'invitationModal'+eventFooter.id" tabindex="-1" role="dialog" aria-labelledby="invitationModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title text-white text-center h5" id="invitationModalTitle">Invitation</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div v-if="!connectedUsers.length">
                        <P class="text-center h3">You are not connected to others. Please connect to others then invite them.</P>
                    </div>
                    <div v-else>
                         <div class="row">
                            <div class="col">
                                <span class="badge badge-primary float-right"> Select All <input type="checkbox" v-model="select_all"> </span>
                            </div>
                        </div>
                        <div v-for="connectedUser in connectedUsers" :key="connectedUser.id" >
                            <div class="row">
                                <div class="col-2">
                                    <router-link :to="{name: 'UserProfile', params: { id: connectedUser.id}}">
                                        <div v-if="connectedUser.profile_picture">
                                            <img class="rounded-circle" v-bind:src="'/storage/uploads/'+connectedUser.id+'/Users/'+connectedUser.profile_picture"  width="30px" >
                                        </div>
                                        <div v-else>
                                            <img class="rounded-circle" v-bind:src="'/images/profile/profile_logo.png'"  width="30px">
                                        </div>
                                    </router-link>
                                </div>
                                <div class="col">
                                    <router-link :to="{name: 'UserProfile', params: { id: connectedUser.id}}">
                                    <p>{{connectedUser.name}}</p>
                                    </router-link>
                                </div>
                                <div class="col">
                                    <div v-if="invitation_exists_or_not(connectedUser.id)">
                                        <input type="checkbox" :value="connectedUser.id" :id="connectedUser.id" v-model="invitationIds">
                                    </div>
                                    <div v-else> <span class="badge badge-primary"> Invited</span></div>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="modal-footer" style="background-color:#024ea2; height:60px">
                    <div class="float-right">
                        <button type="button" class="btn btn-sm  text-white" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-sm  text-white" @click="send_event_invitation">Send</button>
                    </div>
                </div>                                
                </div>
            </div>
        </div>
	</div>
</template>
<script>
import ShareEvent from '@/components/user/Event/ShareEvent';
import EventComments from '@/components/user/Event/EventComments';
export default {
    name: 'EventFooter',
    components:{
        ShareEvent,
        EventComments
    },
    data() {
		return { 
		comment:"",
		userData:{},
		invitationIds:[],
		connectedUsers:{},
        invitedUsers:[],
        displayComments:false,
    	};   
    },
    props: {
     eventFooter: Object,
    },
    computed: {
        select_all: {
            get: function () {
                return this.connectedUsers ? this.invitationIds.length == this.connectedUsers.length : false;
            },
            set: function (value) {
                var selected = [];
                let invitedUsers =  this.invitedUsers;
                if (value) {
                    this.connectedUsers.forEach(function (connectedUser) {
                        let active = false;
                        invitedUsers.forEach(function (invitedUser){
                            if(invitedUser == connectedUser.id ){
                                active = true;
                            }
                        });
                        if(active == false){
                            selected.push(connectedUser.id);
                        }
                    });
                }
                this.invitationIds = selected;
            }
        }
    },
    mounted() {
        this.userData = JSON.parse(localStorage.getItem('TTNetwork.user'));
    },
    methods: {
        get_comments(){
             if(!this.displayComments){
                this.displayComments = true;
             }else if(this.displayComments){
                 this.displayComments = false;
             }
        },
        // like_check_for_event_details(likes){
        //     alert(likes.length);
        //      for(let i=0; i< likes.length; i++){
        //         if(likes[i].user_id == this.userData.id){
        //             this.eventFooter.like_user_id = this.userData.id;
        //             break;
        //         }
        //     }
        //         alert( this.eventFooter.like_user_id);
        // },
        like_or_unlike_event(eventFooter){
            if(!eventFooter.like_user_id){
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
                axios.post("/api/like-event",{
                    user_id : this.userData.id,
                    likeable_id : this.eventFooter.id,
                })
                .then(res => {
                    if(res.data.response == "success"){ 
                        this.eventFooter.total_likes++;
                        eventFooter.like_user_id = 1;
                        toast.fire({icon: "info", title: res.data.message});
                    }else{
                        toast.fire({icon: "info", title: res.data.message});                  
                    }
                })
                .catch(err => { 
                        console.log(err);
                });
            }else if(eventFooter.like_user_id){
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
                axios.post("/api/unlike-event",{
                    user_id : this.userData.id,
                    likeable_id : this.eventFooter.id,
                })
                .then(res => {
                    if(res.data.response == "success"){ 
                        eventFooter.like_user_id = 0;
                        this.eventFooter.total_likes--;
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
        share_event(){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
            axios.post("/api/share-event",{
                user_id : this.userData.id,
                shareable_id : this.eventFooter.id,
                comment : this.comment,
            })
            .then(res => {
                if(res.data.response == "success"){ 
                    toast.fire({icon: "info", title: res.data.message});
                    this.comment= "";
                    $('#shareModal'+this.eventFooter.id).modal('hide');
                }else{
                    toast.fire({icon: "info", title: res.data.message});                  
                }
            })
            .catch(err => { 
                    toast.fire({icon: "info", title: "Please enter valid data."});                                           
                    console.log(err);
            });
        },
        send_event_invitation(){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
            axios.post("/api/send-event-invitation",{
                invited_by : this.userData.id,
                invited_to : this.invitationIds,
                invitationable_id : this.eventFooter.id,
            })
            .then(res => {
                if(res.data.response == "success"){ 
                    toast.fire({icon: "info", title: res.data.message});
                    this.invitationIds= [];
                    $('#invitationModal'+this.eventFooter.id).modal('hide');
                }else{
                    toast.fire({icon: "info", title: res.data.message});                  
                }
            })
            .catch(err => { 
                    toast.fire({icon: "info", title: "Please enter valid data."});                                           
                    console.log(err);
            });
        },
        get_connected_users(){
             axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');			
            axios({ method: "GET", url: "/api/get-connected-users/"+this.userData.id+"/"+this.eventFooter.id}).then(
                result => {
                    this.connectedUsers = result.data.connectedUsers;
                    this.invitedUsers = result.data.invitedUsers;
                },
                error => {
                console.error(error);
                }
            );
        },
        invitation_exists_or_not(connectedUserId){
            let active = true;
            for(let i=0; i<this.invitedUsers.length; i++){
                if(this.invitedUsers[i] == connectedUserId){
                    active = false;
                    break;
                }
            }
            return active;
        },
        delete_event(id) {
            if (confirm("Are yor comfirm to delete?")) {
                axios
                .delete(`/api/delete-event/${id}`)
                .then(res => {
                    toast.fire({icon: "info",title: "Deleted!" });
                    this.$router.push( "/events");
                })
                .catch(err => {
                    console.log(err);
                });
            }
        },
        comment_increment_decrement(commnetTrueFalse){
            if(commnetTrueFalse){
                this.eventFooter.total_comments++
            }else{
                this.eventFooter.total_comments--;
            }
        },
    }
};
</script>
