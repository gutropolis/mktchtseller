<template>
   <div>
      <div id="main-wrapper">
         <section class=" my__account">
            <div class="row">
               <app-sidebar></app-sidebar>
               <div class="col-md-9 dashboard">
                  <div class="dashboard__content clearfix">
                     <div class="dashboard__content--head">
                        <h3 class="dashboard__content--head--heading">Recieved Message</h3>
                        <a href="#" class="dashboard__content--head--link">
                           <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                              width="460.298px" height="460.297px" viewBox="0 0 460.298 460.297" style="enable-background:new 0 0 460.298 460.297;"
                              xml:space="preserve">
                              <g>
                                 <path d="M230.149,120.939L65.986,256.274c0,0.191-0.048,0.472-0.144,0.855c-0.094,0.38-0.144,0.656-0.144,0.852v137.041
                                    c0,4.948,1.809,9.236,5.426,12.847c3.616,3.613,7.898,5.431,12.847,5.431h109.63V303.664h73.097v109.64h109.629
                                    c4.948,0,9.236-1.814,12.847-5.435c3.617-3.607,5.432-7.898,5.432-12.847V257.981c0-0.76-0.104-1.334-0.288-1.707L230.149,120.939
                                    z"/>
                                 <path d="M457.122,225.438L394.6,173.476V56.989c0-2.663-0.856-4.853-2.574-6.567c-1.704-1.712-3.894-2.568-6.563-2.568h-54.816
                                    c-2.666,0-4.855,0.856-6.57,2.568c-1.711,1.714-2.566,3.905-2.566,6.567v55.673l-69.662-58.245
                                    c-6.084-4.949-13.318-7.423-21.694-7.423c-8.375,0-15.608,2.474-21.698,7.423L3.172,225.438c-1.903,1.52-2.946,3.566-3.14,6.136
                                    c-0.193,2.568,0.472,4.811,1.997,6.713l17.701,21.128c1.525,1.712,3.521,2.759,5.996,3.142c2.285,0.192,4.57-0.476,6.855-1.998
                                    L230.149,95.817l197.57,164.741c1.526,1.328,3.521,1.991,5.996,1.991h0.858c2.471-0.376,4.463-1.43,5.996-3.138l17.703-21.125
                                    c1.522-1.906,2.189-4.145,1.991-6.716C460.068,229.007,459.021,226.961,457.122,225.438z"/>
                              </g>
                           </svg>
                           Home
                        </a>
                     </div>
                     <div class="chat_frame">
                        <div class="users_messages">      
                          
                           <div class="users_messages--users_area">
                              <div >
                                
								 <table  class="table table-hover">
									<thead class="thead-light">
									<tr>
										<th>Profile</th>
										<th>First Name</th>
										<th>Last Name</th>
										<th>Subject</th>
										<th>Date  & Time</th>
									</tr>
									</thead>
									
									<tr v-for="create_messages in create_message">
									<td>
									<router-link :to="{name: 'users_message', params: { id: create_messages.id }}" ><figure class="users_messages--users_area--box--list--link--image_outer--image_box" >
											<div v-if="create_messages.avatar==null">
                                                <img :src="'/images/user/avatar.png'"  class="users_messages--users_area--box--list--link--image_outer--image_box--image"></div>
												<div v-else>
												 <img :src="'/images/user/'+create_messages.avatar"  class="users_messages--users_area--box--list--link--image_outer--image_box--image"></div>
                                            </figure> </router-link>
											
											 </td>
									<td> <p class="users_messages--users_area--box--list--link--user_name" > <router-link :to="{name: 'users_message', params: { id: create_messages.id }}" >  {{create_messages.first_name}}</router-link></p></td>
									<td> <p  class="users_messages--users_area--box--list--link--user_name"> <router-link :to="{name: 'users_message', params: { id: create_messages.id }}" >{{create_messages.last_name}}</router-link></p></td>
									<td>  <p class="users_messages--users_area--box--list--link--user_title"><router-link :to="{name: 'users_message', params: { id: create_messages.id }}" >{{create_messages.subject}}</router-link></p></td>
									<td> <p class="users_messages--users_area--box--list--link--date"><router-link :to="{name: 'users_message', params: { id: create_messages.id }}" >{{ create_messages.created_at |  moment("MMMM Do YYYY, h:mm a") }}</router-link></p></td>
									
									</tr>
									<tr>
								 <td v-if="create_message.length === 0" colspan="5">
									<h4  style="text-align:center;" >No results</h4>
										</td>
										</tr>
								 </table>
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
   			 create_message:[],
                   //unread:[],
              }
   
          },
   	created: function()
             {
				//this.fetchunread();
     			this.fetchItem();
     			 	
             },
   	
          mounted(){
          },
       
       methods: {
	
		fetchItem()
                 {
     			
                  axios.get('/api/get_inbox').then(response=>{
     			
     			this.create_message=response.data;
     			
     			
     			}).catch(error=>{
     			toastr['error'](error.response.data.message);
     				  
                   });
                 },
   		   
              },
        
          }
      
</script>