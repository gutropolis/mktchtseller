<template>
<div>
   <section class="equal ">
        <div class="Container">
            <div class="login__element">
                <h3 class="login__element--heading">Signup Here</h3>
                <div class="login__element--box">
                    <div class="row login-option">
                        <div class="col-md-6 text-center">
                            <a href="https://healeastern.com/auth/facebook" class="btn facebooklarge">
                                <span><i class="fa fa-facebook" aria-hidden="true"></i></span> Login with Facebook
                            </a>
                        </div>
                        <div class="col-md-6 text-center">
                            <a href="https://healeastern.com/auth/google" class="btn googlelarge ">
                                <span><i class="fa fa-google-plus" aria-hidden="true"></i></span> Login with Google
                            </a>
                        </div>
                        <h4>OR</h4>
                    </div>
                    <form id="registerform" @submit.prevent="submit">
                        <div class="form-group">
                            <label class="login__element--box--label">First Name</label>
                            <input type="text" name="first_name" placeholder="First Name" v-model="registerForm.first_name" class="login__element--box--input">
                        </div>
						<div class="form-group">
                            <label class="login__element--box--label">Last Name</label>
                            <input type="text" name="last_name" placeholder="Last Name" v-model="registerForm.last_name" class="login__element--box--input">
                        </div>
                        <div class="form-group">
                            <label class="login__element--box--label">Email</label>
                            <input type="email" name="email"placeholder="Email" v-model="registerForm.email" class="login__element--box--input">
                        </div>
                        <div class="form-group">
                            <label class="login__element--box--label">Password</label>
                            <input type="password" name="password" placeholder="Password" v-model="registerForm.password" class="login__element--box--input">
                        </div>
                        <div class="form-group">
                            <label class="login__element--box--label">Confirm Password</label>
                            <input type="password" name="password_confirmation" placeholder="Confirm Password" v-model="registerForm.password_confirmation" class="login__element--box--input">
                        </div>
						<div class="form-group">
					   
                            <label class="login__element--box--label">Role</label>
                            <select name="role"  v-model="registerForm.role" class="login__element--box--input">
							<option value="select">Select .. </option>
							<option value="charity">charity</option>
								<option value="seller">Seller</option>
							
							
							</select>
                        </div>

                        <div class="form-group text-center">
                            <input type="Submit" placeholder="" value="Sign Up" class="btn btn-bg-orange login__element--box--button">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
</div>
</template>

<script>
    

    export default {
        data() {
            return {
                registerForm: {
                    email: '',
                    password: '',
                    password_confirmation: '',
                    first_name: '',
                    last_name: '',
					role: 'select'
				}
            }
        },
        
        mounted(){
        },
        methods: {
            submit(e){
                axios.post('/api/auth/register', this.registerForm).then(response =>  {
                    toastr['success'](response.data.message);
                    this.$router.push('/login');
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
            }
        }
    }
</script>
