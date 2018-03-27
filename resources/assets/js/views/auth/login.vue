<template>
<div>
   <section class="equal ">
        <div class="Container">
            <div class="login__element">
                <h3 class="login__element--heading">Login</h3>
                <div class="login__element--box">
                    <div class="row login-option">
                        <div class="col-md-6 text-center">
                            <a href="/auth/social/facebook" class="btn facebooklarge">
                                <span><i class="fa fa-facebook" aria-hidden="true"></i></span> Login with Facebook
                            </a>
                        </div>
                        <div class="col-md-6 text-center">
                            <a href="/auth/google" class="btn googlelarge ">
                                <span><i class="fa fa-google-plus" aria-hidden="true"></i></span> Login with Google
                            </a>
                        </div>
                        <h4>OR</h4>
                    </div>
                    <form id="loginform" @submit.prevent="submit">
                        <div class="form-group">
                            <label class="login__element--box--label">Email</label>
                            <input type="email" placeholder="jhon@gmail.com" v-model="loginForm.email" class="login__element--box--input">
                        </div>
                        <div class="form-group">
                            <label class="login__element--box--label">Password</label>
                            <input type="password" placeholder="abc@123" v-model="loginForm.password" class="login__element--box--input">
                        </div>
						
                         <vue-recaptcha sitekey=""></vue-recaptcha>
                        
						<p class="login__element--box--content"><router-link to="/forget_password" class="login__element--box--content--link">Don't remember your password?</router-link></p>
                        <div class="form-group text-center">
                            <input type="Submit" placeholder="" value="Login" class="btn btn-bg-orange login__element--box--button">
                        </div>
						 <p class="login__element--box--content">Not a memeber yet? <router-link to="/register">Join Us</router-link></p>
                    </form>
                </div>

            </div>
        </div>
    </section>
</div>
</template>

<script>
 import VueRecaptcha from 'vue-recaptcha'
    import helper from '../../services/helper'
    import GuestFooter from '../../layouts/guest-footer.vue'

    export default {
	components: { VueRecaptcha },
        data() {
            return {
                loginForm: {
                    email: '',
                    password: ''
                }
            }
        },
       
        mounted(){
        },
        methods: {
            submit(e){
                axios.post('/api/auth/login', this.loginForm).then(response =>  {
                    localStorage.setItem('auth_token',response.data.token);
					
                    axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('auth_token');
					
                    toastr['success'](response.data.message);
					 this.$router.push('/my_account');
                    window.location.reload();
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
            }
        }
    }
</script>
