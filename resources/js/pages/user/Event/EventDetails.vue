<template>
  	<div>
        <div class="wrapper">
            <Header/>
            <section class="profile-account-setting">
                <div class="container-fluid">
                    <div class="account-tabs-setting">
                        <div class="row">
                            <div class="col-lg-3">
                                <EventLeftSidebar/>
                            </div>
                            <div class="col-lg-6">
                                <EventTopbar />
                                <EventDetails/>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <Footer/>	  
	</div>
</template>
<script>
import Header from '@/components/user/Header';
import Footer from '@/components/user/Footer';
import EventLeftSidebar from '@/components/user/Event/EventLeftSidebar';
import EventTopbar from '@/components/user/Event/EventTopbar';
import EventDetails from '@/components/user/Event/EventDetails';
import ScriptLoader from '@/mixins/ScriptLoader';
export default {
    name: 'NewEvents',
    mixins: [ScriptLoader],
    components: {
        Header,
        Footer,
        EventDetails,
        EventTopbar,
        EventLeftSidebar,
    },
    mounted() {
        this.loadStyleSheets("user");
        this.loadJsScripts("user");
    },
};
</script>

