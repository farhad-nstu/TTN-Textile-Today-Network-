<template>
    <div>
        <div class="post-bar"> 
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
        </div> 
    </div>
</template>
<script>
import DateTimeLocation from '@/components/user/Event/DateTimeLocation';
export default {
    name: 'ShareEvent',
    components: {
        DateTimeLocation
    },
    props: {
     event: Object,
    },   
}
</script>