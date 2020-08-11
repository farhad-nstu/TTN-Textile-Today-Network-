<template>
    <div class="row py-3 mt-3 shadow job-status-bar">
        <div class="col-3">
              <p class="font-weight-bold" > Invitation From</p>
        </div>
        <div class="col-4">
          <router-link :to="{name: 'UserProfile', params: { id: event.invited_by}}">
              <div v-if="event.invitor_profile_picture">
                  <img class="rounded-circle mr-2" v-bind:src="'/storage/uploads/'+event.invited_by+'/Users/'+event.invitor_profile_picture"  width="40px" >
              </div>
              <div v-else>
                  <img class="rounded-circle mr-2" v-bind:src="'/images/profile/profile_logo.png'"  width="40px">
              </div>
              <p class="font-weight-bold" > {{event.invitor_name}} </p>
          </router-link>   
        </div>
        <div class="col">
              <div v-if="event.status == 10" >
                  <a class="btn btn-sm btn-success font-weight-bold text-white" @click="join_or_ignore_invitation('join', event)">Accepted</a>
                  <a class="btn btn-sm btn-info font-weight-bold text-white" @click="join_or_ignore_invitation('not_interest', event)">Not Interested </a>
              </div>
              <div v-else >
                  <a class="btn btn-sm btn-success font-weight-bold text-white" :class="{'disabled' : event.status == 20}"  @click="join_or_ignore_invitation('join', event)">Accepted</a>
                  <a class="btn btn-sm btn-info font-weight-bold text-white" :class="{'disabled' : event.status == 30}" @click="join_or_ignore_invitation('not_interest', event)">Not Interested </a>
              </div>     
        </div>
    </div>
</template>

<script>
export default {
    name: 'EventInviter',
    data() {
        return{
          name: "",
      }
  },
  props: {
      event: Object,
  },
  methods: {
      join_or_ignore_invitation(joinOrNot, event){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
            axios.post("/api/event-invitation-accept-or-not",{
                joinOrNot,
                invitationId: event.invitation_id
            })
            .then(res => {
                if(res.data.response == "success"){ 
                    event.status = res.data.status;
                    toast.fire({icon: "info", title: res.data.message});
                }else{
                    toast.fire({icon: "info", title: res.data.message});                  
                }
            })
            .catch(err => { 
                    console.log(err);
            });
        }
  }
}
</script>