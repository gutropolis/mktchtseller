<template>
   <div id="main-wrapper">
      <section class=" my__account">
         <div class="row">
            <app-sidebar></app-sidebar>
            <div class="col-md-9 dashboard">
               <div class="dashboard__content clearfix">
                  <div class="dashboard__content--outer">
                     <form-wizard @on-complete="submit" shape="circle"  title="Add Your Organization"
                        subtitle="" color="#19b325">
                        <tab-content>
                           <div class="form-group">
                              <label class="login__element--box--label">Charity Category</label>
                              <select name="charity_Category"  v-model="savecharityform.charity_Category" class="login__element--box--input">
                                 <option value="select">Select .. </option>
                                 <option  v-for="item in items" v-if="item.parent_id==0"  v-bind:value="item.id">{{ item.title }}</option>
                              </select>
                           </div>
                           <div v-if="savecharityform.charity_Category !='select' "  class="form-group">
                              <label class="login__element--box--label">Charity Type</label>
                              <select name="charity_type"  v-model="savecharityform.charity_type" class="login__element--box--input">
                                 <option value="select" >Select .. </option>
                                 <option  v-for="item in items" v-if="item.parent_id==savecharityform.charity_Category"  v-bind:value="item.id">{{ item.title }}</option>
                              </select>
                           </div>
                           <div class="form-group">
                              <label class="login__element--box--label">Charity Name</label>
                              <input type="text" name="title" v-model="savecharityform.title"  required placeholder="Title" class="login__element--box--input"/>
                           </div>
                           <div class="form-group">
                              <label class="login__element--box--label">Description</label>
                              <textarea  type="text" v-model="savecharityform.description" rows="5" placeholder="Description" class="login__element--box--input"></textarea>
                           </div>
						    <div class="form-group">
                              <label class="login__element--box--label">Years in business</label>
                              <input type="text" placeholder="year in business" v-model="savecharityform.year_in_business" class="login__element--box--input">
                           </div>
                           
                        </tab-content>
                        <tab-content>
                           <div class="form-group">
                              <label class="login__element--box--label">Select Address</label>
                              <vue-google-autocomplete id="map" class="login__element--box--input" v-model="address.addr" placeholder="Start typing" v-on:placechanged="getAddressData">
                              </vue-google-autocomplete>
                           </div>
                           <div class="form-group">
                              <label class="login__element--box--label">Location</label>
                              <div class="message is-success" >
                              </div>
                              <input type="text"   v-model="address.locality" rows="3" placeholder="Fill Locality" class="login__element--box--input">
                           </div>
                           <div class="form-group">
                              <label class="login__element--box--label">Zip Code</label>
                              <input type="text"  v-model="address.postal_code" rows="3" placeholder="Fill The Zipcode" class="login__element--box--input">
                           </div>
                          
                           <div class="form-group">
                              <label class="login__element--box--label">Business Purpose</label>
                              <input type="text" placeholder="Purpose" v-model="address.business_purpose" class="login__element--box--input">
                           </div>
                           <div class="form-group">
                              <label class="login__element--box--label">Years in inception</label>
                              <input type="text" placeholder="Years_in _Inception" v-model="address.years_inception" class="login__element--box--input">
                           </div>
                           <div class="form-group clearfix">
                              <label class="login__element--box--label">Phone Number</label>
                              <input type="text" placeholder="+91" v-model="address.area_code" class="login__element--box--input_areacode">
                              <input type="number" placeholder="9999999999" v-model="address.phone_number" maxlength="10" class="login__element--box--input_phone_number">
                           </div>
                        </tab-content>
                        <tab-content>
                           <div class="form-group">
                              <label class="login__element--box--label">Website</label>
                              <input type="text" placeholder="Website" v-model="address.website" class="login__element--box--input">
                           </div>
                           <div class="form-group">
                              <label class="login__element--box--label">Vision</label>
                              <textarea  type="text" v-model="address.vision_statement" rows="3" placeholder="Statement" class="login__element--box--input"></textarea>
                           </div>
                           <div class="form-group">
                              <label class="login__element--box--label">Mission</label>
                              <textarea  type="text" v-model="address.mission_statement"  rows="3" placeholder="Statement" class="login__element--box--input"></textarea>
                           </div>
                           <div class="form-group">
                              <label class="login__element--box--label">Tags</label>
                              <input type="text" placeholder="Tags" v-model="address.tags" class="login__element--box--input">
                           </div>
                           <div class="form-group">
                              <label class="login__element--box--label">Logo Upload</label>
                              <span id="fileselector">
                              <label class="btn btn-info">
                              <input type="file" v-on:change="onImageChange" class="form-control">
                              </label>
                              </span>
                           </div>
                           <div class="col-md-6" v-if="image">
                              <img :src="image" class="img-responsive" height="70" width="90">
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
   import VueGoogleAutocomplete from 'vue-google-autocomplete'
   import AppNavbar from '../pages/users/navbar.vue' 
    import AppSidebar from '../pages/users/sidebar.vue'
    
   import Vue from 'vue'
    import VueFormWizard from 'vue-form-wizard'
    Vue.use(VueFormWizard)
    
    export default {
   	 components: {
               AppNavbar,  AppSidebar ,VueGoogleAutocomplete
           },
     
           data() {
   		
               return {
   			 address: '',
   			items:[],
   			image: '',
			savecharityform:{
						charity_type:'select',
						charity_Category:'select',
					     title: '',
						 description: '',
						 location: '',
			
							},
					address: {
					area_code:'',
   					year_in_business: '',
					years_inception:'',
					business_purpose: '',
					locality: '',
   				    zipcode:'',
   				    phone_number: '',
   				    website: '',
   				    vision_statement: '',
   				    mission_statement: '',
   				    tags: '',
   				   
                   }
               }
           },
          
           created: function()
           {
               this.fetchItems();
           },
           mounted(){
           },
           methods: {
						getAddressData: function (addressData, placeResultData, id) 
					{
						   this.address = addressData;
					},
					
               submit(e){
   			 let data1 = this.address;
			 let data2= this.savecharityform;
   			 
                   axios.post('/api/gs_charity_organisation', {image: this.image, data1,data2}).then(response =>  {
                       toastr['success'](response.data.message);
                       this.$router.push('/charity_list');
                   }).catch(error => {
                       toastr['error'](error.response.data.message);
                   });
               },
   			  onImageChange(e) {
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
   			fetchItems()
   			{
   			axios.get('api/charity_organisation',this.address).then(response=>{
   			
   			this.items=response.data;
   			
   			}).catch(error=>{
   			toastr['error'](error.response.data.message);
   			});
   			}
   			
   			
   		
       }
   	}
   	
   	
</script>