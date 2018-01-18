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
                            <h3 class="dashboard__content--description--heading">Create Your Message</h3>
                           
                   <div class="dashboard__content--outer">
                        
                         <form id="savemessage" @submit.prevent="submit">
						 <div class="form-group">
                            <label class="login__element--box--label">select user</label>
                           <select name="reciever_id" v-model="savemessage.reciever_id" class="login__element--box--input">
							<option value="select"> Select ...</option>
							<option v-for="item in items" v-bind:value="item.id">{{item.first_name}}</option>
						</select>
                        </div>
                        
                      <div class="form-group">
                            <label class="login__element--box--label">Subject</label>
                            <input type="text" name="subject"  v-model="savemessage.subject"  placeholder="subject"  class="login__element--box--input" />
							
                        </div>
                       <div class="form-group">
                            <label class="login__element--box--label">Message</label>
                           <textarea placeholder="message"  v-model="savemessage.message" class="login__element--box--input" rows="5">
						   </textarea>
                        </div>
                        <div class="form-group text-center">
                            <input type="Submit" placeholder="" value="Send" class="btn btn-bg-orange login__element--box--button">
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
			savemessage :{
			reciever_id:'select',
			subject : '',
			message : '',

			
			},
            }
        },
       
        
        mounted(){
        },
		   created: function()
        {
            this.fetchItems();
        },       
        methods: {
            submit(e){
                axios.post('/api/create_messages', this.savemessage).then(response =>  {
                    toastr['success'](response.data.message);
                    
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
            },
			 
			
			 fetchItems()
            {
   
              axios.get('/api/get_user').then(response =>  {
     
                  this.items = response.data;
      
              });
            }
   
   
  
    }
		
    }

	
	
	
</script>
