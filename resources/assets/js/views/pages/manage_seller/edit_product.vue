<template>
<div id="main-wrapper">
<app-navbar></app-navbar>
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
					<div class="form-group ">
                        <label class="login__element--box--label">Title</label>
                            <input type="text" name="title" class="login__element--box--input"  placeholder="Title" v-model="productForm.title">
                      
                    </div>
                    <div class="form-group ">
                        <label class="login__element--box--label">Description</label>
                            <input type="text" name="description" class="login__element--box--input"   placeholder="Description" v-model="productForm.description">
                       
                    </div>
					<div class="form-group ">
                        <label class="login__element--box--label">Asin_url</label>
                            <input type="text" name="asin_url" class="login__element--box--input"  placeholder="asin_url" v-model="productForm.asin_url">
                       
                    </div>
                   
					 
					 <div class="form-group ">
                       <label class="login__element--box--label">Reviews</label>
                            <input type="text" name="reviews" class="login__element--box--input" placeholder="reviews" v-model="productForm.reviews">
                        
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
import AppNavbar from '../users/navbar.vue' 
 import AppSidebar from '../users/sidebar.vue'
 export default {
 components: {
            AppNavbar,  AppSidebar 
        },
        data() {
            return {
			productForm: {}
                  
                    
                };
            },
			
			created: function()
        {
            this.fetchItems();
			
        },
       mounted() {
           
        },
      
		
        methods: {
		fetchItems(){
                axios.get('/api/task/'+this.$route.params.id).then(response=>{
                    this.productForm = response.data;    
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