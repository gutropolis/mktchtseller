<template>
<div id="main-wrapper">

	    <section class=" my__account">
        <div class="row">
            <app-sidebar></app-sidebar>
            <div class="col-md-9 dashboard">
                <div class="dashboard__content clearfix">
                
                    <div class="dashboard__content--outer">
                        
                        <div class="dashboard__content--description">
                            <hr>
                            
                           
                     <form class="form-horizontal form-material" id="productForm" @submit.prevent="proceed">
                    <h3 class="box-title m-b-20">Edit Product</h3>
					 <div class="form-group">
					   
                            <label class="login__element--box--label">Select Company</label>
                            <select name="company"   v-model="productForm.organisation_id"  required class="login__element--box--input">
							<option value="select">Select .. </option>
							<option value:="" >--{{seller}}</option>
							<option  v-for="item in items" v-bind:value="item.id" v-if="productForm.organisation_id=item.id" >{{ item.title }}</option>
							
								
							
							</select>
                        </div>
						
						
						
					
					
					<div class="form-group ">
                        <label class="login__element--box--label">Title</label>
                            <input type="text" name="title" class="login__element--box--input" required  placeholder="Title" v-model="productForm.title">
                      
                    </div>
                    <div class="form-group ">
                        <label class="login__element--box--label">Description</label>
                            <textarea  type="text" v-html="productForm.bulletPoints" v-model="productForm.description" required  rows="7" placeholder="Description" class="login__element--box--input"></textarea>
                       
                    </div>
					<div class="form-group ">
                        <label class="login__element--box--label">ASIN</label>
                            <input type="text" name="asin_url" class="login__element--box--input" required  placeholder="ASIN" v-model="productForm.asin_url">
                       
                    </div>
                   <div class="form-group ">
                        <label class="login__element--box--label">UNITS</label>
                            <input type="text" name="units" class="login__element--box--input" required placeholder="units" v-model="productForm.units">
                       
                    </div>
					  <div class="form-group ">
                        <label class="login__element--box--label">Tags</label>
                            <input type="text" name="tags" class="login__element--box--input" required  placeholder="tags" v-model="productForm.tags">
                       
                    </div>
					
					 
					
					 <div class="form-group text-center">
                            <input type="Submit" placeholder="" value="Save" class="btn btn-bg-orange login__element--box--button">
                        </div>
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
 export default {
 components: {
              AppSidebar 
        },
        data() {
            return {
			seller:{},
			items:[],
			charity:{},
			productForm: {}
                  
                    
                };
            },
			
			created: function()
        {
			 this.fetchItem();
            this.fetchItems();
			
        },
       mounted() {
           
        },
      
		
        methods: {
		 fetchItem()
					{
					axios.get('api/seller_list').then(response=>{
					
					this.items=response.data;
					
					
					}).catch(error=>{
					toastr['error'](error.response.data.message);
					});
					},
		 
		fetchItems(){
                axios.get('/api/task/'+this.$route.params.id).then(response=>{
                    this.productForm = response.data.data1;
					this.seller = response.data.data2;
                }).catch(error=>{
			toastr['error'](error.response.data.message);
			});
			},
			proceed(){
             
                axios.post('/api/task/'+this.$route.params.id,this.productForm).then(response =>  {
                    toastr['success'](response.data.message);
                    this.$router.push('/product_list');
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
                }
                
            }
			
             
            }
           
		   
    
</script>