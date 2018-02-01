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
                            <h3 class="box-title m-b-20">Add Product</h3>
                       	<div class="form-group ">
                        <label class="login__element--box--label">Choose Image</label>
                           <input type="file" name="image" v-on:change="onFileChange"   class="form-control">
                        <div class="col-md-2">
						<img :src="image" class="img-responsive">
						</div>
                    </div>
					<div class="col-md-2">
					<button class="btn btn-success btn-block" v-if="image" @click="upload">Upload</button>
					</div>
					    
                     <form class="form-horizontal form-material" id="saveproductform" @submit.prevent="submit"  enctype="multipart/form-data">
                    
					
				
					<div class="form-group ">
                        <label class="login__element--box--label">Title</label>
                            <input type="text" name="title" class="login__element--box--input"  placeholder="Title" v-model="saveproductform.title">
                      
                    </div>
                    <div class="form-group ">
                        <label class="login__element--box--label">Description</label>
                            <input type="text" name="description" class="login__element--box--input"   placeholder="Description" v-model="saveproductform.description">
                       
                    </div>
					<div class="form-group ">
                        <label class="login__element--box--label">Asin_url</label>
                            <input type="text" name="asin_url" class="login__element--box--input"  placeholder="asin_url" v-model="saveproductform.asin_url">
                       
                    </div>
					
                   
					 
					 <div class="form-group ">
                       <label class="login__element--box--label">Reviews</label>
                            <input type="text" name="reviews" class="login__element--box--input" placeholder="reviews" v-model="saveproductform.reviews">
                        
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
			image: '',
				
                saveproductform: {
                    title: '',
                    description: '',
					image:'',
                  
                    
                }
            }
        },
       
        
        mounted(){
        },
        methods: {
		onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
		upload(){
                axios.post('/api/product_upload',{image: this.image}).then(response => {
					 toastr['success'](response.data.message);
                });
				},
            submit(e){
                axios.post('/api/gs_seller_product',this.saveproductform).then(response =>  {
                    toastr['success'](response.data.message);
                    this.$router.push('/product_list');
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
            },
			
			
            
           
            
        }
    }
</script>