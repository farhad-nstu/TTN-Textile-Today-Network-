<template>
    <div>       
        <div class="card-body">
            <form @submit.prevent="update_resume" method="post" enctype="multipart/form-data">
            <strong>File:</strong>
            <input type="file" name="file" id="file" ref="file"  class="form-control" v-on:change="on_file_change" required>
            <button class="btn btn-success">Submit</button>
            </form>
        </div>  
    </div>
</template>

<script>
export default {
    name: 'Resume',
    data() {
        return { 
             resume: "",
             file: "",   
         };
     },
     mounted() {

 	 },
   methods: {
     on_file_change(e){
        console.log(e.target.files[0]);
        this.file = e.target.files[0];
    },
    update_resume(e) {
        e.preventDefault();
        let currentObj = this;
        const config = {
            headers: { 'Content-Type': 'multipart/form-data' }
        }
        console.log(this.file);
        let formData = new FormData();
        formData.append('file', this.file);
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt');
        axios.post('/api/update-resume/'+JSON.parse(localStorage.getItem('TTNetwork.user')).id, formData,{
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        }).then(function (response) {
            currentObj.success = response.data.success;
            console.log(response.data.success);
        })
        .catch(function (error) {
            currentObj.output = error;
        });
    },

   }
}
</script>