import Vue from "vue";
import VueRouter from "vue-router";

////////////// FOR ADMIN //////////////////////   Controller
import ControllerLogin from "./pages/admin/ControllerLogin";
import ControllerSignup from "./pages/admin/ControllerSignup";
import ControllerDashboard from "./pages/admin/ControllerDashboard";
import ControllerBadges from "./pages/admin/ControllerBadges";
import ControllerManageAdmin from "./pages/admin/ControllerManageAdmin";
import ControllerUserTypes from "./pages/admin/ControllerUserTypes";
import ControllerAccessPoints from "./pages/admin/ControllerAccessPoints";
import ControllerSetting from "./pages/admin/ControllerSetting";
import ControllerApps from "./pages/admin/ControllerApps";
import ControllerInterestGroup from "./pages/admin/ControllerInterestGroup";
import ControllerCity from "./pages/admin/ControllerCity";
import ControllerClassifiedCategory from "./pages/admin/ControllerClassifiedCategory";
import ControllerCountry from "./pages/admin/ControllerCountry";
import ControllerEmailTemplate from "./pages/admin/ControllerEmailTemplate";
import ControllerEventType from "./pages/admin/ControllerEventType";
import ControllerJobType from "./pages/admin/Jobs/ControllerJobType";
import ControllerJob from "./pages/admin/Jobs/ControllerJob";
import ControllerJobCreate from "./pages/admin/Jobs/ControllerJobCreate";
import ControllerLanguage from "./pages/admin/ControllerLanguage";
import ControllerUserPrivacyStatus from "./pages/admin/ControllerUserPrivacyStatus";
import ControllerPageCategory from "./pages/admin/ControllerPageCategory";
import ControllerPost from "./pages/admin/Posts/ControllerPost"; 
import ControllerPostCreate from "./pages/admin/Posts/ControllerPostCreate"; //Controller
import ControllerPostUpdate from "./pages/admin/Posts/ControllerPostUpdate";
import ControllerPostType from "./pages/admin/Posts/ControllerPostType";
import ControllerQuestionCategory from "./pages/admin/ControllerQuestionCategory";
import ControllerRole from "./pages/admin/ControllerRole";
import ControllerService from "./pages/admin/ControllerService";
import ControllerSkill from "./pages/admin/ControllerSkill";
import ControllerState from "./pages/admin/ControllerState";
import ControllerTag from "./pages/admin/ControllerTag";
import ControllerTagCategory from "./pages/admin/ControllerTagCategory";
import ControllerTrainingCategory from "./pages/admin/ControllerTrainingCategory";
//Organization
import ControllerOrganization from "./pages/admin/Organizations/ControllerOrganization";
import ControllerAddOrganization from "./pages/admin/Organizations/ControllerAddOrganization";
import ControllerUpdateOrganization from "./pages/admin/Organizations/ControllerUpdateOrganization";
import ControllerOrganizationDetails from "./pages/admin/Organizations/ControllerOrganizationDetails";
//Policy
import ControllerAddPolicy from "./pages/admin/Policies/ControllerAddPolicy";
import ControllerPolicies from "./pages/admin/Policies/ControllerPolicies";
import ControllerUpdatePolicy from "./pages/admin/Policies/ControllerUpdatePolicy";
import ControllerAddPolicyDetails from "./pages/admin/Policies/ControllerAddPolicyDetails";
import ControllerPolicyDetails from "./pages/admin/Policies/ControllerPolicyDetails";
import ControllerUpdatePolicyDetails from "./pages/admin/Policies/ControllerUpdatePolicyDetails";
//Forum
import ControllerQuestions from "./pages/admin/Questions/ControllerQuestions";
import ControllerAddQuestion from "./pages/admin/Questions/ControllerAddQuestion";
import ControllerQuestionDetails from "./pages/admin/Questions/ControllerQuestionDetails";
import ControllerAnswerDetails from "./pages/admin/Questions/ControllerAnswerDetails";
import ControllerUpdateQuestion from "./pages/admin/Questions/ControllerUpdateQuestion";
import ControllerQuestionAndAnswer from "./pages/admin/Questions/ControllerQuestionAndAnswer";
import ControllerUpdateAnswer from "./pages/admin/Questions/ControllerUpdateAnswer";

