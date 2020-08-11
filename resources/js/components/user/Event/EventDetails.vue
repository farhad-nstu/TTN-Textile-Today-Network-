<template>
  	<div>
        <div class="post-bar">
            <div class="row">
                 <p class="h4 text-justify font-weight-bold text-primary"> {{eventDetails.title}}</p>                     
            </div>
            <div class="row">
                <div class="col-12" v-if="eventDetails.banner" >
                    <img  v-bind:src="'/storage/uploads/'+userData.id+'/Events/'+eventDetails.banner" height="250px"  width="100%" >
                </div>				
                <div  class="col-12" v-else>
                    <img v-bind:src="'/images/resources/cover-img.jpg'" height="250px" width="100%">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <p class="text-justify job-dt mt-2">{{eventDetails.details}}</p>
                    <div class="MultiCarousel" data-items="1,2,3,3" data-slide="1" id="MultiCarousel"  data-interval="1000">
                        <div class="MultiCarousel-inner">
                            <div class="item" v-for="mentor in eventDetails.user" :key="mentor.id">
                                <div v-if="mentor.is_mentor == 1" class="pad15 card"  style="width:150px">
                                    <router-link v-if="mentor.id" :to="{name: 'UserProfile', params: { id: mentor.id}}">
                                        <div v-if="mentor.profile_picture">
                                            <img class="img-fluid card-img-top" v-bind:src="'/storage/uploads/'+mentor.id+'/Users/'+mentor.profile_picture">              
                                        </div>
                                        <div v-else>
                                            <img class="img-fluid card-img-top" v-bind:src="'/images/profile/profile_logo.png'"  >
                                        </div>
                                        <p class="font-weight-bold ">{{mentor.name}}</p>
                                        <p class="text-justify">{{mentor.about_yourself}}</p>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                        <!-- <button class="btn btn-primary leftLst"><i class="fas fa-arrow-left"></i></button>
                        <button class="btn btn-primary rightLst"><i class="fas fa-arrow-right"></i></button> -->
                    </div>
                </div>
            </div>
            <div class="row">
                <ul class="job-dt mt-3">
                    <li v-for="interestGroup in eventDetails.interest_groups" :key="interestGroup.id"> <a href="#"> {{interestGroup.title}} </a> </li>
                </ul>
            </div>
            <DateTimeLocation :eventDateTimeLocation="eventDetails"/>   
            <div class="job-status-bar">
                <EventFooter  :eventFooter="eventDetails" />
            </div>                                   
            
        </div>
    </div>	  
</template>

<script>
import DateTimeLocation from '@/components/user/Event/DateTimeLocation';
import EventFooter from '@/components/user/Event/EventFooter';

