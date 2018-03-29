<template>
<div id="main-wrapper">

	    <section class=" my__account">
        <div class="row">
            <app-sidebar></app-sidebar>
            <div class="col-md-9 dashboard">
                <div class="dashboard__content clearfix">   
                    
                    <div class="dashboard__content--outer">
                        
                       <form  @submit.prevent="proceed">
					  <div class="form-group">
					   
                            <label class="login__element--box--label">Product Name</label>
                          {{item.product_name}}
                        </div>
						<div class="form-group">
						 <label class="login__element--box--label">Charity Organization</label>
                          {{item.charity_organisation}}
                        </div>
					 
					   <div class="form-group">
					 <label class="charity__element--block--content--box--label">Update Units</label>
					<input type="text" name="units"  v-model="item.units" placeholder="Units"  class="login__element--box--input" />
                   </div>
				    <div class="form-group text-center">
                            <input type="Submit" placeholder="" value="Update" class="btn btn-bg-orange login__element--box--button">
                        </div>
                     </form>               
					
                       
                    </div>
					
                </div>
            </div>
			
        </div>
    </section>
	

</div>
</template>
<script>

 import AppSidebar from '../users/sidebar.vue'
import Vue from 'vue';

 


 export default {
	 components: {
              AppSidebar 
        },
	        data() {
			
            return {
			item: {},
			prod:{},
			product:[],
                savecategory: {
				
					parent_id:0,
				   
                    
                }
            }
        },
       created: function()
        {
		this.fetchdonation();
           this.fetchproducts();
        },
        
        mounted(){
        },
        methods: {
           proceed(){
             
                axios.post('/api/edit_donation/'+this.$route.params.id,this.item).then(response =>  {
                    toastr['success'](response.data.message);
                    this.$router.push('/donation_list');
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
                },
			 fetchproducts()
               {
   			
                 axios.get('/api/product').then(response =>  {
   					
                     this.product = response.data;
   				  //this.page=response.data.data;
   				  
                 });
               },
			fetchdonation()
               {
   			
                 axios.get('/api/donation/'+this.$route.params.id).then(response =>  {
   					
                     this.item = response.data;
   				  //this.page=response.data.data;
   				  
                 });
               },
			
			
		
    }

	}
	
	
</script>



