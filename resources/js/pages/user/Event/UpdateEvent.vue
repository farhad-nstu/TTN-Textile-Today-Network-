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
                                    <h3 class="text-center">Update Event</h3>
                                    <CreateOrUpdateEvent ref="form"/>
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
    name: 'UpdateEvent',
    mixins: [ScriptLoader],
    components: {
        Header,
        Footer,
        CreateOrUpdateEvent,
        EventLeftSidebar,
    },
    mounted(){
        this.get_edit_event(window.location.href.split('/').pop());
        this.loadStyleSheets("user");
        this.loadJsScripts("user");
    },
    methods: {
        get_edit_event(eventId){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
            axios({ method: "GET", url: "/api/get-edit-event/"+eventId+"/"+JSON.parse(localStorage.getItem('TTNetwork.user')).id,}).then(
                result => {          
                     //console.log(result.data.event);          
                    this.$refs.form.edit_event(result.data.event);                    
                error => {
                console.error(error);
                }
            });  
        }        
    }
};
</script>

