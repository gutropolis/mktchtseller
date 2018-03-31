<template>
   <div>
      <div id="main-wrapper">
         <section class=" my__account">
            <div class="row">
               <app-sidebar></app-sidebar>
               <div class="col-md-9 dashboard">
                  <div class="dashboard__content clearfix">
                     <div class="dashboard__content--head">
                        <h3 class="dashboard__content--head--heading">My Profile</h3>
                        <a href="#" class="dashboard__content--head--link">
                           <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                              width="460.298px" height="460.297px" viewBox="0 0 460.298 460.297" style="enable-background:new 0 0 460.298 460.297;"
                              xml:space="preserve">
                              <g>
                                 <path d="M230.149,120.939L65.986,256.274c0,0.191-0.048,0.472-0.144,0.855c-0.094,0.38-0.144,0.656-0.144,0.852v137.041
                                    c0,4.948,1.809,9.236,5.426,12.847c3.616,3.613,7.898,5.431,12.847,5.431h109.63V303.664h73.097v109.64h109.629
                                    c4.948,0,9.236-1.814,12.847-5.435c3.617-3.607,5.432-7.898,5.432-12.847V257.981c0-0.76-0.104-1.334-0.288-1.707L230.149,120.939
                                    z"/>
                                 <path d="M457.122,225.438L394.6,173.476V56.989c0-2.663-0.856-4.853-2.574-6.567c-1.704-1.712-3.894-2.568-6.563-2.568h-54.816
                                    c-2.666,0-4.855,0.856-6.57,2.568c-1.711,1.714-2.566,3.905-2.566,6.567v55.673l-69.662-58.245
                                    c-6.084-4.949-13.318-7.423-21.694-7.423c-8.375,0-15.608,2.474-21.698,7.423L3.172,225.438c-1.903,1.52-2.946,3.566-3.14,6.136
                                    c-0.193,2.568,0.472,4.811,1.997,6.713l17.701,21.128c1.525,1.712,3.521,2.759,5.996,3.142c2.285,0.192,4.57-0.476,6.855-1.998
                                    L230.149,95.817l197.57,164.741c1.526,1.328,3.521,1.991,5.996,1.991h0.858c2.471-0.376,4.463-1.43,5.996-3.138l17.703-21.125
                                    c1.522-1.906,2.189-4.145,1.991-6.716C460.068,229.007,459.021,226.961,457.122,225.438z"/>
                              </g>
                           </svg>
                           Home
                        </a>
                     </div>
                     <div class="dashboard__content--outer">
                        <div class="dashboard__content--box clearfix">
                        </div>
                        <div class="dashboard__content--description">
                           <hr>
                           <h3 class="dashboard__content--description--heading">Edit Profile</h3>
                           <div class="row">
                              <div class="col-lg-6">
                                 <div class="card">
                                    <div class="card-body">
                                       <form class="form-horizontal form-material"  @submit.prevent="updateProfile">
                                          <div class="form-group">
                                             <label class="login__element--box--label">First Name</label>
                                             <input type="text" name="first_name" v-model="profileForm.first_name" class="login__element--box--input">
                                          </div>
                                          <div class="form-group">
                                             <label class="login__element--box--label">Last Name</label>
                                             <input type="text" name="last_name"  v-model="profileForm.last_name" class="login__element--box--input">
                                          </div>
                                          <div class="form-group">
                                             <label class="login__element--box--label">Date Of Birth</label>
                                             <datepicker v-model="profileForm.dob"  class="login__element--box--input_dob"></datepicker>
                                          </div>
                                          <div class="form-group">
                                             <label class="login__element--box--label">Bio</label>
                                             <textarea  type="text" name="bio"  rows="3" v-model="profileForm.bio" class="login__element--box--input"></textarea>
                                          </div>
                                          <div class="form-group">
                                             <label for="">Gender</label>
                                             <div class="radio radio-info">
                                                <input type="radio" value="male" id="gender_male" v-model="profileForm.gender" :checked="profileForm.gender === 'male'">
                                                <label for="gender_male"> Male </label>
                                             </div>
                                             <div class="radio radio-success">
                                                <input type="radio" value="female" id="gender_female" v-model="profileForm.gender" :checked="profileForm.gender === 'female'">
                                                <label for="gender_female"> Female </label>
                                             </div>
                                          </div>
											
											 <div class="form-group">
                                             <label class="login__element--box--label">Phone</label>
                                             <input type="text" name="phone"  rows="3" v-model="profileForm.phone" class="login__element--box--input">
                                          </div>
										  
                                          <div class="form-group">
                                             <label class="login__element--box--label">Address</label>
                                             <textarea  type="text" name="address"  rows="3" v-model="profileForm.address" class="login__element--box--input"></textarea>
                                          </div>
                                          <div class="form-group">
                                             <label class="login__element--box--label">Postal</label>
                                             <input type="text" name="postal" v-model="profileForm.postal"  class="login__element--box--input">
                                          </div>
                                          <button type="submit" class="btn btn-info waves-effect waves-light m-t-10">Update</button>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-6">
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
                                 <div class="card"">
                                    <div class="card-body">
                                       <h4 class="card-title">Change Password</h4>
                                       <form @submit.prevent="changePassword">
                                          <div class="form-group">
                                             <label for="">Current Password</label>
                                             <input type="password" value="" v-model="passwordForm.current_password" class="login__element--box--input">
                                          </div>
                                          <div class="form-group">
                                             <label for="">New Password</label>
                                             <input  class="login__element--box--input" type="password" value="" v-model="passwordForm.new_password">
                                          </div>
                                          <div class="form-group">
                                             <label for="">Confirm Password</label>
                                             <input  class="login__element--box--input" type="password" value="" v-model="passwordForm.new_password_confirmation">
                                          </div>
                                          <button type="submit" class="btn btn-info waves-effect waves-light m-t-10">Change Password</button>
                                       </form>
                                    </div>
                                 </div>
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
   import datepicker from 'vuejs-datepicker'
    import ClickConfirm from 'click-confirm'
   import AppNavbar from './navbar.vue' 
   import AppSidebar from './sidebar.vue'
   import Vue from 'vue'
   export default {
   components: {
              AppNavbar,  AppSidebar ,ClickConfirm,datepicker,
          },
          data() {
              return {
   		passwordForm: new Form({
                      current_password : '',
                      new_password : '',
                      new_password_confirmation : ''
                  }),
                
   		 profileForm: new Form({
   			
                      first_name : '',
                      last_name : '',
                      dob:'',
					  bio:'',
					  phone:'',
					  postal:'',
					  address :'',
                      gender : '',
                     
   			    
   			  }),
   avatar: '',				  
              };
   		},
     created: function()
           {
              this.fetchItems()
           },
        mounted()
   	{},	   
         
        methods: {
     changePassword() {
                  this.passwordForm.post('/api/user/change-password',this.passwordForm).then(response => {
                      toastr['success'](response.message);
                  }).catch(response => {
                      toastr['error'](response.message);
                  });
              },
   	 fetchItems(){
   	 
   	 axios.get('/api/auth/user').then(response => response.data.user).then(response => {
   	 
                // var self=this
   			 console.log(response);
   			 console.log(response.first_name);
   		  
   			 this.profileForm.first_name = response.first_name;
   			 this.profileForm.last_name = response.last_name;
   			 this.profileForm.dob = response.dob;
   			 this.profileForm.postal = response.postal;
			  this.profileForm.phone = response.phone;
   			 this.profileForm.gender = response.gender;
   			 this.profileForm.bio = response.bio;
   		     this.profileForm.address = response.address;
                  	
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
   	
   		updateProfile() {
                
   				 axios.post('/api/user/update-profile',this.profileForm).then(response => {
                      toastr['success']("Your profile updated");
                      this.$store.dispatch('setAuthUserDetail',{
                          first_name: this.profileForm.first_name,
                          last_name: this.profileForm.last_name
                      });
                  })
                      
               .catch(response => {
                      toastr['error'](response.message);
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