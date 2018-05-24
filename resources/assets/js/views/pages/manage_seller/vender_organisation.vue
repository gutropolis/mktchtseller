<template>
<div id="main-wrapper">

	    <section class=" my__account">
        <div class="row">
            <app-sidebar></app-sidebar>
            <div class="col-md-9 dashboard">
                <div class="dashboard__content clearfix">
                
                    <div class="dashboard__content--outer">
                        
                        <div class="dashboard__content--description">
                            <hr>
                            <h3 class="dashboard__content--description--heading">Add Your Company</h3>
                           
                  <form @on-complete="submit">
					   <div v-if="step === 1" >
					  <div class="form-group">
					   
                            <label class="login__element--box--label">Company Category </label>
                            <select name="seller_Category"  v-model="savesellerform.seller_Category" class="login__element--box--input">
							<option value="select">Select .. </option>
							
							<option  v-for="item in items" v-if="item.parent_id==0"  v-bind:value="item.id">{{ item.title }}</option>
							
							
							</select>
                        </div>
						<div v-if="savesellerform.seller_Category !='select' "  class="form-group">
					   
                            <label class="login__element--box--label">Company SubCategory</label>
                            <select name="business_type"  v-model="savesellerform.business_type" class="login__element--box--input">
							<option value="select">Select .. </option>
							
							<option  v-for="item in items" v-if="item.parent_id==savesellerform.seller_Category"  v-bind:value="item.id">{{ item.title }}</option>
							
							
							</select>
                        </div>
						
                        <div class="form-group">
                            <label class="login__element--box--label">Company Name</label>
                            <input type="text" name="title" v-model="savesellerform.title"  v-validate="'required:true'"    placeholder="Title" class="login__element--box--input">
							 <i v-show="errors.has('title')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('title')" class="help is-danger">{{ errors.first('title') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="login__element--box--label">Tell Us About Your Business</label>
                             <textarea  type="text" v-model="savesellerform.description"  name="description" v-validate="'required:true'" rows="5" placeholder="Description" class="login__element--box--input"></textarea>
							  <i v-show="errors.has('description')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('description')" class="help is-danger">{{ errors.first('description') }}</span>
                        </div>
						 <div class="form-group">
                            <label class="login__element--box--label">Years in business</label>
                            <input type="text" name="year_in_business" placeholder="year in business" v-validate="'required:true'" v-model="savesellerform.year_in_business" class="login__element--box--input">
							<i v-show="errors.has('year_in_business')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('year_in_business')" class="help is-danger">{{ errors.first('year_in_business') }}</span>
                        </div>
						 <div class="step_button">
                              <button @click.prevent="validateBeforeSubmit()" class="button is-primary">Next</button>
                           </div>
						  </div>
						  <div v-if="step === 2">
						
						  <div class="form-group">
                              <label class="login__element--box--label">Address Of Your Business</label>
                              <vue-google-autocomplete id="map" class="login__element--box--input"  placeholder="Start typing" v-on:placechanged="getAddressData">
                              </vue-google-autocomplete>
                           </div>
						   	<div class="column is-12">
                            <label class="login__element--box--label">Country</label>
							 <p class="control has-icon has-icon-right">
                             <input  type="text" name="country"  v-validate="'required:true'" v-model="address.country" placeholder="Country" class="login__element--box--input">
							 <i v-show="errors.has('country')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('country')" class="help is-danger">{{ errors.first('country') }}</span>
								 </p>
                        </div>
							  <div class="column is-12">
                              <label class="login__element--box--label">State</label>
                              <p class="control has-icon has-icon-right">
                                 <input type="text"   name="state" v-model="address.administrative_area_level_1"  v-validate="'required:true'" class="login__element--box--input" placeholder="state">
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
                              <label class="login__element--box--label">ZipCode</label>
                              <p class="control has-icon has-icon-right">
                                 <input  name="zipcode" v-model="address.postal_code" v-validate="'required'" class="login__element--box--input" type="text" placeholder="postal_code">
                                 <i v-show="errors.has('zipcode')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('zipcode')" class="help is-danger">{{ errors.first('zipcode') }}</span>
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
                             <textarea  type="text" v-model="address.vision_statement" v-validate="'required:true'" rows="5" name="vision_statement" class="login__element--box--input"></textarea>
							  <i v-show="errors.has('vision_statement')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('vision_statement')" class="help is-danger">{{ errors.first('vision_statement') }}</span>
								 </p>
                        </div>
						<div class="form-group">
                            <label class="login__element--box--label">Mission Statement</label>
							  <p class="control has-icon has-icon-right">
                             <textarea  type="text" v-model="address.mission_statement" name="mission_statement" v-validate="'required:true'" rows="5" class="login__element--box--input"></textarea>
							  <i v-show="errors.has('mission_statement')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('mission_statement')" class="help is-danger">{{ errors.first('mission_statement') }}</span>
								 </p>
                        </div>
						<div class="column is-12">
                              <label class="login__element--box--label">Tax Id</label>
                              <p class="control has-icon has-icon-right">
                                 <input  name="tax_id" v-model="address.tax_id" v-validate="'required'" class="login__element--box--input" type="text" placeholder="Put here tax_id">
                                 <i v-show="errors.has('tax_id')" class="fa fa-warning"></i>
                                 <span v-show="errors.has('tax_id')" class="help is-danger">{{ errors.first('tax_id') }}</span>
                              </p>
                           </div>
						 <div class="form-group">
						  <label class="login__element--box--label">Upload Logo</label>
                                          <span id="fileselector">
                                          <label class="btn btn-info">
                                          <input type="file" v-on:change="onImageChange"  class="form-control">
                                          </label>
										  
                                          </span>
                                       </div>
								 <div class="col-md-6" v-if="image">
                              <img :src="image" class="img-responsive" height="70" width="90">
                           </div>	    
						 <div class="step_button">
                              <button @click.prevent="prev()" class="btn-prev">Previous</button>
                              <button @click.prevent="submit()" class="button" type="button">Finish</button>
                           </div>
						
                    </div>
					</form>
                        </div>
                    </div>
                </div>
            </div>
			
        </div>
    </section>
	

</div>
</template>
<script>
  import VueGoogleAutocomplete from 'vue-google-autocomplete'
 import AppSidebar from '../users/sidebar.vue'
import VueTelInput from 'vue-tel-input'

 import Vue from 'vue'
  Vue.use(VueTelInput)
 export default {
 components: {
              AppSidebar,VueGoogleAutocomplete 
        },
        data() {
            return {
			 step:1,
			 address: '',
				image: '',
				items:[],
                savesellerform: {
					business_type: 'select',
					seller_Category:'select',
					title: '',
					description: '',
					location: '',
					year_in_business: '',
					state: '',
					zipcode: '',
					area_code:'',
					phone_number: '',
					website: '',
					vision_statement: '',
					mission_statement: '',
                    tax_id: '',
					
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
			
		getAddressData: function (addressData, placeResultData, id) 
					{
						   this.address = addressData;
						    this.seller_address=placeResultData.formatted_address;
					},
					
            submit(e){
			 this.$validator.validateAll().then((result) => {
			
			 let data1 = this.savesellerform;
			  let data2 =this.address;
			   let data3=this.phone_number;
			    let data4=this.area_code;
				let data5=this.seller_address;
                axios.post('/api/gs_seller_organisation',{image: this.image, data1,data2,data3,data4,data5}).then(response =>  {
                    toastr['success'](response.data.message);
                    this.$router.push('/seller_list');
                });
            })
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
			axios.get('/api/gs_seller_organisation',this.savesellerform).then(response=>{
			
			this.items=response.data;
			
			}).catch(error=>{
			toastr['error'](error.response.data.message);
			});
			}
        }
    }
	
</script>



