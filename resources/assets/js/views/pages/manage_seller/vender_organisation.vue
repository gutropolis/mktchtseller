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
                           
                   <form-wizard @on-complete="submit" shape="circle"  title="Add Your Company"
                      subtitle="" color="#19b325">
					    <tab-content>
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
                            <label class="login__element--box--label">Title</label>
                            <input type="text" name="title" v-model="savesellerform.title" required   placeholder="Title" class="login__element--box--input">
                        </div>
                        <div class="form-group">
                            <label class="login__element--box--label">Tell Us About Your Business</label>
                             <textarea  type="text" v-model="savesellerform.description" rows="5" placeholder="Description" class="login__element--box--input"></textarea>
                        </div>
						 <div class="form-group">
                            <label class="login__element--box--label">Years in business</label>
                            <input type="text" placeholder="year in business" v-model="savesellerform.year_in_business" class="login__element--box--input">
                        </div>
						  </tab-content>
						  <tab-content>
						
						  <div class="form-group">
                              <label class="login__element--box--label">Address Of you Business <div class="info-btn">
							  <b-btn v-b-popover.hover="'This address should be the physical mailing address that sellers can send goods/products to.'" title="Info">
								<i class="fa fa-info-circle" style="font-size:20px"></i>
							  </b-btn>
							</div></label>
                              <vue-google-autocomplete id="map" class="login__element--box--input"  placeholder="Start typing" v-on:placechanged="getAddressData">
                              </vue-google-autocomplete>
                           </div>
						   	<div class="form-group">
                            <label class="login__element--box--label">Country</label>
                             <input  type="text"  v-model="address.country" placeholder="Country" class="login__element--box--input">
                        </div>
							<div class="form-group">
                            <label class="login__element--box--label">State</label>
                             <input  type="text"  v-model="address.administrative_area_level_1" placeholder="State" class="login__element--box--input">
                        </div>
						<div class="form-group">
                            <label class="login__element--box--label">city</label>
                             <input  type="text"  v-model="address.locality" placeholder="Fill State" class="login__element--box--input">
                        </div>
						<div class="form-group">
                            <label class="login__element--box--label">Zipcode</label>
                             <input  type="text"  v-model="address.postal_code" placeholder="Fill_Zipcode" class="login__element--box--input">
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
                            <label class="login__element--box--label">Tax_Id</label>
                            <input type="text" placeholder="Tax_Id" v-model="address.tax_id" class="login__element--box--input">
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
			
        </div>
    </section>
	

</div>
</template>
<script>
  import VueGoogleAutocomplete from 'vue-google-autocomplete'
 import AppSidebar from '../users/sidebar.vue'
 import Vue from 'vue'
 import VueFormWizard from 'vue-form-wizard'
 Vue.use(VueFormWizard)
 export default {
 components: {
              AppSidebar,VueGoogleAutocomplete 
        },
        data() {
            return {
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
		getAddressData: function (addressData, placeResultData, id) 
					{
						   this.address = addressData;
					},
            submit(e){
			 let data1 = this.savesellerform;
			  let data2 = this.address;
                axios.post('/api/gs_seller_organisation',{image: this.image, data1,data2}).then(response =>  {
                    toastr['success'](response.data.message);
                    this.$router.push('/seller_list');
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
			axios.get('api/gs_seller_organisation',this.savesellerform).then(response=>{
			
			this.items=response.data;
			
			}).catch(error=>{
			toastr['error'](error.response.data.message);
			});
			}
        }
    }
	
</script>



