<template>  
    <section class="forum-page">  
      <div class="container">
        <div class="forum-questions-sec">
          <div class="col-sm-9">
            <div class="post-topbar">

              <div class="col-sm-12">
                <div class="row">
                  <div class="col-sm-3">
                      <router-link class="link-active" to="/question">  
                        Latest
                      </router-link>
                  </div>
                  <div class="col-sm-3">
                      <router-link class="link-active" to="/my-question">  
                        My Question	
                      </router-link>
                  </div>
                  <div class="col-sm-3">
                        <div class="dropdown">
                        <a class="btn btn-secondary" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" style="margin-right: 600px;">
                          Dropdown link
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                          <a v-for="category in questionCategories" v-bind:key="category.id" class="dropdown-item" href="#">{{category.title}}</a>
                        </div>
                      </div>
                  </div>  
                  <div class="col-sm-3">
                    <router-link to="/create-question"><button class="btn btn-primary">Ask Question</button> </router-link> 
                  </div>
                </div>
            </div>


            </div>  
          </div>  
          </div>
        </div>
    </section> 
</template>

<script>
export default {
    name: 'ForumTopbar',
    data () {
      return {
        questionCategories: {},
      }
    }, 
    mounted() {
      this.getData();
    },
    methods: {
      getData() {
      this.$Progress.start();
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')
      axios({ method: "GET", url: "/api/question-categories"}).then(
        response => {
          console.log(response.data);
          this.questionCategories = response.data.questionCategories;
        },
        error => {
          console.error(error);
        }
      );
      this.$Progress.finish();
    },
    }
}
</script>

<style scoped>
    .btn {
      margin-left: 250px;
    }

    .link-active{
      border: none;
      outline: none;
      padding: 10px;
      margin-top: 20px;
      /* margin-bottom: 20px; */
      padding-left: 20px;
      padding-right: 20px;
      font-family: sans-serif;
      margin-top: 300px;
      font-size: 17px;
      background-color: #fff;
      cursor: pointer;
    }
    .router-link-active, .btn:hover {
      background-color:  #007bff;
      color: white;
      border-radius: .25rem; 
    }
    .forum-heading{
      padding-top: 18px; 
      background-color: #fff;
      margin-top: 20px; 
      width: 100%; 
      height: 70px;
    }




  /* .dropdown {
    text-align: center;
  overflow: hidden;
  }

.dropdown .dropbtn {
  font-size: 14px;  
  border: 1px solid;
  color: rgb(78, 115, 223);
  padding: 10px 10px;
  background-color: white;
  font-family: initial;
  padding-left: 10px;
  padding-right: 10px; 
}

.navbar a:hover, .dropdown:hover .dropbtn {
  background-color: none;
}

.dropdown-content {
  display: none;
  position: relative;
  background-color: #f9f9f9;
  min-width: 5px;
  box-shadow: 0px 8px 16px 0px white;
  z-index: 1;
  
}

.dropdown-content a {
  float: none;
  color: green;
  padding: 0;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {
  background-color: #ddd;
}

.dropdown:hover .dropdown-content {
  display: block;
} */
</style>
