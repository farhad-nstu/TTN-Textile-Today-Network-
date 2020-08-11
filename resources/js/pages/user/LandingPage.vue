<template>
  <div>
    <div class="full-body">

      <LandingPageHeader />

      <div style="display: block;height: 50px"></div>
      <section class="block">
        <div class="container">
          <div class="row">
            <div class="col-sm-6">
              <h1 class="block-title">Your business network.</h1>
              <h1 class="block-subtitle">Focused Indeed!</h1>

              <ul class="block-points">
                <li class>Build your network</li>
                <li class>Share your thoughts</li>
                <li class>Know what others sharing</li>
                <li class>Free and Premium articles and more ...</li>
              </ul>
              <router-link class="btn-rounded-big" :to="{}">Articles</router-link>&nbsp; &nbsp; &nbsp;
              <router-link class="btn-rounded-big" :to="{}">Feeds</router-link>
            </div>

            <div class="col-sm-6">
              <img class="block-img" :src="'images/home/business-network.jpg'" alt />
            </div>
          </div>
        </div>
      </section>

      <section class="block">
        <div class="container">
          <div class="row">
            <div class="col">
              <img class="block-img" :src="'images/home/Groups.jpg'" alt />
            </div>
            <div class="col">
              <h1 class="block-title">Progress and grow with groups</h1>

              <ul class="block-points">
                <li class>Create group</li>
                <li class>Define rules to join</li>
                <li class>Group activities</li>
                <li class>Can be public or private ...</li>
              </ul>

              <router-link class="btn-rounded-big" to="/coming-soon">Create Group</router-link>&nbsp; &nbsp; &nbsp;
              <router-link class="btn-rounded-big" to="/coming-soon">Join Group</router-link>
            </div>
          </div>
        </div>
      </section>

      <section class="block">
        <div class="container">
          <div class="row">
            <div class="col">
              <h1 class="block-title">Your business updates though pages.</h1>

              <p class="block-points">Share your business updates with the followers through pages.</p>

              <router-link class="btn-rounded-big" to="/coming-soon">Create page</router-link>
            </div>
            <div class="col" align="center">
              <img class="block-img" :src="'images/home/pages.jpg'" alt />
            </div>
          </div>
        </div>
      </section>

      <section
        class
        style="background: url(images/home/event-bg.jpg) no-repeat center center; background-size: cover;padding: 72px 0px; margin: 40px 0px"
      >
        <div class="container">
          <div class="row">
            <div class="col">
              <img class="block-img" :src="'images/home/event-img.png'" alt />
            </div>
            <div class="col">
              <h1 class="block-title" style="color:#fff">
                Invite others
                <br />at your events
              </h1>

              <ul class="block-points-white">
                <li class>Create event</li>
                <li class>Invite people to join</li>
                <li class>Know who are joining</li>
              </ul>

              <router-link class="btn-rounded-big-white" to="/event">Create Event</router-link>&nbsp; &nbsp; &nbsp;
              <router-link class="btn-rounded-big-white" to="/event">Join Event</router-link>
            </div>
          </div>
        </div>
      </section>

      <section class="block">
        <div class="container">
          <div class="row">
            <div class="col">
              <h1 class="block-title">Buy and sell with few clicks</h1>

              <p
                class="block-points"
              >Post an ad to buy or sell, reach to the right clients. Right clients give quick conversion.</p>

              <router-link class="btn-rounded-big" to="/coming-soon">View Ads</router-link>&nbsp; &nbsp; &nbsp;
              <router-link class="btn-rounded-big" to="/coming-soon">Post Ad</router-link>
            </div>
            <div class="col" align="center">
              <img class="block-img" :src="'images/home/ads.png'" alt />
            </div>
          </div>
        </div>
      </section>

      <section class="block">
        <div class="container">
          <div class="row">
            <div class="col">
              <img class="block-img" :src="'images/home/forum.jpg'" alt />
            </div>
            <div class="col">
              <h1 class="block-title">Place question to get answer from the experienced</h1>

              <p
                class="block-points"
              >Grow your profile with points through valuable answers. Placing important question will give you points too.</p>

              <router-link class="btn-rounded-big" to="/coming-soon">Ask Question</router-link>&nbsp; &nbsp; &nbsp;
              <router-link class="btn-rounded-big" to="/coming-soon">Explore All</router-link>
            </div>
          </div>
        </div>
      </section>

      <section class="block">
        <div class="container">
          <div class="row">
            <div class="col">
              <h1
                class="block-title"
                style="font-size: 35px; line-height: 47px;"
              >An Open Platform for Sharing and Collaborating to Serve Industry Training and Capacity Building Demand.</h1>

              <p
                class="block-points"
              >Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to</p>

              <router-link class="btn-rounded-big" :to="{ }">Get Started Now</router-link>
            </div>

            <div class="col" align="center">
              <img class="block-img" :src="'images/home/training.png'" alt />
            </div>
          </div>
        </div>
      </section>

      <section class="block">
        <div class="container">
          <div class="row">
            <div class="col" align="center">
              <img class="block-img" :src="'images/home/jobs.jpg'" alt />
            </div>

            <div class="col">
              <h1 class="block-title">Find Your Career. You Deserve It ...</h1>

              <p
                class="block-points"
              >There’s a better way to find great people and build rewarding careers. More job security & more options to choose from – this generation of job-seekers needs a new approach to careers.</p>
              <router-link class="btn-rounded-big" to="/coming-soon">Get Started Now</router-link>
            </div>
          </div>
        </div>
      </section>

      <section>
        <div class="container">
          <div class="row">
            <div class="col content-center" align="center">
              <h2 style="font-weight: 800; font-size: 28px">
                <router-link
                  style="text-transform: uppercase;
                text-decoration: none !important;
                border: 1px solid #2C81D5;
                padding: 2px 10px !important;
                border-radius: 21px;
                background: #2C81D5;
                font-size: 22px;
                font-weight: bold;
                box-shadow: 4px 8px 25px -6px rgba(44,129,213,1);
                color: #fff;"
                  to="/sign-in"
                >Join</router-link>&nbsp; &nbsp;or Download the
                <span style="color:#2C81D5">App</span> Now!
              </h2>
                <img :src="'images/home/play-button.jpg'" alt />
            </div>
          </div>
        </div>
      </section>

      <LandingPageFooter />
    </div>
  </div>
</template>

<script>
import LandingPageHeader from "@/components/user/LandingPageHeader";
import LandingPageFooter from "@/components/user/LandingPageFooter";
import ScriptLoader from '@/mixins/ScriptLoader';

export default {
	name: "LandingPage",
	mixins: [ScriptLoader],  
	components: {
		LandingPageHeader,
		LandingPageFooter
	},
	data () {
		return {
		};
	},
	mounted(){
		this.loadStyleSheets("user");
		this.loadJsScripts("user");
	}
};
</script>
<style>
.full-body {
  background-color: #fff !important;
  height: fit-content;
}
.clear {
  clear: both;
}
</style>
