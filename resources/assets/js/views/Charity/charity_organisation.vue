<template>
<div id="main-wrapper">

	    <section class=" my__account">
        <div class="row">
            <app-sidebar></app-sidebar>
            <div class="col-md-9 dashboard">
                <div class="dashboard__content clearfix">                
				
                    <div class="dashboard__content--outer">
                        
                                             

						<form-wizard @on-complete="submit" shape="circle"  title="Add Your Organisation"
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
							<option value="selected" >Select .. </option>
							
							<option  v-for="item in items" v-if="item.parent_id==savecharityform.charity_Category"  v-bind:value="item.title">{{ item.title }}</option>
							
							
							</select>
                        </div>
                        <div class="form-group">
                            <label class="login__element--box--label">Title</label>
                            <input type="text" name="title" v-model="savecharityform.title"  placeholder="Title" class="login__element--box--input"/>
                        </div>
                        <div class="form-group">
                            <label class="login__element--box--label">Description</label>
                           <textarea  type="text" v-model="savecharityform.description" rows="3" placeholder="Description" class="login__element--box--input"></textarea>
                        </div>
						  <div class="form-group">
                            <label class="login__element--box--label">Location</label>
                            <input type="text" placeholder="Location" v-model="savecharityform.location"  class="login__element--box--input">
                        </div>
						</tab-content>
						 <tab-content>
						<div class="form-group">
                            <label class="login__element--box--label">Years in business</label>
                            <input type="text" placeholder="year in business" v-model="savecharityform.year_in_business" class="login__element--box--input">
                        </div>
						
						<div class="form-group">
                            <label class="login__element--box--label">Business Purpose</label>
                            <input type="text" placeholder="Purpose" v-model="savecharityform.business_purpose" class="login__element--box--input">
                        </div>
						<div class="form-group">
                            <label class="login__element--box--label">Address</label>
                             <textarea  type="text"  v-model="savecharityform.address" rows="3" placeholder="Address" class="login__element--box--input"></textarea>
                        </div>
						<div class="form-group">
                            <label class="login__element--box--label">Phone Number</label>
                            <input type="number" placeholder="Phone Number" v-model="savecharityform.phone_number" class="login__element--box--input">
                        </div>
						</tab-content>
						 <tab-content>
						<div class="form-group">
                            <label class="login__element--box--label">Keyword</label>
                            <input type="text" placeholder="Keyword" v-model="savecharityform.keyword" class="login__element--box--input">
                        </div>
						<div class="form-group">
                            <label class="login__element--box--label">Vision</label>
                             <textarea  type="text" v-model="savecharityform.vision_statement" rows="3" placeholder="Statement" class="login__element--box--input"></textarea>
                        </div>
						<div class="form-group">
                            <label class="login__element--box--label">Mission</label>
                             <textarea  type="text" v-model="savecharityform.mission_statement"  rows="3" placeholder="Statement" class="login__element--box--input"></textarea>
                        </div>
						<div class="form-group">
                            <label class="login__element--box--label">Tags</label>
                            <input type="text" placeholder="Tags" v-model="savecharityform.tags" class="login__element--box--input">
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
import AppNavbar from '../pages/users/navbar.vue' 
 import AppSidebar from '../pages/users/sidebar.vue'
 
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
                savecharityform: {
					charity_type:'selected',
					charity_Category:'select',
                    title: '',
                    description: '',
                   location: '',
				   
                    
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
                axios.post('/api/gs_charity_organisation', this.savecharityform).then(response =>  {
                    toastr['success'](response.data.message);
                    this.$router.push('/charity_list');
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
            },
			fetchItems()
			{
			axios.get('api/charity_organisation',this.savecharityform).then(response=>{
			
			this.items=response.data;
			//this.$router.push('/charity_organisation');
			}).catch(error=>{
			toastr['error'](error.response.data.message);
			});
			}
			
			
		
    }
	}
	
	
</script>



