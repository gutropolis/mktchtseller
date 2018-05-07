<template>
<div id="main-wrapper">
 
 <section class=" my__account">
        <div class="row">
			<app-sidebar></app-sidebar>
            <div class="col-md-9 dashboard">
                <div class="dashboard__content clearfix">

                    <div class="dashboard__content--outer">
                        
                                             

						 <form @on-complete="updateitems">
                     
					  <div v-if="step === 1" >
					  
						<div  class="form-group">
					   
                            <label class="login__element--box--label">Company SubCategory </label>
                            <select name="business_type" v-model="items.business_type"  class="login__element--box--input">
							<option value:="">--{{business_type}}</option>
							<option  v-for="cat in category" v-if="cat.parent_id > 0" :value="cat.id">{{ cat.title }}</option>					
							</select>
                        </div>
                        <div class="form-group">
                            <label class="login__element--box--label">Title</label>
							 <p class="control has-icon has-icon-right">
                            <input type="text" name="title" v-validate="'required:true'" v-model="items.title" placeholder="Title" class="login__element--box--input"/>
							 <i v-show="errors.has('title')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('title')" class="help is-danger">{{ errors.first('title') }}</span>
								 </p>
                        </div>
                        <div class="form-group">
                            <label class="login__element--box--label">Tell Us About Your Organization</label>
							 
							 <p class="control has-icon has-icon-right">
                           <textarea  type="text" v-model="items.description" name="description" v-validate="'required:true'"  rows="5" placeholder="Description" class="login__element--box--input"></textarea>
						   <i v-show="errors.has('description')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('description')" class="help is-danger">{{ errors.first('description') }}</span>
								 </p>
						   
                        </div>
						<div class="form-group">
                            <label class="login__element--box--label">Years in business</label>
							 <p class="control has-icon has-icon-right">
                            <input type="text" placeholder="year in business" v-model="items.year_in_business" v-validate="'required:true'" name="year_in_business" class="login__element--box--input">
							 <i v-show="errors.has('year_in_business')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('year_in_business')" class="help is-danger">{{ errors.first('year_in_business') }}</span>
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
                                 <input  name="country" v-model="items.country" v-validate="'required'" class="login__element--box--input" type="text" placeholder="country">
                                 <i v-show="errors.has('country')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('country')" class="help is-danger">{{ errors.first('country') }}</span>
                              </p>
                           </div>
                           <div class="column is-12">
                              <label class="login__element--box--label">State</label>
                              <p class="control has-icon has-icon-right">
                                 <input  name="state" v-model="items.state" v-validate="'required'" class="login__element--box--input" type="text" placeholder="state">
                                 <i v-show="errors.has('state')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('state')" class="help is-danger">{{ errors.first('state') }}</span>
                              </p>
                           </div>
                           <div class="column is-12">
                              <label class="login__element--box--label">City</label>
                              <p class="control has-icon has-icon-right">
                                 <input name="city" v-model="items.city" v-validate="'required'" class="login__element--box--input" type="text" placeholder="city">
                                 <i v-show="errors.has('city')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('city')" class="help is-danger">{{ errors.first('city') }}</span>
                              </p>
                           </div>
                           <div class="column is-12">
                              <label class="login__element--box--label">ZipCode</label>
                              <p class="control has-icon has-icon-right">
                                 <input  name="zipcode" v-model="items.postal_code" v-validate="'required'" class="login__element--box--input" type="text" placeholder="zipcode">
                                 <i v-show="errors.has('zipcode')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('zipcode')" class="help is-danger">{{ errors.first('zipcode') }}</span>
                              </p>
                           </div>
                           <div class="column is-12">
                              <label class="login__element--box--label">Phone Nummber</label>
                              <p class="control has-icon has-icon-right clearfix">
                                 <input type="text" placeholder="+91" v-model="items.area_code" v-validate="'required'" class="login__element--box--input_areacode">
                                 <input  name="phone_number" v-model="items.phone_number" v-validate="'required|numeric'" class="login__element--box--input_phone_number" type="text" placeholder="phone_number">
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
                              <label class="login__element--box--label">Website</label>
                              <p class="control has-icon has-icon-right">
                                 <input type="text" name="website" v-model="items.website" v-validate="'required:true'" class="login__element--box--input"  placeholder="website">
                                 <i v-show="errors.has('website')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('website')" class="help is-danger">{{ errors.first('website') }}</span>
                              </p>
                           </div>
                           <div class="column is-12">
                              <label class="login__element--box--label">Vision</label>
                              <p class="control has-icon has-icon-right">
                                 <input type="text" name="vision_statement" v-model="items.vision_statement" v-validate="'required:true'" class="login__element--box--input"  placeholder="vision_statement">
                                 <i v-show="errors.has('vision_statement')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('vision_statement')" class="help is-danger">{{ errors.first('vision_statement') }}</span>
                              </p>
                           </div>
                         
                           <div class="column is-12">
                              <label class="login__element--box--label">Mission</label>
                              <p class="control has-icon has-icon-right">
                                 <input type="text" name="mission_statement" v-model="items.mission_statement" v-validate="'required'" class="login__element--box--input"  placeholder="mission_statement">
                                 <i v-show="errors.has('mission_statement')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('mission_statement')" class="help is-danger">{{ errors.first('mission_statement') }}</span>
                              </p>
                           </div>
						 <div class="column is-12">
                              <label class="login__element--box--label">TaxId</label>
                              <p class="control has-icon has-icon-right">
                                 <input type="text" name="tax_id" v-model="items.tax_id" v-validate="'required'" class="login__element--box--input"  placeholder="tax_id">
                                 <i v-show="errors.has('tax_id')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('tax_id')" class="help is-danger">{{ errors.first('tax_id') }}</span>
                              </p>
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
                                          <button type="button" class="btn btn-danger waves-effect waves-light m-t-10" v-if="avatar" @click="uploadAvatar">Upload</button>
                                          <button type="button" class="btn btn-danger waves-effect waves-light m-t-10" v-if="avatar" @click="cancelUploadAvatar">Cancel Upload</button>
                                       </div>
									    <div class="step_button">
                              <button @click.prevent="prev()" class="btn-prev">Previous</button>
                              <button @click.prevent="updateitems()" class="button" type="button">Finish</button>
                           </div>
					  </div>
						
                    
					</form>
                       
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
			step:1,
			avatar: '',
			items:{},
			business_type:{},
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
                axios.post('/api/update-seller_logo/'+this.$route.params.id,data)
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
			this.business_type=response.data.data3;
			}).catch(error=>{
			toastr['error'](error.response.data.message);
			});
			},
			 updateitems()
            {
			 this.$validator.validateAll().then((result) => {
              axios.post('api/edit_seller/'+this.$route.params.id,this.items).then(response =>  {
                    toastr['success'](response.data.message);
                    this.$router.push('/seller_list');
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
                })
            }
			}
			
			
		
    }
	
	
	
</script>



