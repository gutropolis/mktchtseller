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
                            <h3 class="dashboard__content--description--heading">Add Your Vender Category</h3>
                           
                   <div class="dashboard__content--outer">
                        
                         <form id="savecategory" @submit.prevent="submit">
                        <div class="form-group">
                            <label class="login__element--box--label">Parent Category</label>
                           <select name="perent_id" v-model="savecategory.parent_id" class="login__element--box--input">
								<option value="0"> Select ...</option>
								<option v-for="item in items" v-if="item.parent_id==0" v-bind:value="item.id">{{item.title}}</option>
								</select>
                        </div>
                       
                      <div class="form-group">
                            <label class="login__element--box--label">Title</label>
                            <input type="text" name="title" v-validate="required|title" v-model="savecategory.title" placeholder="Title"  class="login__element--box--input" required/>
							<span v-show="errors.has('title')">{{ errors.first('title') }}</span>
                        </div>
                       <div class="form-group">
                            <label class="login__element--box--label">Description</label>
                           <textarea placeholder="description" v-model="savecategory.description" class="login__element--box--input" rows="3">
						   </textarea>
                        </div>
                        <div class="form-group text-center">
                            <input type="Submit" placeholder="" value="Save" class="btn btn-bg-orange login__element--box--button">
                        </div>
                    </form>                
					
                       
                    </div>
					
                </div>
            </div>
			</div>
        </div>
		</div>
    </section>
	


</div>
</template>
<script>
import AppNavbar from './navbar.vue' 
 import AppSidebar from './sidebar.vue'
 import Vue from 'vue'
import VeeValidate from 'vee-validate';
 
Vue.use(VeeValidate);

 export default {
 components: {
            AppNavbar,  AppSidebar 
        },
		
	
	        data() {
			
            return {
			items:[],
                savecategory: {
				
					parent_id:0,
				   
                    
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
                axios.post('/api/vender_category', this.savecategory).then(response =>  {
                    toastr['success'](response.data.message);
                    this.$router.push('/vender_organisation');
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
            },
			 fetchItems()
            {
			
              axios.get('/api/vender_category').then(response =>  {
					
                  this.items = response.data;
				  
              });
            }
			
			
			
		
    }

	}
	
	
</script>
