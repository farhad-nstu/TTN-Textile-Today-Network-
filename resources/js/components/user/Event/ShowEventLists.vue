<template>
    <div>
        <div class="post-bar" v-for="event in showEvents" v-bind:key="event.id">
            <div class="row">
                <router-link :to="'/event-details/'+event.id">
                      <p class="h4 text-justify font-weight-bold text-primary"> {{event.title}}</p>
                </router-link>
            </div>
            <div class="row">
                <p class="text-justify card-text">{{event.details}} <router-link :to="'/event-details/'+event.id">
                    &nbsp; view more
               </router-link></p>
            </div>
            <div class="row" >
                 <DateTimeLocation :eventDateTimeLocation="event"/>
            </div>
            <div class="row" >

                <div class="job-status-bar">
                    <EventFooter   :eventFooter="event"/>
                </div>
            </div>
            <div v-if="event.invited_by">
               <EventInviter :event="event" />
            </div>
        </div>
    </div>
</template>
<script>
import DateTimeLocation from '@/components/user/Event/DateTimeLocation';
import EventFooter from '@/components/user/Event/EventFooter';
import EventInviter from '@/components/user/Event/EventInviter';
export default {
    name: 'ShowEventLists',
    components: {
        EventFooter,
        DateTimeLocation,
        EventInviter,
    },
    props: {
        showEvents: Array,
    },
    methods:{
       
    },
}
</script>