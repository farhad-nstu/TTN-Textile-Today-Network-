<template>
    <div>
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <router-link class="sidebar-brand d-flex align-items-center justify-content-center" to="/dashboard">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">TTN Admin</sup></div>
  </router-link>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <router-link class="nav-link" to="/dashboard">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></router-link>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Operation
  </div>
  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true" aria-controls="collapseUsers">
      <i class="fas fa-users-cog"></i>
      <span>User Modules</span>
    </a>
    <div id="collapseUsers" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Options</h6>
        <router-link class="collapse-item" to="/user-types">User Types</router-link>
        <router-link class="collapse-item" to="/access-points">Access Points</router-link>
        <router-link class="collapse-item" to="/apps">Apps</router-link>
        <router-link class="collapse-item" to="/badges">Badges</router-link>
        <router-link class="collapse-item" to="/interest-groups">Interest Groups</router-link>
        <router-link class="collapse-item" to="/skills">Skills</router-link>
        <router-link class="collapse-item" to="/languages">Languages</router-link>
        <router-link class="collapse-item" to="/roles">Roles</router-link>
        <router-link class="collapse-item" to="/services">Services</router-link>
      </div>
    </div>
  </li>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKnowledgeVolt" aria-expanded="true" aria-controls="collapseKnowledgeVolt">
      <i class="fas fa-book-open"></i>
      <span>Knowledge Volt</span>
    </a>
    <div id="collapseKnowledgeVolt" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Options</h6>
        <router-link class="collapse-item" to="/posts">Posts</router-link>
        <router-link class="collapse-item" to="/post-types">Post Types</router-link>
        <router-link class="collapse-item" to="/page-categories">Page Categories</router-link>
      </div>
    </div>
  </li>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseClassifieds" aria-expanded="true" aria-controls="collapseClassifieds">
      <i class="fas fa-shopping-cart"></i>
      <span>Classifieds</span>
    </a>
    <div id="collapseClassifieds" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Options</h6>
        <router-link class="collapse-item" to="/classified-categories">Classified Categories</router-link>
      </div>
    </div>
  </li>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForum" aria-expanded="true" aria-controls="collapseForum">
     <i class="fas fa-question-circle"></i>
      <span>Forum</span>
    </a>
    <div id="collapseForum" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Options</h6>
        <router-link class="collapse-item" to="/question-categories">Question Categories</router-link>
      </div>
    </div>
  </li>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEvents" aria-expanded="true" aria-controls="collapseEvents">
    <i class="fas fa-calendar-day"></i>
      <span>Events</span>
    </a>
    <div id="collapseEvents" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Options</h6>
        <router-link class="collapse-item" to="/event-types">Event Types</router-link>
      </div>
    </div>
  </li>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTraining" aria-expanded="true" aria-controls="collapseTraining">
    <i class="fas fa-graduation-cap"></i>
      <span>Trainings</span>
    </a>
    <div id="collapseTraining" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Options</h6>
        <router-link class="collapse-item" to="/training-categories">Training Categories</router-link>
      </div>
    </div>
  </li>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseJobs" aria-expanded="true" aria-controls="collapseJobs">
    <i class="fab fa-black-tie"></i>
      <span>Jobs</span>
    </a>
    <div id="collapseJobs" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Options</h6>
        <router-link class="collapse-item" to="/job-types">Job Types</router-link>
      </div>
    </div>
  </li>
  
  <!-- Nav Item - -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLocations" aria-expanded="true" aria-controls="collapseLocations">
    <i class="fas fa-map-marker-alt"></i>
      <span>Locations</span>
    </a>
    <div id="collapseLocations" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Options</h6>
        <router-link class="collapse-item" to="/countries">Countries</router-link>
        <router-link class="collapse-item" to="/states">States</router-link>
        <router-link class="collapse-item" to="/cities">Cities</router-link>
      </div>
    </div>
  </li>

  <!-- Nav Item - Utilities Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSettings" aria-expanded="true" aria-controls="collapseSettings">
      <i class="fas fa-fw fa-wrench"></i>
      <span>Settings</span>
    </a>
    <div id="collapseSettings" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Options</h6>
        <router-link class="collapse-item" to="/email-templates">Email Templates</router-link>
        <router-link class="collapse-item" to="/tags">Tags</router-link>
        <router-link class="collapse-item" to="/tag-categories">Tag Categories</router-link>
      </div>
    </div>
  </li>


  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

</ul>
</div>
</template>

<script>
export default {
    
}
</script>