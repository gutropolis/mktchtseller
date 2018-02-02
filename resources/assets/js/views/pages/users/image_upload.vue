<template>
    <div>
    <div id="main-wrapper">

	    <section class=" my__account">
        <div class="row">
            <app-sidebar></app-sidebar>
       
    
                <div class="col-md-9 dashboard">
    
    
    
                    <div class="dashboard__content clearfix">
    
    
    
                        <div class="dashboard__content--head">
						 <h3 class="dashboard__content--head--heading">Change Profile Pic</h3>
    <div class="card">
                    <div class="card-body">
                        <div class="pull-right">
                          
                                <button type="button" class="btn btn-sm btn-danger waves-effect waves-light m-t-10" v-if="defaultAvatar" @click="removeAvatar">Remove Avatar</button>
                           
                        </div>
                        <h4 class="card-title">Upload Avatar</h4>
                        <div class="form-group text-center m-t-20">
                            <span id="fileselector">
                                <label class="btn btn-info">
                                    <input type="file"  @change="previewAvatar" id="avatarUpload" class="upload-button">
                                  
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
	</div>
	
                    </div>
    
    </div>
                </div>
    
	</section>
	</div>
	</div>
	
</template>
<script>
 import AppNavbar from './navbar.vue' 
 import AppSidebar from './sidebar.vue'
 import Vue from 'vue'

    export default {
    components: {
            AppNavbar,  AppSidebar 
        },
 data() {
            return {
				 avatar: ''
			};
			},
  methods: {
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
                        avatar: response.data.profile.avatar
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
			getAuthUser(name){
                return this.$store.getters.getAuthUser(name);
            }
		},
		        computed: {
            defaultAvatar(){
                return this.getAuthUser('avatar') !== 'avatar.png' ? true : false;
            }
        }
} 	
</script>