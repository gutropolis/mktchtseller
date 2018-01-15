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
                            
                           
                     <form class="form-horizontal form-material" id="saveproductform" @submit.prevent="submit">
                    <h3 class="box-title m-b-20">Add Product</h3>
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
import AppNavbar from './navbar.vue' 
 import AppSidebar from './sidebar.vue'
 export default {
  components: {
            AppNavbar,  AppSidebar 
        },
        data() {
            return {
			image: '',
				fileName: '',
                saveproductform: {
                    title: '',
                    description: '',
                  
                    
                }
            }
        },
       
        
        mounted(){
        },
        methods: {
		
            submit(e){
                axios.post('/api/gs_seller_product', this.saveproductform).then(response =>  {
                    toastr['success'](response.data.message);
                    this.$router.push('/');
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
            },
			
			previewAvatar(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createAvatar(files[0]);
            },
            createAvatar(file) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    this.avatar = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            cancelUploadAvatar(){
                this.avatar = '';
            },
            uploadAvatar() {
                let data = new FormData();
                data.append('avatar', $('#avatarUpload')[0].files[0]);
                axios.post('/api/user/update-avatar',data)
                .then(response => {
                    this.$store.dispatch('setAuthUserDetail',{
                        avatar: response.data.sellerproduct.avatar
                    });
                    toastr['success'](response.data.message);
                    this.avatar = '';
                    $("#avatarUpload").val('');
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
            },
            removeAvatar() {
                axios.post('/api/user/remove-avatar')
                .then(response => {
                    this.$store.dispatch('setAuthUserDetail',{
                        avatar: null
                    });
                    toastr['success'](response.data.message);
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
            },
        }
    }
</script>