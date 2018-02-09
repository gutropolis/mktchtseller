<template>
<div id="main-wrapper">
	    <section class=" my__account">
        <div class="row">
            <app-sidebar></app-sidebar>
            <div class="col-md-9 dashboard">
                <div class="dashboard__content clearfix">
                
                    <div class="dashboard__content--outer">   
					<div class="dashboard__content--description">
                     <form class="form-horizontal form-material" id="create_ads" @submit.prevent="update">
					<div class="col-md-6">
					<div class="form-group">
					   
                            <label class="login__element--box--label">Ads Type</label>
                            <select name="ads_type" v-model= "create_ads.ads_type" class="login__element--box--input">
							<option value="select">Select .. </option>
							
							<option value="charity" >charity</option>
								<option value="seller" >Seller</option>
							
							
							
							</select>
                        </div>
                        <div class="form-group">
                            <label class="login__element--box--label">Title</label>
                            <input type="text" name="title" v-model="create_ads.title" class="login__element--box--input">
                        </div>
						<div class="form-group">
                            <label class="login__element--box--label">Description</label>
                             <textarea  type="text" name="description" v-model="create_ads.description"  rows="5"  class="login__element--box--input"></textarea>
                        </div>
                       
						<div class="form-group">
                            <label class="login__element--box--label">Image</label>
                            <input type="file" name="image"  class="login__element--box--input">
                        </div>
						
						<div class="form-group">
                            <label class="login__element--box--label">Location</label>
                             <input type="text" name="location" v-model="create_ads.location"  class="login__element--box--input">
                        </div>
						
					</div>
					
						
						
						
						<input type="submit" value="Submit" class="btn btn-info waves-effect waves-light m-t-10">
						  </form>
						    </div>
						  </div> 	
                </div>
            </div>
			</div> 
			</section>
						   </div>
						   </template>
<script>
 import AppSidebar from '../users/sidebar.vue'
 import Vue from 'vue'
	 export default {
	  components: {
              AppSidebar 
        },
	data() {
            return {
				
                create_ads: {}
            }
        },
       created: function()
        {
            this.fetchItems();
			
        },
        
       
        methods: {
		fetchItems(){
                axios.get('/api/get_ad/'+this.$route.params.id).then(response=>{
                    this.create_ads = response.data;    
                }).catch(error=>{
			toastr['error'](error.response.data.message);
			});
			},
              update(){
                axios.post('/api/get_ad/'+this.$route.params.id,this.create_ads).then(response =>  {
                    toastr['success'](response.data.message);
                    this.$router.push('/product');
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
            },
			
        }
    }
	
</script>


						 