<template>
   <div>
      <div id="main-wrapper">
         <section class=" my__account">
            <div class="row">
               <app-sidebar></app-sidebar>
               <div class="col-md-9 dashboard">
                  <div class="dashboard__content clearfix">
                     <div class="dashboard__content--head">
                        <h3 class="dashboard__content--head--heading">Purchase A MemberShip</h3>
                        
                     </div>
                     <div class="chat_frame">
                        <div class="users_messages user_active">      
                          
                           <div class="users_messages--users_area user_active--area">
                              <div>
                                <div  class="row activity_content">
								
									<div class="col-md-6" v-for="pack in packs">
											<h6>{{pack.package_name}}</h6>
									<div class="activity_content--box">
											<article>
												<p>Credit Pack Of {{pack.credit_score}} For ${{pack.amount}}</p>
													
											</article>
											
										</div>
											<button class="btn btn-success"  v-on:click="submit(pack.id)" style="margin-bottom:10px;">Purchase Now</button>
									</div>
									
								<!--	<div class="col-md-6">
									<h6>First Pack </h6>
										<div class="activity_content--box">
											<article>
												<p>Credit Pack 3 For $129</p>
												
											</article>
										</div>
										<button class="btn btn-success">Purchase Now</button>
									</div>
									<div class="col-md-6">
									<h6>Second Pack </h6>
										<div class="activity_content--box">
											<article>
												<p>Credit Pack 10 For $399</p>
												
											</article>
										</div>
										<button class="btn btn-success" style="margin-bottom:10px;">Purchase Now</button>
									</div>
									<div class="col-md-6">
									<h6>Third Pack </h6>
										<div class="activity_content--box">
											<article>
												<p>Credit Pack 20 For $699</p>
												
											</article>
										</div>
										<button class="btn btn-success" style="margin-bottom:10px;">Purchase Now</button>
									</div>-->
									
								
								 </div>
								 
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
			
         </section>
      </div>
   </div>
</template>
<script>

   import AppSidebar from '../users/sidebar.vue'
   import Vue from 'vue'
    Vue.use(require('vue-moment'));
      export default {
      components: {
               AppSidebar 
          },
      data() {
              return {
			 
   			 packs:[],
               
              }
   
          },
   	created: function()
             {
			
     			this.fetchItem();
     			 	
             },
   	
          mounted(){
          },
       
       methods: {
			submit(id)
			{
				axios.post('/api/select_pack').then(response=>{
					toastr['success']("Your Pack is Selected");
					
				
				
				});
			
			},
	
		fetchItem()
                 {
     			
                  axios.get('/api/packs').then(response=>{
     			
     			this.packs=response.data;
				
     			console.log(this.activity);
     			}).catch(error=>{
     			toastr['error'](error.response.data.message);
     				  
                   });
                 },
   		    getAuthUserFullName() {
               return this.$store.getters.getAuthUserFullName;
           },
   
           getAuthUser(name)
		   {
               return this.$store.getters.getAuthUser(name);
           }
       },
        computed: {
           getAvatar(){
               return '/images/user/'+this.getAuthUser('avatar');
           }
   
       }

              }
        
          
      
</script>