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
                                <div class="acc-setting">
                                    <h3 class="text-center">Create Event</h3>
                                    <CreateOrUpdateEvent/>
                                </div>
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
import CreateOrUpdateEvent from '@/components/user/Event/CreateOrUpdateEvent';
import ScriptLoader from '@/mixins/ScriptLoader';
export default {
    name: 'NewEvents',
    mixins: [ScriptLoader],
    components: {
        Header,
        Footer,
        CreateOrUpdateEvent,
        EventLeftSidebar,
    },
    mounted() {
        this.loadStyleSheets("user");
        this.loadJsScripts("user");
    },
};
</script>

