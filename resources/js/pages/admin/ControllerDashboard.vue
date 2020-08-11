<template>
    <div>
        <LeftSidebar/>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <HeaderBar/>
                <div class="container-fluid" >
                    <!-- Dashboard component will be here -->
                </div>
            </div>
        </div>
        <FooterBar/>
    </div>
</template>

<script>
import HeaderBar from '@/components/admin/HeaderBar';
import LeftSidebar from '@/components/admin/LeftSidebar';
import FooterBar from '@/components/admin/FooterBar';

import ScriptLoader from '@/mixins/ScriptLoader';

export default {
    name: 'ControllerDashboard',
    mixins: [ScriptLoader],
	mounted(){
		this.loadStyleSheets("controller");
	},
    components: {
        HeaderBar,
        LeftSidebar,
        FooterBar
    }
}
</script>