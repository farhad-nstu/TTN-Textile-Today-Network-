<template>
  	<div>
       <ul class="job-dt mt-3">                                   
            <li> <p><i class="fa fa-map-marker mr-1"></i>{{eventDateTimeLocation.venue}}</p></li> <br>
            <li><p><i class="fa fa-calendar mr-1"></i><b class="font-weight-bold"> Start : </b>{{eventDateTimeLocation.start_date}}</p></li>
            <li v-if="eventDateTimeLocation.start_time"> <p> <i class=" fa fa-clock-o mr-1"></i>{{eventDateTimeLocation.start_time}}</p></li> 
            <li v-if="eventDateTimeLocation.end_date"><p><i class=" fa fa-calendar mr-1"></i><b class="font-weight-bold"> End : </b>{{eventDateTimeLocation.end_date}}</p></li>
            <li v-if="eventDateTimeLocation.end_time"><p><i class=" fa fa-clock-o mr-1"></i>{{eventDateTimeLocation.end_time}}</p></li><br>
            <li><p><i class=" fa fa-envelope-o mr-1"></i>{{eventDateTimeLocation.contact_email}}</p></li>
            <li><p><i class=" fa fa-phone mr-1"></i>{{eventDateTimeLocation.contact_phone_no}}</p></li>                           
        </ul>    
	</div>
</template>
<script>
export default {
    name: 'DateTimeLocation',
    props: {
     eventDateTimeLocation: Object,
    },
};
</script>
<style  scoped>

</style>