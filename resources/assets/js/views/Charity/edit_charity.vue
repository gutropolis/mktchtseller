<template>
<div id="main-wrapper">

 <section class=" my__account">
        <div class="row">
			<app-sidebar></app-sidebar>
            <div class="col-md-9 dashboard">
                <div class="dashboard__content clearfix">

                    <div class="dashboard__content--outer">
                        
						<form-wizard @on-complete="updateaddress" shape="circle"  title="Add Your Organisation"
                      subtitle="" color="#19b325">
                     
					  <tab-content>
					  
						<div  class="form-group">
					   
                            <label class="login__element--box--label">Charity Type</label>
                            <select name="charity_type" v-model="address.charity_type"  class="login__element--box--input">
							<option value="select">Select .. </option>
							<option value:="address.charity_type">{{address.charity_type}}</option>
							<option  v-for="cat in category" v-if="cat.parent_id > 0" :value="cat.title">{{ cat.title }}</option>					
							</select>
                        </div>
						
						
						
						
						
                        <div class="form-group">
                            <label class="login__element--box--label">Title</label>
                            <input type="text" name="title" v-model="address.title" placeholder="Title" class="login__element--box--input"/>
                        </div>
                        <div class="form-group">
                            <label class="login__element--box--label">Description</label>
                            <input type="text" placeholder="Description" v-model="address.description"  class="login__element--box--input">
                        </div>
						<div class="form-group">
                            <label class="login__element--box--label">Year in business</label>
                            <input type="text" placeholder="year in business" v-model="address.year_in_business" class="login__element--box--input">
                        </div>
						 
						</tab-content>
						 <tab-content>
						
						
						<div class="form-group">
                            <label class="login__element--box--label">Business Purpose</label>
                            <input type="text" placeholder="Purpose" v-model="address.business_purpose" class="login__element--box--input">
						</div>
                     	<div class="form-group">
                            <label class="login__element--box--label">Years in inception</label>
                            <input type="text" placeholder="Years_in _Inception" v-model="address.years_inception" class="login__element--box--input">
                        </div>
						
						
						<div class="form-group">
                            <label class="login__element--box--label">Location</label>
                             <input type="text"  v-model="address.location" rows="3" placeholder="Fill The State" class="login__element--box--input">
                        </div>
						<div class="form-group">
                            <label class="login__element--box--label">Zip Code</label>
                             <input type="text"  v-model="address.postal_code" rows="3" placeholder=" Fill zipcode" class="login__element--box--input">
                        </div>
						<div class="form-group clearfix">
                            <label class="login__element--box--label">Phone Number</label>
					<input type="text" placeholder="+91" v-model="address.area_code" class="login__element--box--input_areacode">
                             <input type="number" placeholder="9999999999" v-model="address.phone_number"  class="login__element--box--input_phone_number">
                        </div>
						</tab-content>
						 <tab-content>
						<div class="form-group">
                            <label class="login__element--box--label">Website</label>
                            <input type="text" placeholder="W" v-model="address.website" class="login__element--box--input">
                        </div>
						<div class="form-group">
                            <label class="login__element--box--label">Vision</label>
                             <textarea  type="text"  rows="3" v-model="address.vision_statement" placeholder="Statement" class="login__element--box--input"></textarea>
                        </div>
						<div class="form-group">
                            <label class="login__element--box--label">Mission</label>
                             <textarea  type="text" rows="3" v-model="address.mission_statement" placeholder="Statement" class="login__element--box--input"></textarea>
                        </div>
						<div class="form-group">
                            <label class="login__element--box--label">Tags</label>
                            <input type="text" placeholder="Tags" v-model="address.tags" class="login__element--box--input">
                        </div>
						<h4 class="card-title">Upload Logo</h4>
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
                                          <button type="button" class="btn btn-danger waves-effect waves-light m-t-10"  v-if="avatar"  @click="uploadAvatar">Upload</button>
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

 import AppSidebar from '../pages/users/sidebar.vue'
import Vue from 'vue'
 import VueFormWizard from 'vue-form-wizard'
 Vue.use(VueFormWizard)
 
 export default {
	components: {
              AppSidebar 
        },
  
        data() {
            return {
			address:'',
			avatar: '',
			address:{},
			category:[],
                    
                }
            },
        
       
        created: function()
        {
            this.fetchaddress();
			
        },
        mounted(){
        },
        methods: {
		getAddressData: function (addressData, placeResultData, id) {
            this.address = addressData;
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
                axios.post('/api/update-charity_logo/'+this.$route.params.id,data)
                .then(response => {
                  
                 
                    toastr['success'](response.data.message);
                    this.avatar = '';
                    $("#avatarUpload").val('');
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
            },
           
			fetchaddress()
			{
			axios.get('api/edit_charity/'+this.$route.params.id).then(response=>{
			
			this.address=response.data.data1;
			this.category=response.data.data2;
			}).catch(error=>{
			toastr['error'](error.response.data.message);
			});
			},
			 updateaddress()
            {
              axios.post('api/edit_charity/'+this.$route.params.id,this.address).then(response =>  {
                    toastr['success'](response.data.message);
                    this.$router.push('/charity_list');
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
                }
            }
			
			
		
    }
	
	
	
</script>



