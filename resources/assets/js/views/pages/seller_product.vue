<template>
<div>
 <section id="wrapper">
       
            <div class="login-box card">
            <div class="card-body">
                <form class="form-horizontal form-material" id="saveproductform" @submit.prevent="submit">
                    <h3 class="box-title m-b-20">Add Product</h3>
					<div class="form-group ">
                        <div class="col-sm-4">
                            <input type="text" name="title"  placeholder="Title" v-model="saveproductform.title">
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-sm-4">
                            <input type="text" name="description"  placeholder="Description" v-model="saveproductform.description">
                        </div>
                    </div>
					<div class="form-group ">
                        <div class="col-sm-4">
                            <input type="text" name="asin_url"  placeholder="asin_url" v-model="saveproductform.asin_url">
                        </div>
                    </div>
                   
					 
					 <div class="form-group ">
                        <div class="col-sm-4">
                            <input type="text" name="reviews"  placeholder="reviews" v-model="saveproductform.reviews">
                        </div>
                    </div>
					
					    <div class="card">
                    <div class="card-body">
                        <div class="pull-right">
                            <click-confirm yes-class="btn btn-success" no-class="btn btn-danger">
                                <button type="button" class="btn btn-sm btn-danger waves-effect waves-light m-t-10" v-if="defaultAvatar" @click="removeAvatar">Remove Avatar</button>
                            </click-confirm>
                        </div>
                        <h4 class="card-title">Upload Avatar</h4>
                        <div class="form-group text-center m-t-20">
                            <span id="fileselector">
                                <label class="btn btn-info">
                                    <input type="file"  @change="previewAvatar" id="avatarUpload" class="upload-button">
                                    <i class="fa fa-upload margin-correction"></i>Choose Avatar
                                </label>
                            </span>
                        </div>
                        <div class="form-group text-center">
                            <img :src="avatar" class="img-responsive" style="max-width:200px;">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-info waves-effect waves-light m-t-10" v-if="avatar" @click="uploadAvatar">Upload</button>
                            <button type="button" class="btn btn-danger waves-effect waves-light m-t-10" v-if="avatar" @click="cancelUploadAvatar">Cancel Upload</button>
                        </div>
                    </div>
                </div>
					
					  <div class="form-group text-center m-t-20">
                        <div class="col-sm-4">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Submit</button>
                        </div>
                    </div>
					</form>
					</div>
					</div>
					</section>
</div>
</template>
<style scoped>
	img{
		max-height:100px;
	}
</style>
<script>
 export default {
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