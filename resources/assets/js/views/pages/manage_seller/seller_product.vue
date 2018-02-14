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
                            <h3 class="box-title m-b-20">Add Product</h3>
                       	
					
					    
						
                     <form class="form-horizontal form-material" id="productform" @submit.prevent="submit1">
                    
					
				
					<div class="form-group ">
                        <label class="login__element--box--label">Keywords</label>
                            <input type="text" name="keywords" class="login__element--box--input"  placeholder="Keywords" v-model="productform.keywords">
                      
                    </div>
					
		
					
					 <div class="form-group text-center">
                            <input type="Submit" placeholder="" value="Search" class="btn btn-bg-orange login__element--box--button">
                        </div>
					</form>
			
				  <form class="form-horizontal form-material" id="items" @submit.prevent="submit">
				<div class="form-group ">
                        <label class="login__element--box--label">Title</label>
                            <input type="text" name="title" class="login__element--box--input"  placeholder="Title" v-model="items.name">
                      
                    </div>
					<input type="hidden" name="organisation_id" v-model="items.organisation_id"   class="login__element--box--input" />
                    <div class="form-group ">
                        <label class="login__element--box--label">ASIN</label>
                            <input type="text" name="asin" class="login__element--box--input"   placeholder="ASIN" v-model="items.ASIN">
                       
                    </div>
					<div class="form-group ">
                        <label class="login__element--box--label">Description</label>
                            <textarea  type="text"  v-model="items.description" rows="3" placeholder="Description" class="login__element--box--input"></textarea>
                       
                    </div>
					 <div class="form-group ">
                       <label class="login__element--box--label">Reviews</label>
                            <input type="text" name="reviews" class="login__element--box--input" placeholder="reviews" v-model="items.reviews">
                        
                    </div>
					 <div class="form-group ">
                       <label class="login__element--box--label">Image</label>
                            <input type="text" name="image" class="login__element--box--input" placeholder="image" v-model="items.image">
                        
                    </div>
					<div class="form-group ">
                        <label class="login__element--box--label">Units</label>
                            <input type="text" name="units" class="login__element--box--input"  placeholder="units" v-model="items.units">
                       
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
					items:[],
						productform:{
						 keywords: '',
						},
				
               
        }
    },
        
        mounted(){
        },
        methods: {
		
			
            submit1(e){
                axios.post('/api/product/search',this.productform).then(response =>  {
                   this.items=response.data;
				 
                    this.$router.push('/product');
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
            },
			 submit(e){
                axios.post('/api/gs_seller_product',this.items).then(response =>  {
                    toastr['success'](response.data.message);
                    this.$router.push('/product_list');
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
            },
			   
        }
    }
</script>