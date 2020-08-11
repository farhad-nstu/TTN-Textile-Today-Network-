<template>
  <div style="float:left;">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <router-link
        class="sidebar-brand d-flex align-items-center justify-content-center"
        to="/dashboard"
      >
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fa fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">TTN Admin</div>
      </router-link>

      <!-- Divider -->
      <hr class="sidebar-divider my-0" />

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <router-link class="nav-link" to="/controller-dashboard">
          <i class="fa fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </router-link>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider" />

      <!-- Heading -->
      <div class="sidebar-heading">Operation</div>
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a
          class="nav-link"
          href="#"
          data-toggle="collapse"
          data-target="#collapseUsers"
          aria-expanded="true"
          aria-controls="collapseUsers"
        >
          <i class="fa fa-users-cog"></i>
          <span>User Modules</span>
        </a>
        <div
          id="collapseUsers"
          class="collapse"
          aria-labelledby="headingPages"
          data-parent="#accordionSidebar"
        >
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Options</h6>
            <router-link class="collapse-item" to="/controller-user-types">User Types</router-link>
            <router-link class="collapse-item" to="/controller-manage-admins">Manage Admins</router-link>
            <router-link class="collapse-item" to="/controller-access-points">Access Points</router-link>
            <router-link class="collapse-item" to="/controller-apps">Apps</router-link>
            <router-link class="collapse-item" to="/controller-badges">Badges</router-link>
            <router-link class="collapse-item" to="/controller-interest-groups">Interest Groups</router-link>
            <router-link class="collapse-item" to="/controller-skills">Skills</router-link>
            <router-link class="collapse-item" to="/controller-languages">Languages</router-link>
            <router-link class="collapse-item" to="/controller-user-privacy-status">User Privacy Status</router-link>
            <router-link class="collapse-item" to="/controller-roles">Roles</router-link>
            <router-link class="collapse-item" to="/controller-services">Services</router-link>
          </div>
        </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a
          class="nav-link collapsed"
          href="#"
          data-toggle="collapse"
          data-target="#collapseKnowledgeVolt"
          aria-expanded="true"
          aria-controls="collapseKnowledgeVolt"
        >
          <i class="fa fa-book-open"></i>
          <span>Knowledge Volt</span>
        </a>
        <div
          id="collapseKnowledgeVolt"
          class="collapse"
          aria-labelledby="headingTwo"
          data-parent="#accordionSidebar"
        >
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Options</h6>
            <router-link class="collapse-item" to="/controller-post-create">New Post</router-link>
            <router-link class="collapse-item" to="/controller-posts">Posts</router-link>
            <router-link class="collapse-item" to="/controller-post-types">Post Types</router-link>
            <router-link class="collapse-item" to="/controller-page-categories">Page Categories</router-link>
          </div>
        </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a
          class="nav-link collapsed"
          href="#"
          data-toggle="collapse"
          data-target="#collapseClassifieds"
          aria-expanded="true"
          aria-controls="collapseClassifieds"
        >
          <i class="fa fa-shopping-cart"></i>
          <span>Classifieds</span>
        </a>
        <div
          id="collapseClassifieds"
          class="collapse"
          aria-labelledby="headingTwo"
          data-parent="#accordionSidebar"
        >
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Options</h6>
            <router-link class="collapse-item" to="/controller-classified-categories">Classified Categories</router-link>
          </div>
        </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a
          class="nav-link collapsed"
          href="#"
          data-toggle="collapse"
          data-target="#collapseForum"
          aria-expanded="true"
          aria-controls="collapseForum"
        >
          <i class="fa fa-question-circle"></i>
          <span>Forum</span>
        </a>
        <div
          id="collapseForum"
          class="collapse"
          aria-labelledby="headingTwo"
          data-parent="#accordionSidebar"
        >
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Options</h6>
            <router-link class="collapse-item" to="/controller-question-categories">Question Categories</router-link>
            <router-link class="collapse-item" to="/controller-questions">Questions</router-link>
          </div>
        </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a
          class="nav-link collapsed"
          href="#"
          data-toggle="collapse"
          data-target="#collapseEvents"
          aria-expanded="true"
          aria-controls="collapseEvents"
        >
          <i class="fa fa-calendar-day"></i>
          <span>Events</span>
        </a>
        <div
          id="collapseEvents"
          class="collapse"
          aria-labelledby="headingTwo"
          data-parent="#accordionSidebar"
        >
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Options</h6>
            <router-link class="collapse-item" to="/controller-event-types">Event Types</router-link>
          </div>
        </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a
          class="nav-link collapsed"
          href="#"
          data-toggle="collapse"
          data-target="#collapseTraining"
          aria-expanded="true"
          aria-controls="collapseTraining"
        >
          <i class="fa fa-graduation-cap"></i>
          <span>Trainings</span>
        </a>
        <div
          id="collapseTraining"
          class="collapse"
          aria-labelledby="headingTwo"
          data-parent="#accordionSidebar"
        >
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Options</h6>
            <router-link class="collapse-item" to="/controller-training-categories">Training Categories</router-link>
          </div>
        </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a
          class="nav-link collapsed"
          href="#"
          data-toggle="collapse"
          data-target="#collapseJobs"
          aria-expanded="true"
          aria-controls="collapseJobs"
        >
          <i class="fab fa-black-tie"></i>
          <span>Jobs</span>
        </a>
        <div
          id="collapseJobs"
          class="collapse"
          aria-labelledby="headingTwo"
          data-parent="#accordionSidebar"
        >
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Options</h6>
            <router-link class="collapse-item" to="/controller-jobs">Jobs</router-link>
            <router-link class="collapse-item" to="/controller-job-create">New Job</router-link>
            <router-link class="collapse-item" to="/controller-job-types">Job Types</router-link>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed">
          <i class="fa fa-home"></i>
          <span>
            <router-link class="collapse-item" style="color: #fff;" to="/controller-organization">Organizations</router-link>
          </span>
        </a>
      </li>

      <!-- Nav Item - -->
      <li class="nav-item">
        <a
          class="nav-link collapsed"
          href="#"
          data-toggle="collapse"
          data-target="#collapseLocations"
          aria-expanded="true"
          aria-controls="collapseLocations"
        >
          <i class="fa fa-map-marker-alt"></i>
          <span>Locations</span>
        </a>
        <div
          id="collapseLocations"
          class="collapse"
          aria-labelledby="headingUtilities"
          data-parent="#accordionSidebar"
        >
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Options</h6>
            <router-link class="collapse-item" to="/controller-countries">Countries</router-link>
            <router-link class="collapse-item" to="/controller-states">States</router-link>
            <router-link class="collapse-item" to="/controller-cities">Cities</router-link>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a
          class="nav-link collapsed"
          href="#"
          data-toggle="collapse"
          data-target="#collapseSettings"
          aria-expanded="true"
          aria-controls="collapseSettings"
        >
          <i class="fa fa-fw fa-wrench"></i>
          <span>Settings</span>
        </a>
        <div
          id="collapseSettings"
          class="collapse"
          aria-labelledby="headingUtilities"
          data-parent="#accordionSidebar"
        >
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Options</h6>
            <router-link class="collapse-item" to="/controller-general-settings">General Settings</router-link>
            <router-link class="collapse-item" to="/controller-email-templates">Email Templates</router-link>
            <router-link class="collapse-item" to="/controller-tags">Tags</router-link>
            <router-link class="collapse-item" to="/controller-tag-categories">Tag Categories</router-link>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed">
          <i class="fa fa-unlock"></i>
          <span>
            <router-link to="/controller-policies" style="color: #fff;">Policy</router-link>
          </span>
        </a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block" />
    </ul>
    <!-- End of Sidebar -->
  </div>
</template>

<script>
export default {
  name: "LeftSidebar"
};
</script>