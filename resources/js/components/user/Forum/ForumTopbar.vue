<template>  
  <div>      
    <div class="post-topbar">
      <div class="row">
          <!-- <button type="button" class="btn btn-sm btn-outline-primary" :class="{'active': activeLatest}" id="latest" @click="set_question_category('latest',null, categoryId)" >Latest</button> -->
          <!-- <button type="button" class="btn btn-sm btn-outline-primary mx-4" :class="{'active': activeMyQuestion}" id="my-question" @click="set_question_category('my-question', userId, categoryId)" >MyQuestion</button> -->
        <div class="col float-left pl-0">
          <select @change="set_question_category(categoryId)" v-model="categoryId" class="btn btn-sm btn-outline-primary">
            <option v-for="(category,index) in questionCategories" :key="category" v-bind:value="index">
              {{ category }}
            </option>
          </select>
        </div>
        <div class="col pr-0">
          <router-link to="/add-question">
            <button class="btn btn-sm btn-primary float-right">Ask Question</button> 
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ForumTopbar',
  data(){
    return{
      questionCategories: {},
      categoryId: 0,
    }
  },
  // props:{
  //   userId: Number,
  // },
  mounted(){
    this.get_category();
  },
  methods:{
    get_category() {
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
      axios({ method: "GET", url: "/api/get-question-categories"}).then(
        result => {
          console.log(result.data);
          this.questionCategories = result.data;
        },
        error => {
          console.error(error);
        }
      );
    },
    set_question_category(categoryId) {
      // alert(categoryId);
      this.$emit('setQuestions', categoryId);           
    },
  },
}
</script>

<style scoped>
</style>
