<template>
    <section id="wrapper">
       
            <div class="login-box card">
            <div class="card-body">
                <h3 class="box-title m-b-20 text-center">Loging in...</h3>
                <div class="form-group m-b-0">
                    <div class="col-sm-12 text-center">
                    <p>Back to Login? <router-link to="/login" class="text-info m-l-5"><b>Sign In</b></router-link></p>
                    </div>
                </div>
            </div>
            
          </div>
        </div>

    </section>
</template>

<script>
   
    export default {
        data() {
            return {}
        },
        
        mounted(){
            axios.post('/api/auth/social/token').then(response => {
                localStorage.setItem('auth_token',response.data.token);
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('auth_token');
                toastr['success'](response.data.message);
				location.reload();
                this.$router.push('/select_role')
            }).catch(error => {
                this.$router.push('/login');
            });
        },
        methods: {
        }
    }
</script>
