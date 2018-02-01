<template>
<div id="main-wrapper">
<app-navbar></app-navbar>
	    <section class=" my__account">
        <div class="row">
            <app-sidebar></app-sidebar>
            <div class="col-md-9 dashboard">
                <div class="dashboard__content clearfix">
                
                    <div class="dashboard__content--outer">
                        
                        <div class="dashboard__content--description">
                            <hr>
                            <h3 class="dashboard__content--description--heading">Add Your Organisation</h3>
                           
                   <form-wizard @on-complete="submit" shape="circle"  title="Add Your Organisation"
                      subtitle="" color="#19b325">
					    <tab-content>
					  <div class="form-group">
					   
                            <label class="login__element--box--label">Seller Category</label>
                            <select name="seller_Category"  v-model="savesellerform.seller_Category" class="login__element--box--input">
							<option value="select">Select .. </option>
							
							<option  v-for="item in items" v-if="item.parent_id==0"  v-bind:value="item.id">{{ item.title }}</option>
							
							
							</select>
                        </div>
						<div v-if="savesellerform.seller_Category !='select' "  class="form-group">
					   
                            <label class="login__element--box--label">Seller Type</label>
                            <select name="business_type"  v-model="savesellerform.business_type" class="login__element--box--input">
							<option value="select">Select .. </option>
							
							<option  v-for="item in items" v-if="item.parent_id==savesellerform.seller_Category"  v-bind:value="item.title">{{ item.title }}</option>
							
							
							</select>
                        </div>
                        <div class="form-group">
                            <label class="login__element--box--label">Title</label>
                            <input type="text" name="title" v-model="savesellerform.title"  placeholder="Title" class="login__element--box--input">
                        </div>
                        <div class="form-group">
                            <label class="login__element--box--label">Description</label>
                            <input type="text" placeholder="Description"v-model="savesellerform.description" class="login__element--box--input">
                        </div>
						  <div class="form-group">
                            <label class="login__element--box--label">Location</label>
                            <input type="text" placeholder="Location" v-model="savesellerform.location"  class="login__element--box--input">
                        </div>
						  </tab-content>
						  <tab-content>
						<div class="form-group">
                            <label class="login__element--box--label">Year in business</label>
                            <input type="text" placeholder="year in business" v-model="savesellerform.year_in_business" class="login__element--box--input">
                        </div>
						<div class="form-group">
                            <label class="login__element--box--label">Start up year</label>
                            <input type="date" placeholder="Start up year" v-model="savesellerform.start_up_year"  class="login__element--box--input">
                        </div>
						
						<div class="form-group">
                            <label class="login__element--box--label">Address</label>
                             <textarea  type="text"  v-model="savesellerform.address" rows="3" placeholder="Address" class="login__element--box--input"></textarea>
                        </div>
						<div class="form-group">
                            <label class="login__element--box--label">Phone Number</label>
                            <input type="number" placeholder="Phone Number" v-model="savesellerform.phone_number" class="login__element--box--input">
                        </div>
						  </tab-content>
						    <tab-content>
						<div class="form-group">
                            <label class="login__element--box--label">Keyword</label>
                            <input type="text" placeholder="Keyword" v-model="savesellerform.keyword" class="login__element--box--input">
                        </div>
						<div class="form-group">
                            <label class="login__element--box--label">Vision</label>
                             <textarea  type="text" v-model="savesellerform.vision_statement" rows="3" placeholder="Statement" class="login__element--box--input"></textarea>
                        </div>
						<div class="form-group">
                            <label class="login__element--box--label">Mission</label>
                             <textarea  type="text" v-model="savesellerform.mission_statement"  rows="3" placeholder="Statement" class="login__element--box--input"></textarea>
                        </div>
						<div class="form-group">
                            <label class="login__element--box--label">Tax_Id</label>
                            <input type="text" placeholder="Tags" v-model="savesellerform.tax_id" class="login__element--box--input">
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
				
				items:[],
                savesellerform: {
				business_type: 'select',
				seller_Category:'select',
				
                    title: '',
                    description: '',
                   location: ''
                    
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
            submit(e){
                axios.post('/api/gs_seller_organisation', this.savesellerform).then(response =>  {
                    toastr['success'](response.data.message);
                    this.$router.push('/product');
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
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



