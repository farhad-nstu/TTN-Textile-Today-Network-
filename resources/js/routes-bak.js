// import App from './views/App'

// User Profile 
import ProfileUpdate from './views/users/ProfileUpdate';
import ProfileAccount from './views/users/ProfileAccount';
import userIndex from './views/users/userIndex';
import Question from './views/users/Question';

import Login from './views/Login';
import Register from './views/Register';
// import AdminLogin from './views/AdminLogin';
import AdminLogin from './components/admin/Login';
import AdminRegister from './views/AdminRegister';

import Dashboard from './views/Dashboard';
import Country from './views/Country';
import AccessPoint from './views/AccessPoint';
import Apps from './views/Apps';
import Badge from './views/Badge';
import ClassifiedCategory from './views/ClassifiedCategory';
import EmailTemplate from './views/EmailTemplate';
import State from './views/State';
import City from './views/City';
import Post from './views/Post';
import PostType from './views/PostType';

import EventType from './views/EventType';
import InterestGroup from './views/InterestGroup';
import JobType from './views/JobType';
import JobCreate from './views/Jobs/JobCreate';
import Language from './views/Language';
import PageCategory from './views/PageCategory';
import QuestionCategory from './views/QuestionCategory';
import Skill from './views/Skill';
import Tag from './views/Tag';
import TagCategory from './views/TagCategory';
import TrainingCategory from './views/TrainingCategory';
import UserType from './views/UserType';

import Role from './views/Role';
import Service from './views/Service';
import Organization from './views/Organization';

export default [
  {
      path: '/login',
      name: 'login',
      component: Login
  },
  {
      path: '/register',
      name: 'register',
      component: Register
  },
  {
      path: '/controller-login',
      name: 'AdminLogin',
      meta: {layout: 'admin-login'},
      component: AdminLogin
  },
  {
      path: '/controller-register',
      name: 'AdminRegister',
      component: AdminRegister
  },
  {
    path: '/dashboard',
    component: Dashboard,
    name: 'Dashboard'
  },

  {
    path: "/countries",
    component: Country,
    name: "Country"
  },

  {
    path: "/access-points",
    component: AccessPoint,
    name: "AccessPoint"
  },

  {
    path: "/apps",
    component: Apps,
    name: "Apps"
  },

  {
    path: "/badges",
    component: Badge,
    name: "Badge"
  },

  {
    path: "/classified-categories",
    component: ClassifiedCategory,
    name: "ClassifiedCategory"
  },

  {
    path: "/email-templates",
    component: EmailTemplate,
    name: "EmailTemplate"
  },

  {
    path: "/states",
    component: State,
    name: "State"
  },

  {
    path: "/cities",
    component: City,
    name: "City"
  },

  {
    path: "/posts",
    component: Post,
    name: "Post"
  },

  {
    path: "/post-types",
    component: PostType,
    name: "PostType"
  },

  {
    path: "/event-types",
    component: EventType,
    name: "EventType"
  },

  {
    path: "/interest-groups",
    component: InterestGroup,
    name: "InterestGroup"
  },

  {
    path: "/job-create",
    component: JobCreate,
    name: "JobCreate"
  },

  {
    path: "/job-types",
    component: JobType,
    name: "JobType"
  },

  {
    path: "/languages",
    component: Language,
    name: "Language"
  },

  {
    path: "/page-categories",
    component: PageCategory,
    name: "PageCategory"
  },

  {
    path: "/question-categories",
    component: QuestionCategory,
    name: "QuestionCategory"
  },

  {
    path: "/skills",
    component: Skill,
    name: "Skill"
  },

  {
    path: "/tags",
    component: Tag,
    name: "Tag"
  },

  {
    path: "/tag-categories",
    component: TagCategory,
    name: "TagCategory"
  },

  {
    path: "/training-categories",
    component: TrainingCategory,
    name: "TrainingCategory"
  },

  {
    path: "/user-types",
    component: UserType,
    name: "UserType"
  },

  {
    path: "/roles",
    component: Role,
    name: "Role"
  },

  {
    path: "/services",
    component: Service,
    name: "Service"
  },

  {
    path: "/organizations",
    component: Organization,
    name: "Organization"
  },



  //user url


  {
    path: "/profile-update",
    component: ProfileUpdate,
    name: "ProfileUpdate"
  },

  {
    path: "/profile-account",
    component: ProfileAccount,
    name: "ProfileAccount"
  },




  {
    path: "/user-index",
    component: userIndex,
    name: "userIndex"
  },

  {
    path: "/question",
    component: Question,
    name: "Question"
  }

  

];
