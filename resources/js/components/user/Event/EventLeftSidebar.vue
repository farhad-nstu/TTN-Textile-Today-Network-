<template>
    <div>      
        <div class="acc-leftbar">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a type="button" class="font-weight-bold btn btn-primary"  :class="{'active': events}" @click="set_content_type('events')"> <i class="fa fa-calendar-week"></i>Events</a>
                <a type="button" class="font-weight-bold btn btn-primary"  :class="{'active': myEvent}" @click="set_content_type('my_event')"> <i class="fa fa-calendar-week"></i>My Events</a>
                <a type="button" class="font-weight-bold btn btn-primary" :class="{'active': invitationReceived}"  @click="set_content_type('invitation_received')"><i class="fa fa-shield-alt"></i>Invitation Received</a>
            </div>
        </div>
      </div>
</template>
<script>
export default {
    name: 'EventLeftSidebar',
    data() {
      return { 
        name: "",
        url: null,
        events: false,
        myEvent: false,
        invitationReceived: false,
     };   
   },
  mounted() {
      this.url = window.location.href.split('/').pop();
       if(this.url == 'events'){
            if(JSON.parse(localStorage.getItem('tag')) == 'my_event'){
              this.myEvent = true;
            }else if(JSON.parse(localStorage.getItem('tag')) == 'invitation_received'){
              this.invitationReceived = true;
            }else{
              this.events = true;
            }
       }
      //  JSON.parse(localStorage.getItem('tag'))
  },
   methods:{
     set_content_type(contentType){
    
         localStorage.setItem('tag', JSON.stringify(contentType));
          if(JSON.parse(localStorage.getItem('tag')) == 'my_event'){
              this.events = false;
              this.myEvent = true;
              this.invitationReceived = false;
            }else if(JSON.parse(localStorage.getItem('tag')) == 'invitation_received'){
              this.events = false;
              this.myEvent = false;
              this.invitationReceived = true;
            }else if(JSON.parse(localStorage.getItem('tag')) == 'events'){
              this.events = true;
              this.myEvent = false;
              this.invitationReceived = false;
            }
       if(this.url != 'events'){
         this.$router.push("/events");
       }else{
         this.$emit('setContentType');
       }
     }
   }
}
</script>