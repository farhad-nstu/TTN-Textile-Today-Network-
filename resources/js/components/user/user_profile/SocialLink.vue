<template>
    <div>
        <ul class="social_links">
            <li  v-if="userData.facebook_link"> <a  href="userData.facebook_link"> <img src="/images/icons/fb.png" width="30px" class="m-2"> <p class="mt-2">{{userData.facebook_link}}</p></a></li>
            <li  v-if="userData.twitter_link"> <a  href="userData.twitter_link"> <img src="/images/icons/twitter.png" width="30px" class="m-2"><p class="mt-2">{{userData.twitter_link}}</p> </a></li>
            <li  v-if="userData.instagram_link"><a href="userData.instagram_link"> <img src="/images/icons/instagram.png" width="30px" class="m-2"><p class="mt-2">{{userData.instagram_link}}</p>  </a></li>           
            <li v-if="userData.youtube_link"> <a   href="userData.youtube_link"> <img src="/images/icons/youtube.png" width="30px" class="m-2"><p class="mt-2">{{userData.youtube_link}} </p></a></li> 
            <li v-if="userData.linkedin_link"><a   href="userData.linkedin_link"> <img src="/images/icons/linkedin.png" width="30px" class="m-2"><p class="mt-2">{{userData.linkedin_link}}</p>  </a></li>      
            <li v-if="userData.website"><a href="userData.website"> <img src="/images/icons/global.png" width="30px" class="m-2"><p class="mt-2">{{userData.website}}</p> </a></li>                                      
        </ul>             
    </div>
</template>

<script>
    export default {
        name: 'SocialLink',
        data() {
            return { 
                userData :{},
                };
            },	  
        mounted(){
         this.userData = JSON.parse(localStorage.getItem('TTNetwork.user'));
        },
    }
</script>
