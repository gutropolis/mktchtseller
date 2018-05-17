<template>
   <div id="main-wrapper">
      <section class=" my__account">
         <div class="row">
            <app-sidebar></app-sidebar>
            <div class="col-md-9 dashboard">
               <div class="dashboard__content clearfix">
                  <div class="dashboard__content--outer">
					<div>
					<h2>Add Your Organisation</h2>
				  </div>
                     <form @on-complete="submit">
                        <div v-if="step === 1" >
                           <div class="column is-12">
                              <label class="login__element--box--label">Charity Category</label>
                              <p class="control has-icon has-icon-right">
                                 <select name="charity_Category" v-model="savecharityform.charity_Category" v-validate="'required|not_in:Choose'"  type="text" placeholder="charity_Category" class="login__element--box--input">
                                    <option value="select">Select .. </option>
                                    <option  v-for="item in items" v-if="item.parent_id==0"  v-bind:value="item.id">{{ item.title }}</option>
                                 </select>
                                 <i v-show="errors.has('charity_Category')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('charity_Category')" class="help is-danger">{{ errors.first('charity_Category') }}</span>
                              </p>
                           </div>
                           <div class="column is-12">
                              <div v-if="savecharityform.charity_Category !='select' ">
                                 <label class="login__element--box--label">Charity Type</label>
                                 <p class="control has-icon has-icon-right">
                                    <select name="charity_type" v-model="savecharityform.charity_type" v-validate="'required|not_in:Choose' " class="login__element--box--input" type="text" placeholder="charity_type">
                                       <option value="select" >Select .. </option>
                                       <option  v-for="item in items" v-if="item.parent_id==savecharityform.charity_Category"  v-bind:value="item.id">{{ item.title }}</option>
                                    </select>
                                    <i v-show="errors.has('charity_type')" class="fa fa-warning"></i>
                                    <span v-show="errors.has('charity_type')" class="help is-danger">{{ errors.first('charity_type') }}</span>
                                 </p>
                              </div>
                           </div>
                           <div class="column is-12">
                              <label class="login__element--box--label">Charity Name</label>
                              <p class="control has-icon has-icon-right">
                                 <input name="title" v-model="savecharityform.title" v-validate="'required:true'" class="login__element--box--input" type="text" placeholder="title">
                                 <i v-show="errors.has('title')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('title')" class="help is-danger">{{ errors.first('title') }}</span>
                              </p>
                           </div>
                           <div class="column is-12">
                              <label class="login__element--box--label">Tell Us About Your Organization</label>
							    <p class="control has-icon has-icon-right">
                             <textarea  type="text" v-model="savecharityform.description" name="description" v-validate="'required:true'" rows="5" placeholder="Description" class="login__element--box--input"></textarea>
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
                              <label class="login__element--box--label">
                                 Shipping Address For Organization 
                                 <div class="info-btn">
                                    <b-btn v-b-popover.hover="'This address should be the physical mailing address that sellers can send goods/products to.'" title="Info">
                                       <i class="fa fa-info-circle" style="font-size:20px"></i>
                                    </b-btn>
                                 </div>
                              </label>
                              <p class="control has-icon has-icon-right">
                                 <vue-google-autocomplete id="map" class="login__element--box--input"   placeholder="Start typing" v-on:placechanged="getAddressData">
                                 </vue-google-autocomplete>
                                
                              </p>
                           </div>
                           <div class="column is-12">
                              <label class="login__element--box--label">Country</label>
                              <p class="control has-icon has-icon-right">
                                 <input  name="country" v-model="address.country" v-validate="'required:true'" class="login__element--box--input" type="text" placeholder="country">
                                 <i v-show="errors.has('country')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('country')" class="help is-danger">{{ errors.first('country') }}</span>
                              </p>
                           </div>
                       <div class="column is-12">
                              <label class="login__element--box--label">State</label>
                              <p class="control has-icon has-icon-right">
                                 <input type="text"  name="state" v-model="address.administrative_area_level_1"  v-validate="'required:true'" class="login__element--box--input" placeholder="state">
                                 <i v-show="errors.has('state')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('state')" class="help is-danger">{{ errors.first('state') }}</span>
                              </p>
                           </div>
                         <div class="column is-12">
                            <label class="login__element--box--label">City</label>
							<p class="control has-icon has-icon-right">
                             <input  type="text"  v-validate="'required:true'"  name="city" v-model="address.locality" placeholder="city" class="login__element--box--input">
							  <i v-show="errors.has('city')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('city')" class="help is-danger">{{ errors.first('city') }}</span>
								 
								 </p>
                        </div>
                           <div class="column is-12">
                              <label class="login__element--box--label">Zip Code</label>
                              <p class="control has-icon has-icon-right">
                                 <input  name="postal_code" v-model="address.postal_code" v-validate="'required'" class="login__element--box--input" type="text" placeholder="postal_code">
                                 <i v-show="errors.has('postal_code')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('postal_code')" class="help is-danger">{{ errors.first('postal_code') }}</span>
                              </p>
                           </div>
                           <div class="column is-12">
                              <label class="login__element--box--label">Phone Number</label>
                              <p class="control has-icon has-icon-right clearfix">
                                 <vue-tel-input name="number" @onInput="onInput"  class="login__element--box--input_phone_number"></vue-tel-input>
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
                                 <input  name="website" v-model="address.website" v-validate="'required'" class="login__element--box--input" type="text" >
                                 <i v-show="errors.has('website')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('website')" class="help is-danger">{{ errors.first('website') }}</span>
                              </p>
                           </div>
						 <div class="form-group">
                            <label class="login__element--box--label">Vision Statement</label>
							  <p class="control has-icon has-icon-right">
                             <textarea  type="text" v-model="address.vision_statement" name="vision_statement" v-validate="'required:true'" rows="5"  class="login__element--box--input"></textarea>
							  <i v-show="errors.has('vision_statement')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('vision_statement')" class="help is-danger">{{ errors.first('vision_statement') }}</span>
								 </p>
                        </div>
						<div class="form-group">
                            <label class="login__element--box--label">Mission Statement</label>
							  <p class="control has-icon has-icon-right">
                             <textarea  type="text" v-model="address.mission_statement" name="mission_statement" v-validate="'required:true'" rows="5"  class="login__element--box--input"></textarea>
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
                                 <vue-tags-input  name="tags[]" v-model="tag" @tags-changed="newTags => tags = newTags" v-validate="'required:true'" class="login__element--box--input"/>
                              </p>
                           </div>
                           <div class="column is-12">
                              <label class="login__element--box--label">Logo Upload</label>
                              <p class="control has-icon has-icon-right">
                                 <input name="tags" class="login__element--box--input" v-on:change="onImageChange" validate.reject="'image|size:10'" type="file" placeholder="File">
                                 <i v-show="errors.has('file')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('file')" class="help is-danger">{{ errors.first('file') }}</span>
                              </p>
                           </div>
                           <div class="col-md-6" v-if="image">
                              <img :src="image" class="img-responsive" height="70" width="90">
                           </div>
                           <div class="step_button">
                              <button @click.prevent="prev()" class="btn-prev">Previous</button>
                              <button @click.prevent="submit()" class="button" type="button">Finish</button>
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
   import VueGoogleAutocomplete from 'vue-google-autocomplete'
  // import 'vue-tel-input/dist/vue-tel-input.css'
   
