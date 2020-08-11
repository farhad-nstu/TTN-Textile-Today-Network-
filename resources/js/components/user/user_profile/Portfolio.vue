<template>
    <div>
      
    </div>
</template>

<script>
export default {
    name: 'Portfolio',
    data() {
      return{
        userData: {},
      }
  
  },
  mounted(){
    this.userData = JSON.parse(localStorage.getItem('TTNetwork.user'));
   },
  methods: {
    
  }
}
</script>