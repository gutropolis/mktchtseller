<template>
    <div>
    <div id="main-wrapper">
<app-navbar></app-navbar>
	    <section class=" my__account">
        <div class="row">
            <app-sidebar></app-sidebar>
       
    
                <div class="col-md-9 dashboard">
    
    
    
                    <div class="dashboard__content clearfix">
    
    
    
                        <div class="dashboard__content--head">
						 <h3 class="dashboard__content--head--heading">Change Profile Pic</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-2">
                <img :src="avatar" class="img-responsive">
            </div>
            <div class="col-md-8">
                <input type="file" v-on:change="onFileChange" class="form-control">
            </div>
            <div class="col-md-2">
                <button class="btn btn-success btn-block" @click="upload">Upload</button>
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
 onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createAvatar(files[0]);
            },
            createAvatar(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.avatar = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            upload(){
                axios.post('/api/upload',{avatar: this.avatar}).then(response => {
					 toastr['success'](response.data.message);
                });
				},
		}
} 	
</script>