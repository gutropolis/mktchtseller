<template>
<div>
<section class="equal ">
        <div class="Container">
            <div class="login__element">
                <h3 class="login__element--heading">Forget Password</h3>
                <div class="login__element--box">
					 
                    <form id="passwordform" @submit.prevent="submit">
                        <div class="form-group">
                            <label class="login__element--box--label">Email</label>
                            <input type="email" placeholder="" value=""v-model="passwordForm.email" class="login__element--box--input">
                        </div>

                        <div class="form-group text-center">
                            <input type="Submit" placeholder="" value="Reset Password" class="btn btn-bg-orange login__element--box--button">
                        </div>
                    </form>
                
				   
                <div class="form-group m-b-0">
                    <div class="col-sm-12 text-center">
                    <p>Back to Login? <router-link to="/login" class="text-info m-l-5"><b>Sign In</b></router-link></p>
                    </div>
                </div>
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
                passwordForm: {
                    email: ''
                }
            }
        },
        
        mounted(){
        },
        methods: {
            submit(e){
                axios.post('/api/auth/password', this.passwordForm).then(response =>  {
                    toastr['success'](response.data.message);
                    this.$router.push('/login');
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
            }
        }
    }
</script>