//////////////// END Admin Section /////////////////

///////////////// FOR USER ///////////////////////

import LandingPage from "./pages/user/LandingPage";
import ComingSoon from "./pages/user/ComingSoon";
import SignIn from "./pages/user/SignIn";
import SignUp from "./pages/user/SignUp";
import ProfileSetting from "./pages/user/profile/Setting";
import SendVerificationEmail from "./pages/user/SendVerificationEmail";
import ForgotPassword from "./pages/user/ForgotPassword";
import ResetPassword from "./pages/user/ResetPassword";
import ActiveUserAccount from "./pages/user/ActiveUserAccount";
import activeAdminAccount from "./pages/user/activeAdminAccount";
import ProfileDetails from "./pages/user/profile/ProfileDetails";
import Search from "./pages/user/Search";
import Feed from "./pages/user/Feed/Feed";
import SingleArticle from "./pages/user/Article/SingleArticle";
//Forum
import Questions from './pages/user/Forum/Questions';
import AddQuestion from './pages/user/Forum/AddQuestion';
import UpdateQuestion from './pages/user/Forum/UpdateQuestion';
import QuestionDetails from './pages/user/Forum/QuestionDetails';
import UpdateAnswer from './pages/user/Forum/UpdateAnswer';
//Policy
import Policy from "./pages/user/Policy";
import Message from "./pages/user/Message";


import Events from './pages/user/Event/Events';
import NewEvents from './pages/user/Event/NewEvents';
import UpdateEvent from './pages/user/Event/UpdateEvent';
import EventDetails from './pages/user/Event/EventDetails';
//////////// End user section ////////////

Vue.component("pagination", require("laravel-vue-pagination"));

Vue.use(VueRouter);

