<template>
<div>
 <div id="main-wrapper">

      <section class=" my__account">
        <div class="row">
            <app-sidebar></app-sidebar>
  
            <div class="col-md-9 dashboard">
                <div class="dashboard__content clearfix">
                    <div class="dashboard__content--head">
                        <h3 class="dashboard__content--head--heading">Messages</h3>
                        <a href="#" class="dashboard__content--head--link"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
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
                       </svg>Home</a>
                    </div>
                  
          <div class="chat_frame">
            
            <div class="messages_outer">
              <div v-for="item in info">
              <div class="messages_outer--left_sec">
                <router-link to="/users_detail" class="messages_outer--left_sec--back_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i></router-link>
                <div class="messages_outer--left_sec--image_outer">
                  <figure class="messages_outer--left_sec--image_outer--image_box">
                    <img :src="'/images/user/'+ item.avatar" class="messages_outer--left_sec--image_outer--image_box--image">
					
                  </figure>
                </div>
                <div class="messages_outer--left_sec--user_name">{{item.first_name}} {{item.last_name}}</div>
                <ul class="messages_outer--left_sec--detail_sec">
                  
                    <li class="messages_outer--left_sec--detail_sec--detail clearfix">
                      <span class="messages_outer--left_sec--detail_sec--detail--title pull-left">User Name:</span>
                      <span class="messages_outer--left_sec--detail_sec--detail--data pull-right">{{item.first_name}} {{item.last_name}}</span>
                    </li>
                    <li class="messages_outer--left_sec--detail_sec--detail clearfix">
                      <span class="messages_outer--left_sec--detail_sec--detail--title pull-left">Email:</span>
                      <span class="messages_outer--left_sec--detail_sec--detail--data pull-right">{{item.email}}</span>
                    </li>
                    <li class="messages_outer--left_sec--detail_sec--detail clearfix">
                      <span class="messages_outer--left_sec--detail_sec--detail--title pull-left">Phone:</span>
                      <span class="messages_outer--left_sec--detail_sec--detail--data pull-right">{{item.phone}}</span>
                    </li>
                    <li class="messages_outer--left_sec--detail_sec--detail clearfix">
                      <span class="messages_outer--left_sec--detail_sec--detail--title pull-left">location:</span>
                      <span class="messages_outer--left_sec--detail_sec--detail--data pull-right">{{item.address}}</span>
                    </li>

                    <li class="messages_outer--left_sec--detail_sec--description">
                    <span class="messages_outer--left_sec--detail_sec--description--title">Description:</span>
                    <span class="messages_outer--left_sec--detail_sec--description--data">{{item.bio}}</span>
                  </li>
                    
                </ul>
                <div class="detail_icon">
                  <button type="button" class="detail_slide-toggle"><i class="fa fa-user" aria-hidden="true"></i></button>
                </div>
				
                <div id="mobile_msg_detail" >

                    

                  <div class="mobile_message_outer clearfix ">

                  <div class="mobile_message_outer--left_sec detail_box-inner">
                <div class="mobile_message_outer--left_sec--image_outer">
                  <figure class="mobile_message_outer--left_sec--image_outer--image_box">
                      <img :src="'/images/user/'+ item.avatar"   class="mobile_message_outer--left_sec--image_outer--image_box--image">
                  </figure>
                </div>
                <div class="mobile_message_outer--left_sec--user_name">{{item.first_name}} {{item.last_name}}</div>

                <ul class="mobile_message_outer--left_sec--detail_sec">
                 
                    <li class="mobile_message_outer--left_sec--detail_sec--detail clearfix">
                      <span class="mobile_message_outer--left_sec--detail_sec--detail--title pull-left">User Name:</span>
                      <span class="mobile_message_outer--left_sec--detail_sec--detail--data pull-right">{{item.first_name}} {{item.last_name}}</span>
                    </li>
                    <li class="mobile_message_outer--left_sec--detail_sec--detail clearfix">
                      <span class="mobile_message_outer--left_sec--detail_sec--detail--title pull-left">Email:</span>
                      <span class="mobile_message_outer--left_sec--detail_sec--detail--data pull-right">{{item.email}}</span>
                    </li>
                    <li class="mobile_message_outer--left_sec--detail_sec--detail clearfix">
                      <span class="mobile_message_outer--left_sec--detail_sec--detail--title pull-left">Phone:</span>
                      <span class="mobile_message_outer--left_sec--detail_sec--detail--data pull-right">{{item.phone}}</span>
                    </li>
                    <li class="mobile_message_outer--left_sec--detail_sec--detail clearfix">
                      <span class="mobile_message_outer--left_sec--detail_sec--detail--title pull-left">location:</span>
                      <span class="mobile_message_outer--left_sec--detail_sec--detail--data pull-right">{{item.address}}</span>
                    </li>

                     <li class="mobile_message_outer--left_sec--detail_sec--description">
                    <span class="mobile_message_outer--left_sec--detail_sec--description--title">Description:</span>
                    <span class="mobile_message_outer--left_sec--detail_sec--description--data">{{item.bio}}</span>
                  </li>
                    
                </ul>               
                 </div>
				</div>
                </div>

               </div>

              </div>
			
              <div class="messages_outer--right_sec">
             
                 <ul class="messages_outer--right_sec--box">
                    <div v-for="item in items">
					   
						<li v-if="item.sender_id!=user.id" class="messages_outer--right_sec--box--sent">
							<img class="messages_outer--right_sec--box--sent--image" src="../../../../images/profile-dashboard.jpg">
							<p class="messages_outer--right_sec--box--sent--chat">{{item.message}}</p>
						</li>
						
						 <li v-else class="messages_outer--right_sec--box--replies">
						   <img class="messages_outer--right_sec--box--replies--image" :src="getAvatar">
							<p class="messages_outer--right_sec--box--replies--chat">{{item.message}}</p>
						</li>
					</div> 
                  </ul>
				
					 <form  @submit.prevent="submit">
                    <div class="right_user_chat--message_input">
                      <div class="right_user_chat--message_input--wrap">
                      <input type="text" placeholder="Write your message..." class="right_user_chat--message_input--wrap--text" v-model="savechat.message" />
                     
                      <input type="submit" class="submit right_user_chat--message_input--wrap--button">
                      </div>
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
</div>
</template>
  
