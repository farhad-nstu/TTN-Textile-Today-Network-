<template>
    <div>
      <div class="user-tab-sec ">
        <div class="float-right mt-5 ">         
            <router-link :to="{name: 'ProfileSetting', params: { id: userData.id}}">
                <button class="btn btn-primary" ><i class="fas fa-cog"></i> Setting</button>       
            </router-link>         
        </div> 
         <div class="tab-feed st2 settingjb">
            <ul>
                <li data-tab="feed-dd" class="active">
                    <a href="#" title="">
                        <img src="/images/ic1.png" alt="">
                        <span>Feeds</span>
                    </a>
                </li>
                <li data-tab="info-dd">
                    <a href="#" title="">
                        <img src="/images/ic2.png" alt="">
                        <span>Info</span>
                    </a>
                </li>
                <li data-tab="saved-jobs">
                    <a href="#" title="">
                        <img src="/images/ic4.png" alt="">
                        <span>Jobs</span>
                    </a>
                </li>
                <li data-tab="my-bids">
                    <a href="#" title="">
                        <img src="/images/ic5.png" alt="">
                        <span>Events</span>
                    </a>
                </li>
                <li data-tab="portfolio-dd">
                    <a href="#" title="">
                        <img src="/images/ic3.png" alt="">
                        <span>Pages</span>
                    </a>
                </li>
                <li data-tab="rewivewdata">
                    <a href="#" title="">
                        <img src="/images/review.png" alt="">
                        <span>Questions</span>
                    </a>
                </li>
                <li data-tab="payment-dd">
                    <a href="#" title="">
                        <img src="/images/ic6.png" alt="">
                        <span>Groups</span>
                    </a>
                </li>                
            </ul>
        </div><!-- tab-feed end-->
    </div><!--user-tab-sec end-->          
    </div>
</template>
<script>
    export default {
        name: 'Profession',
        data() {
            return { 
               userData:{},
                };
            },	  
        mounted(){
         this.userData = JSON.parse(localStorage.getItem('TTNetwork.user'));
        },
    }
</script>
