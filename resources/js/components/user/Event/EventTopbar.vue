<template>
    <div>      
         <div class="post-topbar">
           <div class="row">
                  <button type="button" class="btn btn-sm btn-outline-primary mr-1" :class="{'active': activeUpComing}" id="up-coming" @click="set_event_category('up-coming', eventTypeId)" >Upcoming</button>
                  <button type="button" class="btn btn-sm btn-outline-primary mr-1" :class="{'active': activeArchived}" id="archived" @click="set_event_category('archived',eventTypeId)" >Archived</button>
                  <button type="button" class="btn btn-sm btn-outline-primary mr-1" :class="{'active': activAllEvent}" id="all-events" @click="set_event_category('all-events',eventTypeId)" >All Events</button>
                   <select v-if=" url == 'events' "  @change="set_event_category(storeCategory,eventTypeId)" v-model="eventTypeId" class="btn btn-sm btn-outline-primary ">
                      <option v-for="(type,index) in eventTypes" :key="type" v-bind:value="index">
                        {{ type}}
                      </option>
                  </select>
                  <div class="col float-right">
                  <router-link to="/new-event"><button class="btn btn-sm btn-primary float-right">New Event</button> </router-link> 
                  </div>
            </div>
         </div>
    </div>
</template>
<script>
 export default {
  name: 'EventTopbar',
  data(){
    return{
      eventTypes: [],
      eventTypeId: 0,
      url: null,
      activeUpComing: false,
      storeCategory: "up-coming",
      activeArchived: false,
      activAllEvent: false,
    }
  },
  mounted(){
    // this.set_event_category('up-coming', 0)
    this.get_event_types()
    if(JSON.parse(localStorage.getItem('typeId')) != 0 && JSON.parse(localStorage.getItem('typeId')) !=null){
       this.eventTypeId = JSON.parse(localStorage.getItem('typeId'));
    }
    this.url = window.location.href.split('/').pop();
      if(this.url == 'events'){
          if(JSON.parse(localStorage.getItem('category')) == 'archived'){
            this.activeArchived = true;
          }else if(JSON.parse(localStorage.getItem('category')) == 'all-events'){
            this.activAllEvent = true;
          }else{
            this.activeUpComing = true;
          }
      }

  },
  methods:{
        get_event_types() {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
            axios({ method: "GET", url: "/api/get-event-types"}).then(
              result => {
                console.log(result.data);
                this.eventTypes = result.data;
              },
              error => {
                console.error(error);
              }
            );
        },
        set_event_category(eventCategory, eventTypeId) {
          localStorage.setItem('category', JSON.stringify(eventCategory));
          localStorage.setItem('typeId', JSON.stringify(eventTypeId));
          if(JSON.parse(localStorage.getItem('category')) == "up-coming"){
               this.storeCategory = "up-coming";
               this.activeUpComing = true;
               this.activeArchived = false;
               this.activAllEvent = false;
          }else if(JSON.parse(localStorage.getItem('category')) == "archived"){
               this.storeCategory = "archived";
               this.activeUpComing = false;
               this.activeArchived = true;
               this.activAllEvent = false;
          }else if(JSON.parse(localStorage.getItem('category')) == "all-events"){
               this.storeCategory = "all-events";
               this.activeUpComing = false;
               this.activeArchived = false;
               this.activAllEvent = true
          }
          if(this.url != 'events'){
            this.$router.push("/events");
          }else{
            this.$emit('setEvents');
          }            
        },
  },
}
</script>