<script>
import AppNavbar from '../users/navbar.vue' 
 import AppSidebar from '../users/sidebar.vue'
 import Vue from 'vue'
 import toogle from '../../../../js/toogle.js'
  import helper from '../../../services/helper'
 
    export default {
    components: {
            AppNavbar,  AppSidebar 
        },
    data() {
            return {
			info:[],
			user:[],
		    items:[],
			 savechat:{  message:''  }			 
            }
        },
		created: function()
        {
			this.senderinfo();
			this.fetchItem();
            this.fetchItems();
        },
        mounted(){
        },
     

	  methods: {
             submit(e){
				axios.post('/api/message/'+this.$route.params.id, this.savechat).then(response =>   { if(response.status===200) {
   				 this.savechat.message = '';
        
        }
   	   });
				 this.fetchItems();
				
            },
			
			senderinfo()
			{
				axios.get('/api/senderinfo/'+this.$route.params.id).then(response =>  {
				 this.info = response.data;
			})
			},
			
			 fetchItems()
            {
				axios.get('/api/user_detail/'+this.$route.params.id).then(response =>  {
                  this.items = response.data;
				  
              });
            },
		
			
			 fetchItem()
            {
				axios.get('/api/user_id').then(response =>  {
                  this.user = response.data;
				  
              });
            },
			 getAuthUser(name) {
    
                return this.$store.getters.getAuthUser(name);
    
            },
			
			 },
			 computed: {
			
            getAvatar(){
                return '/images/user/'+this.getAuthUser('avatar');
            }
			
        }
      
   
		}
    
</script>

