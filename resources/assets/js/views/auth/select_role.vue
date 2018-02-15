<template>
	<div>
	 <div class="dashboard__content--outer">
                        
                        <div class="dashboard__content--description">
	 <form id="saverole" @submit.prevent="submit">
		<div class="form-group">
                            <label class="login__element--box--label">Select Role</label>
                           <select name="role" v-model="saverole.role" class="login__element--box--input">
								<option value=""> Select ...</option>
								<option value="seller"> Seller</option>
								<option value="charity"> Charity</option>
								
								</select>
                        </div>
	 
	 

	 <div class="form-group text-center">
            <input type="Submit" placeholder="" value="Save" class="btn btn-bg-orange login__element--box--button">
                        </div>
							 
	 </form>
	 </div>
	 </div>
	
	</div>





</template>
<script>
    export default {
        data() {
            return {
                saverole: {
                   role:''
					
				}
            }
        },
        
        mounted(){
        },
        methods: {
            submit(e){
                axios.post('/api/auth/selectrole', this.saverole).then(response =>  {
                    toastr['success'](response.data.message);
                    this.$router.push('/my_account');
					location.reload();
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
            }
        }
    }
</script>
