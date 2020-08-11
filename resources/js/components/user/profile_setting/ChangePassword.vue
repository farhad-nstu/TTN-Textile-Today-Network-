<template>
    <div>
       <form @submit.prevent="change_password">
            <div v-if="message && check" class="cp-field">
               <p class="text-success"> Password has been changed successfully!</p>
            </div>
            
            <div v-if="!message && !check" class="cp-field">
               <p class="text-danger"> Password can't change! please try again!</p>
            </div>
            

            <div class="cp-field">
                <h5>Old Password</h5>
                <div class="cpp-fiel">
                    <input type="password" v-model="old_password" placeholder="Old Password" required>
                    <i class="fa fa-lock"></i>
                </div>
            </div>
            <div class="cp-field">
                <h5>New Password</h5>
                <div class="cpp-fiel">
                    <input type="password" v-model="new_password" placeholder="New Password" required>
                    <i class="fa fa-lock"></i>
                </div>
            </div>
            <div class="cp-field">
                <h5>Repeat Password</h5>
                <div class="cpp-fiel">
                    <input type="password" v-model="repeat_password" placeholder="Repeat Password" required>
                    <i class="fa fa-lock"></i>
                </div>
            </div>
            <div class="save-stngs pd2">
                <ul>
                    <li><button type="submit">Change Password</button></li>                    
                </ul>
            </div>
        </form>                              
    </div>
</template>

<script>
export default {
    name: 'ChangePassword',
    data() {
return { 
        old_password:  "",
        new_password: "",
        repeat_password: "",

        message: false,
        check : true,
    };
     },

  methods: {
   change_password() {
            if (this.new_password !== this.repeat_password) {
                this.old_password = "";
                this.new_password = "";
                this.repeat_password = "";
                return alert('Passwords do not match')
            }
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('TTNetwork.jwt')
        axios.put('/api/change-password/'+JSON.parse(localStorage.getItem('TTNetwork.user')).id,{         
            old_password: this.old_password,
            new_password: this.new_password,
            repeat_password: this.repeat_password
        })
        .then( response=> {
            console.log(response.data);
            if(response.data.response =="success"){
                toast.fire({icon: "info", title: response.data.message });
                this.message = true;
                this.old_password= "";
                this.new_password= "";
                this.repeat_password= "";
            }else{
                 toast.fire({icon: "info", title: response.data.message });
                this.message = false;
                this.check = false;
            }
           
        });
     },
  }
}
</script>