<template>
    <div>
         <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Admin Login</div>
                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" v-model="email" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" v-model="password" required>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary" @click="admin_login">
                                        Login
                                    </button>
                                  <router-link class="text-primay ml-5" to="/controller-signup">Create one!</router-link>

                                </div>
                            </div>
                        </form>
                    </div>
                     <div v-if="!validUser" class="card-footer" >
                            <p class="text-danger text-center">
                                Incorrect Email and/or Password!
                            </p>
                            <p class="text-center">Please enter valid email and/or password.</p>
                     </div>
                     <div v-if="Inactive" class="card-footer" >
                            <p class="text-danger text-center">
                                Your account does not active
                            </p>
                            <p class="text-center">Please wait  for verified by another admin or contact with admin.</p>
                     </div>
                </div>
            </div>
         </div>
         <FooterBar/>
    </div>
</template>

<script>
import FooterBar from '@/components/admin/FooterBar';

export default {
    name: 'ControllerLogin',
    components: {
        FooterBar
    },
    data() {
            return {
                email: "",
                password: "",

                validUser: true,
                Inactive: false,
                loading: false,
            }
        },
        methods: {
            admin_login(e) {
                e.preventDefault()
                 if (this.password.length > 0) {
                    let email = this.email;
                    let password = this.password;
                    axios.post("api/controller-login", { email, password }).then(response => {
                    this.loading = true;
                    this.validUser = true;
                    let user = response.data.user;
                    let role_id = user.role_id;
                    let status = user.status;
                    localStorage.setItem("TTNetwork.user", JSON.stringify(user));
                    localStorage.setItem("TTNetwork.jwt", response.data.token);
                    if (localStorage.getItem("TTNetwork.jwt") != null) {
                        this.$emit("loggedIn");
                        if (this.$route.params.nextUrl != null) {
                            this.$router.push(this.$route.params.nextUrl);
                        } else {
                            this.$router.push(role_id == 1 && status == 10? "/controller-dashboard" : null);
                        }
                    }
                    }).catch((error) => {
                        console.log(error);
                        if (error.response.data.err == 'invalidAdmin') {
                            this.validUser = false;
                            this.Inactive = false; 
                        } else if(error.response.data.err == 'inActive') {
                          this.Inactive = true;
                          this.validUser = true;
                        }
                    });
                }
            }
        }
    }
</script>