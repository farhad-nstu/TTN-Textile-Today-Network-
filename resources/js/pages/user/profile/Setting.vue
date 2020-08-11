<template>
  	<div>
	 <div class="wrapper">
        <Header/>
        <section class="profile-account-setting">
            <div class="container-fluid">
                <div class="account-tabs-setting">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="acc-leftbar">
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-acc-tab" data-toggle="tab" href="#nav-acc" role="tab" aria-controls="nav-acc" aria-selected="true"><i class="la la-cogs"></i>Account Setting</a>
                                    <a class="nav-item nav-link" id="nav-edit-tab" data-toggle="tab" href="#nav-edit" role="tab" aria-controls="nav-edit" aria-selected="false"><i class="fa fa-user-secret"></i>About</a>
                                    <a class="nav-item nav-link" id="nav-status-tab" data-toggle="tab" href="#nav-status" role="tab" aria-controls="nav-status" aria-selected="false"><i class="fas fa-shield-alt"></i>Status</a>
                                    <a class="nav-item nav-link" id="nav-password-tab" data-toggle="tab" href="#nav-password" role="tab" aria-controls="nav-password" aria-selected="false"><i class="fa fa-lock"></i>Change Password</a>
                                    <a class="nav-item nav-link" id="nav-education-tab" data-toggle="tab" href="#nav-education" role="tab" aria-controls="nav-education" aria-selected="false"><i class="fas fa-book-reader"></i>Education</a>
                                    <a class="nav-item nav-link" id="nav-experience-tab" data-toggle="tab" href="#nav-experience" role="tab" aria-controls="nav-experience" aria-selected="false"><i class="fas fa-briefcase"></i>Experience</a>
                                    <a class="nav-item nav-link" id="nav-skill-tab" data-toggle="tab" href="#nav-skill" role="tab" aria-controls="nav-skill" aria-selected="false"><i class="fas fa-brain"></i>Skill</a>
                                    <a class="nav-item nav-link" id="nav-resume-tab" data-toggle="tab" href="#nav-resume" role="tab" aria-controls="nav-resume" aria-selected="false"><i class="fas fa-file"></i>Resume</a>
                                    <a class="nav-item nav-link" id="nav-privacy-tab" data-toggle="tab" href="#privacy" role="tab" aria-controls="privacy" aria-selected="false"><i class="fa fa-paw"></i>Privacy</a>
                                    </div>
                            </div><!--acc-leftbar end-->
                        </div>
                        <div class="col-lg-6">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-acc" role="tabpanel" aria-labelledby="nav-acc-tab">
                                    <AccountSetting/>
                                </div>
                                <div class="tab-pane fade" id="nav-status" role="tabpanel" aria-labelledby="nav-status-tab">
                                    <div class="acc-setting">
                                         <Status/>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-password" role="tabpanel" aria-labelledby="nav-password-tab">
                                    <div class="acc-setting">
                                        <h3> Change Password</h3>
                                        <ChangePassword/>                                    
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-education" role="tabpanel" aria-labelledby="nav-education-tab">
                                    <div class="acc-setting">		                                 
                                         <Education/>                                    
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-experience" role="tabpanel" aria-labelledby="nav-experience-tab">
                                    <div class="acc-setting">
                                         <Experience/>                                    
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-skill" role="tabpanel" aria-labelledby="nav-skill-tab">
                                    <div class="acc-setting">
                                        <Skill/>                                    
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-resume" role="tabpanel" aria-labelledby="nav-resume-tab">
                                    <div class="acc-setting">
                                        <h3>Resume</h3>
                                        <Resume/>                                    
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-edit" role="tabpanel" aria-labelledby="nav-edit-tab">
                                    <div class="privacy security">
                                        <About/>
                                    </div> 
                                </div>
                                <div class="tab-pane fade" id="privacy" role="tabpanel" aria-labelledby="nav-privacy-tab">
                                    <div class="privac">
                                          <Privacy/>
                                    </div>
                                </div>
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
import About from '@/components/user/profile_setting/About';
import ChangePassword from '@/components/user/profile_setting/ChangePassword';
import Education from '@/components/user/profile_setting/Education';
import Experience from '@/components/user/profile_setting/Experience';
import Skill from '@/components/user/profile_setting/Skill';
import Resume from '@/components/user/profile_setting/Resume';
import Status from '@/components/user/profile_setting/Status';
import Privacy from '@/components/user/profile_setting/Privacy';
import AccountSetting from '@/components/user/profile_setting/AccountSetting';
import ScriptLoader from '@/mixins/ScriptLoader';
export default {
    name: 'Setting',
    mixins: [ScriptLoader],
    components: {
        Header,
        Footer,
        About,
        ChangePassword,
        Education,
        Experience,
        Skill,
        Resume,
        Status,
        Privacy,
        AccountSetting
    },
    mounted(){
        this.userData = JSON.parse(localStorage.getItem('TTNetwork.user'));
        this.loadStyleSheets("user");
        this.loadJsScripts("user");
    }, 
    methods: {
        
    }
};
</script>

