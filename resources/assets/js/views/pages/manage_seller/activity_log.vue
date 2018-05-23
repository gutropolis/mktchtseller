<template>
   <div>
      <div id="main-wrapper">
         <section class=" my__account">
            <div class="row">
               <app-sidebar></app-sidebar>
               <div class="col-md-9 dashboard">
                  <div class="dashboard__content clearfix">
                     <div class="dashboard__content--head">
                        <h3 class="dashboard__content--head--heading">All Activity Feed</h3>
                        
                     </div>
                     <div class="chat_frame">
                        <div class="users_messages user_active">      
                          
                           <div class="users_messages--users_area user_active--area">
                              <div >
                                 <!-- <ul class="users_messages--users_area--box">
                                    <li class="users_messages--users_area--box--list">
                                      
                                          <div class="users_messages--users_area--box--list--link--image_outer">
											
											 <div >
											 <figure class="users_messages--users_area--box--list--link--image_outer--image_box">
                                                 <img :src="'/images/charity/'+ actvities.images"  class="users_messages--users_area--box--list--link--image_outer--image_box--image">
                                             </figure>
											 </div>
                                          </div>
										   
                                          <p class="users_messages--users_area--box--list--link--user_title"> {{getAuthUserFullName()}}</p>
										   <p class="users_messages--users_area--box--list--link--date">{{ actvities.created_at |  moment("MMMM Do YYYY, h:mm a") }}</p>
                                          <p class="users_messages--users_area--box--list--link--user_title">{{actvities.subject}}</p>
										   <p  class="users_messages--users_area--box--list--link--user_title">{{actvities.title}}</p>
                                        
                                          
                                       
                                    </li>
									
                                 </ul> -->
								  <table  class="table table-hover">
									<thead class="thead-light">
									<tr>
										<th>Profile</th>
										<th>Name</th>
										<th>Activity</th>
										<th>Subject</th>
										<th>Date  & Time</th>
									</tr>
									</thead>
									<tr v-for="actvities in activity">
										<td>
										<figure class="users_messages--users_area--box--list--link--image_outer--image_box">
                                                 <img :src="'/images/charity/'+ actvities.images"  class="users_messages--users_area--box--list--link--image_outer--image_box--image">
                                             </figure>
										</td>
										<td>
										<p class="users_messages--users_area--box--list--link--user_title"> {{getAuthUserFullName()}}</p>
										</td>
										
										<td><p class="users_messages--users_area--box--list--link--user_title">{{actvities.subject}}</p></td>
										<td>   <p  class="users_messages--users_area--box--list--link--user_title">{{actvities.title}}</p></td>
										<td> <p class="users_messages--users_area--box--list--link--date">{{ actvities.created_at |  moment("MMMM Do YYYY, h:mm a") }}</p></td>
									</tr>
									</table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
			{{activity.title}}
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
   			 
               activity:[],
				
              }
   
          },
   	created: function()
             {
			
     			this.fetchItem();
     			 	
             },
   	
          mounted(){
          },
       
       methods: {
	
		fetchItem()
                 {
     			
                  axios.get('/api/seller_activity').then(response=>{
     			
     			this.activity=response.data;
				
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