<template>
  	<div>
		<div class="wrapper">
			<Header/>
			<CoverPic/>
			<div class="main-section">
				<div class="container-fluid">
					<div class="main-section-data">
						<div class="row">
							<div class="col-lg-3">
								<div class="main-left-sidebar">
									<div class="user_profile">
											<ProfilePic/>
											<SocialLink/>
									</div>
									<div class="suggestions full-width">
										<Friends/>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="main-ws-sec">
									<Profession/>
									<div class="product-feed-tab" id="saved-jobs">
										<Jobs/>
									</div>
									<div class="product-feed-tab current" id="feed-dd">
										<Feed/>
									</div>
									<div class="product-feed-tab" id="my-bids">
										<Bids/>
									</div>
									<div class="product-feed-tab" id="info-dd">
										<Info/>
									</div>
									<div class="product-feed-tab" id="rewivewdata">
										<Reviews/>
									</div>
									<div class="product-feed-tab" id="portfolio-dd">
										<div class="portfolio-gallery-sec">
											<Portfolio_dd/>
										</div>
									</div>
									<div class="product-feed-tab" id="payment-dd">
										<Payment/>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
     	</div>
     	<Footer/>
  	</div>
</template>
<script>
import Header from '@/components/user/Header';
import Footer from '@/components/user/Footer';
import CoverPic from '@/components/user/user_profile/CoverPic';
import ProfilePic from '@/components/user/user_profile/ProfilePic';
import SocialLink from '@/components/user/user_profile/SocialLink';
import Friends from '@/components/user/user_profile/Friends';
import Feed from '@/components/user/user_profile/Feed';
import Info from '@/components/user/user_profile/Info';
import Jobs from '@/components/user/user_profile/Jobs';
import Bids from '@/components/user/user_profile/Bids';
import Reviews from '@/components/user/user_profile/Reviews';
import Portfolio_dd from '@/components/user/user_profile/Portfolio_dd';
import Payment from '@/components/user/user_profile/Payment';
import Profession from '@/components/user/user_profile/Profession';
import ScriptLoader from '@/mixins/ScriptLoader';
export default {
    name: 'ProfileDetails',
	mixins: [ScriptLoader],
    components: {
        Header,
        Footer,
        CoverPic,
        ProfilePic,
        SocialLink,
        Friends,
		Feed,
		Info,
		Jobs,
		Bids,
		Reviews,
		Portfolio_dd,
		Payment,
		Profession
	},
    data() {
   		return {
			userData: {},
    	};
	},
	mounted(){
		this.userData = JSON.parse(localStorage.getItem('TTNetwork.user'));
		this.loadStyleSheets("user");
        this.loadJsScripts("user");
	},
  	methods: {
	
 	}
}
</script>