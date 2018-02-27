<template>
<div id="main-wrapper">
 
 <section class=" my__account">
        <div class="row">
			<app-sidebar></app-sidebar>
            <div class="col-md-9 dashboard">
                <div class="dashboard__content clearfix">

                    <div class="dashboard__content--outer">
                        
                                             

						<form-wizard @on-complete="updateitems" shape="circle"  title="Add Your Organisation"
                      subtitle="" color="#19b325">
                     
					  <tab-content>
					  
						<div  class="form-group">
					   
                            <label class="login__element--box--label">Seller Type</label>
                            <select name="business_type" v-model="items.business_type"  class="login__element--box--input">
							<option value:="items.business_type">{{items.business_type}}</option>
							<option  v-for="cat in category" v-if="cat.parent_id > 0" :value="cat.title">{{ cat.title }}</option>					
			 				</select>
                        </div>
                        <div class="form-group">
                            <label class="login__element--box--label">Title</label>
                            <input type="text" name="title" v-model="items.title" placeholder="Title" class="login__element--box--input"/>
                        </div>
                        <div class="form-group">
                            <label class="login__element--box--label">Description</label>
                            <input type="text" placeholder="Description" v-model="items.description"  class="login__element--box--input">
                        </div>
						  <div class="form-group">
                            <label class="login__element--box--label">Location</label>
                            <input type="text" placeholder="Location" v-model="items.location" class="login__element--box--input">
                        </div>
						</tab-content>
						 <tab-content>
						<div class="form-group">
                            <label class="login__element--box--label">Year in business</label>
                            <input type="text" placeholder="year in business" v-model="items.year_in_business" class="login__element--box--input">
                        </div>
						<div class="form-group">
                            <label class="login__element--box--label">Start up year</label>
                            <input type="date" placeholder="Start up year" v-model="items.start_up_year"  class="login__element--box--input">
                        </div>
						
						<div class="form-group">
                            <label class="login__element--box--label">Address</label>
                             <textarea  type="text" rows="3" v-model="items.address" placeholder="Address" class="login__element--box--input"></textarea>
                        </div>
						<div class="form-group">
                            <label class="login__element--box--label">Phone Number</label>
                            <input type="number" placeholder="Phone Number" v-model="items.phone_number" class="login__element--box--input">
                        </div>
						</tab-content>
						 <tab-content>
						<div class="form-group">
                            <label class="login__element--box--label">Keywords</label>
                            <input type="text" placeholder="Keywords" v-model="items.keywords" class="login__element--box--input">
                        </div>
						<div class="form-group">
                            <label class="login__element--box--label">Vision</label>
                             <textarea  type="text"  rows="3" v-model="items.vision_statement" placeholder="Statement" class="login__element--box--input"></textarea>
                        </div>
						<div class="form-group">
                            <label class="login__element--box--label">Mission</label>
                             <textarea  type="text" rows="3" v-model="items.mission_statement" placeholder="Statement" class="login__element--box--input"></textarea>
                        </div>
						<div class="form-group">
                            <label class="login__element--box--label">Tax_Id</label>
                            <input type="text" placeholder="Tax_id" v-model="items.tax_id" class="login__element--box--input">
                        </div>
						
                                       <h4 class="card-title">Upload Organisation Image</h4>
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
						
						
						
                    </tab-content>
					</form-wizard>
                       
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
import Vue from 'vue'
 import VueFormWizard from 'vue-form-wizard'
 Vue.use(VueFormWizard)
 
 export default {
	components: {
            AppNavbar,  AppSidebar 
        },
  
        data() {
            return {
			avatar: '',
			items:{},
			category:[],
                    
                }
            },
        
       
        created: function()
        {
            this.fetchItems();
			
        },
        mounted(){
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
                axios.post('/api/update-seller/'+this.$route.params.id,data)
                .then(response => {
                  
                 
                    toastr['success'](response.data.message);
                    this.avatar = '';
                    $("#avatarUpload").val('');
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
            },
           
			fetchItems()
			{
			axios.get('api/edit_seller/'+this.$route.params.id).then(response=>{
			
			this.items=response.data.data1;
			this.category=response.data.data2;
			}).catch(error=>{
			toastr['error'](error.response.data.message);
			});
			},
			 updateitems()
            {
              axios.post('api/edit_seller/'+this.$route.params.id,this.items).then(response =>  {
                    toastr['success'](response.data.message);
                    this.$router.push('/seller_list');
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
                }
            }
			
			
		
    }
	
	
	
</script>