export default {
    name: 'EventDetails',
    components: {
        EventFooter,
        DateTimeLocation
    },
    data() {
		return { 
		userData:{},
        eventDetails:{},
        firstMentorId: null,
    	};   
    },
    mounted() {
        this.userData = JSON.parse(localStorage.getItem('TTNetwork.user'));
        this.get_event_details(window.location.href.split('/').pop())
    },
    methods: {
        get_event_details(eventId) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');			
            axios({ method: "GET", url: "/api/get-event-details/"+eventId+"/"+JSON.parse(localStorage.getItem('TTNetwork.user')).id }).then(
                result => {
                    this.eventDetails = result.data.eventDetails;
                    // this.$refs.form.like_check_for_event_details(result.data.eventDetails.likes);
                    console.log(this.eventDetails);
                    let creator = 0;
                   this.eventDetails.user.forEach(function (user) {
                        if(user.is_creator == 1){
                            creator = user.id;
                        }
                    });
                    this.eventDetails.creator_id = creator;
                    this.$emit('setEventDetails',this.eventDetails)
                    // this.firstMentorId = this.eventDetails.user[0].id;
                },
                error => {
                console.error(error);
                }
            );
        },
    }
};
/*********** Below is jquery */
$(document).ready(function () {
    // var itemsMainDiv = ('.MultiCarousel');
    // var itemsDiv = ('.MultiCarousel-inner');
    // var itemWidth = "";

    // $('.leftLst, .rightLst').click(function () {
    //     var condition = $(this).hasClass("leftLst");
    //     if (condition)
    //         click(0, this);
    //     else
    //         click(1, this)
    // });

    // ResCarouselSize();

    // $(window).resize(function () {
    //     ResCarouselSize();
    // });

    // //this function define the size of the items
    // function ResCarouselSize() {

    //     var incno = 0;
    //     var dataItems = ("data-items");
    //     var itemClass = ('.item');
    //     var id = 0;
    //     var btnParentSb = '';
    //     var itemsSplit = '';
    //     var sampwidth = $(itemsMainDiv).width();
    //     var bodyWidth = $('body').width();

    //     $(itemsDiv).each(function () {
    //         id = id + 1;
    //         var itemNumbers = $(this).find(itemClass).length;
    //         btnParentSb = $(this).parent().attr(dataItems);
    //         itemsSplit = btnParentSb.split(',');
    //         $(this).parent().attr("id", "MultiCarousel" + id);


    //         if (bodyWidth >= 1200) {
    //             incno = itemsSplit[3];
    //             itemWidth = sampwidth / incno;
    //         }
    //         else if (bodyWidth >= 992) {
    //             incno = itemsSplit[2];
    //             itemWidth = sampwidth / incno;
    //         }
    //         else if (bodyWidth >= 768) {
    //             incno = itemsSplit[1];
    //             itemWidth = sampwidth / incno;
    //         }
    //         else {
    //             incno = itemsSplit[0];
    //             itemWidth = sampwidth / incno;
    //         }
    //         $(this).css({ 'transform': 'translateX(0px)', 'width': itemWidth * itemNumbers });
    //         $(this).find(itemClass).each(function () {
    //             $(this).outerWidth(itemWidth);
    //         });

    //         $(".leftLst").addClass("over");
    //         $(".rightLst").removeClass("over");

    //     });
    // }

    // //this function used to move the items
    // function ResCarousel(e, el, s) {

    //     var leftBtn = ('.leftLst');
    //     var rightBtn = ('.rightLst');
    //     var translateXval = '';
    //     var divStyle = $(el + ' ' + itemsDiv).css('transform');
    //     var values = divStyle.match(/-?[\d\.]+/g);
    //     var xds = Math.abs(values[4]);
    //     if (e == 0) {
    //         translateXval = parseInt(xds) - parseInt(itemWidth * s);
    //         $(el + ' ' + rightBtn).removeClass("over");

    //         if (translateXval <= itemWidth / 2) {
    //             translateXval = 0;
    //             $(el + ' ' + leftBtn).addClass("over");
    //         }
    //     }
    //     else if (e == 1) {
    //         var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
    //         translateXval = parseInt(xds) + parseInt(itemWidth * s);
    //         $(el + ' ' + leftBtn).removeClass("over");

    //         if (translateXval >= itemsCondition - itemWidth / 2) {
    //             translateXval = itemsCondition;
    //             $(el + ' ' + rightBtn).addClass("over");
    //         }
    //     }
    //     $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
    // }

    // //It is used to get some elements from btn
    // function click(ell, ee) {
    //     var Parent = "#" + $(ee).parent().attr("id");
    //     var slide = $(Parent).attr("data-slide");
    //     ResCarousel(ell, Parent, slide);
    // }

});
</script>
<style  scoped>
    .MultiCarousel { float: left; overflow: hidden; padding: 15px; width: 100%; position:relative; }
    .MultiCarousel .MultiCarousel-inner { transition: 1s ease all; float: left; }
    .MultiCarousel .MultiCarousel-inner .item { float: left;}
    .MultiCarousel .MultiCarousel-inner .item > div { text-align: center; margin:10px; background:#f1f1f1; color:#666;}
    .MultiCarousel .leftLst, .MultiCarousel .rightLst { position:absolute; border-radius:50%;top:calc(50% - 20px); }
    .MultiCarousel .leftLst { left:0; }
    .MultiCarousel .rightLst { right:0; }
    .MultiCarousel .leftLst.over, .MultiCarousel .rightLst.over { pointer-events: none; background:#ccc; }
</style>