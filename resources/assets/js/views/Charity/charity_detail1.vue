

<template>
<div id="main-wrapper">
 <app-navbar></app-navbar>
 <section class=" my__account">
        <div class="row">
			<app-sidebar></app-sidebar>
			
  <div class="dashboard__content--outer">
                        
                         <form id="create_message" @submit.prevent="submit">
                      
                       
                      <div class="form-group">
                            <label class="login__element--box--label">Title</label>
                            <input type="text" name="msgtitle" v-model="create_message.msgtitle"  placeholder="Title"  class="login__element--box--input" />
							
                        </div>
						
						 <input type="hidden" name="user_id" v-model="create_message.user_id"   class="login__element--box--input" />
						 <input type="hidden" name="id" v-model="create_message.id"   class="login__element--box--input" />
						  <input type="hidden" name="post_type" v-model="create_message.post_type"   class="login__element--box--input" />
						   <input type="hidden" name="updated_by" v-model="create_message.updated_by"   class="login__element--box--input" />
						 
                       <div class="form-group">
                            <label class="login__element--box--label">Message</label>
                           <textarea placeholder="Type your message here" v-model="create_message.message"  class="login__element--box--input" rows="5">
						   </textarea>
                        </div>
                        <div class="form-group text-center">
                            <input type="Submit" placeholder="" value="Send Message" class="btn btn-bg-orange login__element--box--button">
                        </div>
                    </form>                
					
                       
                    </div>
					{{create_message|json}}
					
					
</div>
</section>
</div>
</template>
<script>
import AppNavbar from './navbar.vue' 
 import AppSidebar from './sidebar.vue'
 
 export default {
	components: {
            AppNavbar,  AppSidebar 
        },
  
        data() {
           return{
		   create_message:{},
		   create_message:{
		  
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
                axios.post('/api/create_message', this.create_message).then(response =>  {
                    toastr['success'](response.data.message);
                    
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
            },
			
			 fetchItems()
            {
			
             axios.get('api/charity_details/'+this.$route.params.id).then(response=>{
			
			this.create_message=response.data;
			
			
			}).catch(error=>{
			toastr['error'](error.response.data.message);
				  
              });
            }
			
			
		
    }
	}
	
	
	
</script>



