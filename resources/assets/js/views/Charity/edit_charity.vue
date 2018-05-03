<template>
   <div id="main-wrapper">
      <section class=" my__account">
         <div class="row">
            <app-sidebar></app-sidebar>
            <div class="col-md-9 dashboard">
               <div class="dashboard__content clearfix">
                  <div class="dashboard__content--outer">
					<div>
					<h2>Edit Your Organisation</h2>
				  </div>
                     <form @on-complete="updateaddress">
                        <div v-if="step === 1" >
                         
						
						
                           <div class="column is-12">
                             
                                 <label class="login__element--box--label">Charity Type</label>
                                 <p class="control has-icon has-icon-right">
                                    <select name="charity_type" v-model="address.charity_type" v-validate="'required|not_in:Choose' "class="login__element--box--input" type="text" placeholder="charity_type">
                                       <option value="select" >Select .. </option>
                                       <op<option  v-for="cat in category" v-if="cat.parent_id > 0" :value="cat.id">{{ cat.title }}</option>	
                                    </select>
                                    <i v-show="errors.has('charity_type')" class="fa fa-warning"></i>
                                    <span v-show="errors.has('charity_type')" class="help is-danger">{{ errors.first('charity_type') }}</span>
                                 </p>
                             
                           </div>
                           <div class="column is-12">
                              <label class="login__element--box--label">Charity Name</label>
                              <p class="control has-icon has-icon-right">
                                 <input name="title" v-model="address.title" v-validate="'required:true'" class="login__element--box--input" type="text" placeholder="title">
                                 <i v-show="errors.has('title')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('title')" class="help is-danger">{{ errors.first('title') }}</span>
                              </p>
                           </div>
                           <div class="column is-12">
                              <label class="login__element--box--label">Tell Us About Your Organization</label>
                              <p class="control has-icon has-icon-right">
                                 <input col="5" name="description" v-model="address.description" v-validate="'required:true'" class="login__element--box--input" type="text" placeholder="description">
                                 <i v-show="errors.has('description')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('description')" class="help is-danger">{{ errors.first('description') }}</span>
                              </p>
                           </div>
                           <div class="step_button">
                              <button @click.prevent="validateBeforeSubmit()" class="button is-primary">Next</button>
                           </div>
                        </div>
                        <div v-if="step === 2">
                          
                           <div class="column is-12">
                              <label class="login__element--box--label">Country</label>
                              <p class="control has-icon has-icon-right">
                                 <input  name="country" v-model="address.country" v-validate="'required'" class="login__element--box--input" type="text" placeholder="country">
                                 <i v-show="errors.has('country')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('country')" class="help is-danger">{{ errors.first('country') }}</span>
                              </p>
                           </div>
                           <div class="column is-12">
                              <label class="login__element--box--label">State</label>
                              <p class="control has-icon has-icon-right">
                                 <input  name="state" v-model="address.state" v-validate="'required'" class="login__element--box--input" type="text" placeholder="state">
                                 <i v-show="errors.has('state')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('state')" class="help is-danger">{{ errors.first('state') }}</span>
                              </p>
                           </div>
                           <div class="column is-12">
                              <label class="login__element--box--label">City</label>
                              <p class="control has-icon has-icon-right">
                                 <input name="city" v-model="address.city" v-validate="'required'" class="login__element--box--input" type="text" placeholder="city">
                                 <i v-show="errors.has('city')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('city')" class="help is-danger">{{ errors.first('city') }}</span>
                              </p>
                           </div>
                           <div class="column is-12">
                              <label class="login__element--box--label">ZipCode</label>
                              <p class="control has-icon has-icon-right">
                                 <input  name="postal_code" v-model="address.postal_code" v-validate="'required'" class="login__element--box--input" type="text" placeholder="postal_code">
                                 <i v-show="errors.has('postal_code')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('postal_code')" class="help is-danger">{{ errors.first('postal_code') }}</span>
                              </p>
                           </div>
                           <div class="column is-12">
                              <label class="login__element--box--label">Phone Nummber</label>
                              <p class="control has-icon has-icon-right clearfix">
                                 <input type="text" placeholder="+91" v-model="address.area_code" v-validate="'required'" class="login__element--box--input_areacode">
                                 <input  name="phone_number" v-model="address.phone_number" v-validate="'required|numeric'" class="login__element--box--input_phone_number" type="text" placeholder="phone_number">
                                 <i v-show="errors.has('phone_number')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('phone_number')" class="help is-danger">{{ errors.first('phone_number') }}</span>
                              </p>
                           </div>
                           <div class="step_button">
                              <button @click.prevent="prev()" class="btn-prev">Previous</button>
                              <button @click.prevent="validateBeforeSubmit()" class="button-next">Next</button>
                           </div>
                        </div>
                        <div v-if="step === 3">
                           <div class="column is-12">
                              <label class="login__element--box--label">Vision</label>
                              <p class="control has-icon has-icon-right">
                                 <input name="vision_statement" v-model="address.vision_statement" v-validate="'required'" class="login__element--box--input" type="text" placeholder="vision_statement">
                                 <i v-show="errors.has('vision_statement')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('vision_statement')" class="help is-danger">{{ errors.first('vision_statement') }}</span>
                              </p>
                           </div>
                           <div class="column is-12">
                              <label class="login__element--box--label">Website</label>
                              <p class="control has-icon has-icon-right">
                                 <input name="website" v-model="address.website" v-validate="'required'" class="login__element--box--input" type="text" placeholder="website">
                                 <i v-show="errors.has('website')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('website')" class="help is-danger">{{ errors.first('website') }}</span>
                              </p>
                           </div>
                           <div class="column is-12">
                              <label class="login__element--box--label">Mission</label>
                              <p class="control has-icon has-icon-right">
                                 <input name="mission_statement" v-model="address.mission_statement" v-validate="'required'" class="login__element--box--input" type="text" placeholder="mission_statement">
                                 <i v-show="errors.has('mission_statement')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('mission_statement')" class="help is-danger">{{ errors.first('mission_statement') }}</span>
                              </p>
                           </div>
                           <div class="column is-12">
                              <label class="login__element--box--label">Tags
                              <div class="info-btn">
                                 <b-btn v-b-popover.hover="'Please try to use tags that a general audience will understand'" title="Info">
                                    <i class="fa fa-info-circle" style="font-size:20px"></i>
                                 </b-btn>
                              </div></label>
                              <p class="control has-icon has-icon-right">
                                <input name="tags" v-model="address.tags" v-validate="'required'" class="login__element--box--input" type="text" placeholder="tags">
                              </p>
                           </div>
                           <div class="column is-12">
                              <label class="login__element--box--label">Logo Upload</label>
                              <p class="control has-icon has-icon-right">
                                 <input name="tags" class="login__element--box--input" @change="previewAvatar" id="avatarUpload" type="file" placeholder="File">
                                 <i v-show="errors.has('file')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('file')" class="help is-danger">{{ errors.first('file') }}</span>
                              </p>
                           </div>
                           <div class="form-group text-center">
                                          <img :src="avatar" class="img-responsive" style="max-width:200px;">
                                       </div>
						   <div class="text-center">
                                          <button type="button" class="btn btn-danger waves-effect waves-light m-t-10"  v-if="avatar"  @click="uploadAvatar">Upload</button>
                                          <button type="button" class="btn btn-danger waves-effect waves-light m-t-10" v-if="avatar" @click="cancelUploadAvatar">Cancel Upload</button>
                                       </div>
						   
                           <div class="step_button">
                              <button @click.prevent="prev()" class="btn-prev">Previous</button>
                              <button @click.prevent="updateaddress()" class="button" type="button">Finish</button>
                           </div>
                        </div>
                        <!-- <div class="column is-12">
                           <p class="control">
                               <button class="button is-primary">Next</button>
                           </p>
                           </div> -->
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </div>
</template>
<script>

 import AppSidebar from '../pages/users/sidebar.vue'
 import VueTagsInput from '@johmun/vue-tags-input'
   
 import Vue from 'vue'
 import VueFormWizard from 'vue-form-wizard'
 Vue.use(VueFormWizard)
 
 export default {
	components: {
              AppSidebar ,VueTagsInput
           },
        
  
        data() {
            return {
			 step:1,
			tags:[],
			address:'',
			avatar: '',
			address:{},
			category:[],
			charity_type:{},
                    
                }
            },
        
       
        created: function()
        {
            this.fetchaddress();
			
        },
        mounted(){
        },
        methods: {
						prev() {
							this.step--;
						},
				 next() {
				   this.step++;
				 },
			 validateBeforeSubmit() {
			   this.$validator.validateAll().then((result) => {
				 if (result) {
				  this.next();
		   
		   }
   
   	
   
   
        
       });
     },
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
			this.charity_type=response.data.data3;
			}).catch(error=>{
			toastr['error'](error.response.data.message);
			});
			},
			 updateaddress()
            {
				 this.$validator.validateAll().then((result) => {
              axios.post('api/edit_charity/'+this.$route.params.id,this.address).then(response =>  {
                    toastr['success'](response.data.message);
                    this.$router.push('/charity_list');
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
                })
            }
			
			
			
		
    }
	}
	
	
	
</script>