export default new VueRouter({
  mode: "history",
  routes: [
    {
      path: "/coming-soon",
      component: ComingSoon
    },
    {
      path: "/controller-login",
      component: ControllerLogin
    },
    {
      path: "/controller-signup",
      component: ControllerSignup
    },
    {
      path: "/controller-dashboard",
      component: ControllerDashboard
    },
    {
      path: "/controller-badges",
      component: ControllerBadges
    },
    {
      path: "/controller-manage-admins",
      component: ControllerManageAdmin
    },
    {
      path: "/controller-user-types",
      component: ControllerUserTypes
    },
    {
      path: "/controller-access-points",
      component: ControllerAccessPoints
    },
    {
      path: "/controller-general-settings",
      component: ControllerSetting
    },
    {
      path: "/controller-apps",
      component: ControllerApps
    },
    {
      path: "/controller-interest-groups",
      component: ControllerInterestGroup
    },
    {
      path: "/controller-cities",
      component: ControllerCity
    },
    {
      path: "/controller-classified-categories",
      component: ControllerClassifiedCategory
    },
    {
      path: "/controller-countries",
      component: ControllerCountry
    },
    {
      path: "/controller-email-templates",
      component: ControllerEmailTemplate
    },
    {
      path: "/controller-event-types",
      component: ControllerEventType
    },
    {
      path: "/controller-jobs",
      component: ControllerJob
    },
    {
      path: "/controller-job-create",
      component: ControllerJobCreate
    },
    {
      path: "/controller-job-types",
      component: ControllerJobType
    },
    {
      path: "/controller-languages",
      component: ControllerLanguage
    },
    {
      path: "/controller-user-privacy-status",
      component: ControllerUserPrivacyStatus
    },
    {
      path: "/controller-organization",
      component: ControllerOrganization
    },
    {
      path: "/controller-add-organization",
      component: ControllerAddOrganization
    },
    {
      path: "/controller-update-organization/:id",
      component: ControllerUpdateOrganization
    },
    {
      path: "/controller-organization-details/:id",
      component: ControllerOrganizationDetails
    },
    {
      path: "/controller-page-categories",
      component: ControllerPageCategory
    },
    {
      path: "/controller-posts",
      component: ControllerPost
    }, 
    {
      path: "/controller-post-create",
      component: ControllerPostCreate
    },
    {
      path: "/controller-update-post/:id",
      component: ControllerPostUpdate
    },
    {
      path: "/controller-post-types",
      component: ControllerPostType
    },
    {
      path: "/article/:id",
      component: SingleArticle
    },
    {
      path: "/controller-question-categories",
      component: ControllerQuestionCategory
    },
    {
      path: "/controller-roles",
      component: ControllerRole
    },
    {
      path: "/controller-services",
      component: ControllerService
    },
    {
      path: "/controller-skills",
      component: ControllerSkill
    },
    {
      path: "/controller-states",
      component: ControllerState
    },
    {
      path: "/controller-tags",
      component: ControllerTag
    },
    {
      path: "/controller-tag-categories",
      component: ControllerTagCategory
    },
    {
      path: "/controller-training-categories",
      component: ControllerTrainingCategory
    },
    {
      path: "/",
      component: LandingPage
    },
    {
      path: "/sign-in",
      component: SignIn,
      name: 'SignIn'
    },
    {
      path: "/sign-up",
      component: SignUp,
      name: 'SignUp'
    },
    {
      path: "/profile-setting/:id",
      name: "ProfileSetting",
      component: ProfileSetting
    },
    {
      path: "/send-verification-email",
      name: "SendVerificationEmail",
      component: SendVerificationEmail
    },
    {
      path: "/forgotpassword",
      component: ForgotPassword
    },
    {
      path: "/reset-password/:id/:token",
      component: ResetPassword
    },
    {
      path: "/active-user-account/:id/:token",
      component: ActiveUserAccount
    },
    {
      path: "/active-admin-account/:id/:token",
      component: activeAdminAccount
    },
    {
      path: "/user-profile/:id",
      name: "UserProfile",
      component: ProfileDetails
    },
    ///// Question Section /////
    {
      path: "/forum",
      name: "Questions",
      component: Questions
    },
    {
      path: "/add-question",
      component: AddQuestion
    },
    {
      path: "/question-details/:id",
      component: QuestionDetails
    },
    {
      path: "/update-question/:id",
      component: UpdateQuestion
    },
    {
      path: "/update-answer/:id",
      component: UpdateAnswer
    },
    {
      path: "/controller-questions",
      component: ControllerQuestions
    },
    {
      path: "/controller-question-details/:id",
      component: ControllerQuestionDetails
    },
    {
      path: "/controller-answer-details/:id",
      component: ControllerAnswerDetails
    },
    {
      path: "/controller-update-question/:id",
      component: ControllerUpdateQuestion
    },
    {
      path: "/controller-add-question",
      component: ControllerAddQuestion
    },
    {
      path: "/controller-question-with-answer/:id",
      component: ControllerQuestionAndAnswer
    },
    {
      path: "/controller-update-answer/:id",
      component: ControllerUpdateAnswer
    },
    ///// Event Section /////
    {
      path: "/events",
      name: "Events",
      component: Events
    },
    {
      path: "/new-event",
      name: "NewEvent",
      component: NewEvents
    },
    {
      path: "/update-event/:id",
      name: "UpdateEvent",
      component: UpdateEvent
    },
    {
      path: "/event-details/:id",
      name: "EventDetails",
      component: EventDetails
    },
    {
      path: "/search/:keyword",
      component: Search
    },
    {
      path: "/feed",
      component: Feed
    },
    {
      path: "/policy",
      component: Policy
    },
    {
      path: "/controller-add-policy",
      component: ControllerAddPolicy
    },
    {
      path: "/controller-policies",
      component: ControllerPolicies
    },
    {
      path: "/controller-update-policy/:id",
      component: ControllerUpdatePolicy
    },
    {
      path: "/controller-add-policy-details/:id",
      component: ControllerAddPolicyDetails
    },
    {
      path: "/controller-edit-policy-details/:id",
      component: ControllerUpdatePolicyDetails
    },
    {
      path: "/controller-policy-details/:id",
      component: ControllerPolicyDetails
    },
    {
      path: "/messages",
      component: Message
    }
  ]
});