import VueTelInput from 'vue-tel-input'
     import AppSidebar from '../pages/users/sidebar.vue'
     import VueTagsInput from '@johmun/vue-tags-input'
    import Vue from 'vue'
   Vue.use(VueTelInput)
    
     export default {
   components: {
                 AppSidebar ,VueGoogleAutocomplete,VueTagsInput
            },
   
   data() {
     return {
	 phone_number:'',
	 area_code:'',
			  step:1,
			   tag: '',
			   tags: [],
			   items:[],
			   address:'',
			   charity_address:'',
				image: '',
      savecharityform:{
						charity_type:'select',
						charity_Category:'select',
						title: '',
						description: '',
						number:'',
					},
   		address: {
					area_code:'',
    				country: '',
					state:'',
					city: '',
					tags: '',
					zipcode:'',
					phone_number: '',
					website: '',   				    
					mission_statement: '',
    				vision_statement: '',
    			}
		}
   },
    created: function()
						{
							this.fetchItems();
						},
   methods: {
    onInput({ number, country }) {
			this.phone_number=number;
			this.area_code=country;
			
      // console.log(number, country);
	   },
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
    submit(e){
	
    this.$validator.validateAll().then((result) => {
          
         
   let data1 = this.address;
   	 let data2= this.savecharityform;
   	 let data3=this.tags;
	 let data4=this.phone_number;
	 let data5=this.area_code;
	 let data6=this.charity_address;
    			 
                    axios.post('/api/gs_charity_organisation', {image: this.image, data1,data2,data3,data4,data5,data6}).then(response =>  {
                        toastr['success'](response.data.message);
                        this.$router.push('/charity_list');
                    })
        
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
   getAddressData: function (addressData, placeResultData, id) 
   			{
   				   this.address = addressData;
				   this.charity_address=placeResultData.formatted_address;
				   
   			},
   
   fetchItems()
    			{
    			axios.get('/api/charity_organisation',this.address).then(response=>{
    			
    			this.items=response.data;
    			
    			}).catch(error=>{
    			toastr['error'](error.response.data.message);
    			});
    			}
   }
   };
    	
</script>