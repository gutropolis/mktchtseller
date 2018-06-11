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
                        <router-link to ="/" class="dashboard__content--head--link">
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
                        </router-link>
                     </div>
                     <div class="chat_frame">
                        <div class="messages_outer">
                           <div v-for="item in info">
                              <div class="messages_outer--left_sec">
                                 <router-link to="/users_detail" class="messages_outer--left_sec--back_btn"><i class="fa fa-arrow-left" aria-hidden="true"></i></router-link>
                                 <div class="messages_outer--left_sec--image_outer">
                                    <figure class="messages_outer--left_sec--image_outer--image_box" v-if="item.avatar==null">
                                       <img :src="'/images/user/avatar.png'" class="messages_outer--left_sec--image_outer--image_box--image">
                                    </figure>
                                    <figure class="messages_outer--left_sec--image_outer--image_box" v-if="item.avatar!=null">
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
									 <div  v-if="credit.remaining_credit <= 0 || user.trial_pack < 0 "  class="col-12">
                                       <div class="charity_donation">
                                          <div v-if="getrole ==='seller'" class="charity__request">
                                             <div v-if="getrole=='seller'">
                                                <div class="charity_donation--box">
                                                   <b-btn v-b-modal.modalPrevent v-b-modal. variant="primary" class="charity__request--send btn-bg-orange btn orangebtn">Make An Offer</b-btn>
                                                   <b-modal id="modalPrevent"
                                                      ref="modal"
                                                      title="Your Have No Package To Offer Charity.Need to Purchase Membership Pack."
                                                      @ok=link
                                                      @shown="clearName">
                                                      <form  id="member" @submit.stop.prevent="link">
                                                         Click Ok To Purchase Membership To Continue.                                                 
                                                      </form>
                                                   </b-modal>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div v-if="getrole =='' "class="charity__request">
                                          <router-link :to="{ path: '/login',query: {redurl:'/charity_details/'+this.$route.params.id}}" class="charity__request--send btn-bg-orange btn orangebtn">Make An Offer</router-link>
                                       </div>
                                    </div>
									<div v-else class="col-12">
                                    <div  class="charity_donation">
                                       <div v-if="getrole ==='seller'" class="charity__request">
                                          <div v-if="getrole=='seller'">
                                             <div class="charity_donation--box">
                                                <b-btn v-b-modal.modalPrevent v-b-modal. variant="primary" class="charity__request--send btn-bg-orange btn orangebtn">Make An Offer</b-btn>
                                                <b-modal id="modalPrevent"
                                                   ref="modal"
                                                   title="Make An Offer"
                                                   @ok="handleOk"
                                                   @shown="clearName">
                                                   <form  id="prod" @submit.stop.prevent="handleSubmit">
                                                      <div class="form-group">
                                                         <label class="login__element--box--label">Select Product</label>
                                                         <select name="title" v-model="prod.id" v-on:change="onChange"   class="login__element--box--input">
                                                            <option value="select">Select .. </option>
                                                            <option v-for="item in product"  v-bind:value="item.id">{{item.title}}</option>
                                                         </select>
                                                         <label class="charity__element--block--content--box--label">Units</label>
                                                         <input type="number" name="units"  v-model="prod.units" placeholder="Units"  class="login__element--box--input" />
                                                      </div>
                                                      <label class="login__element--box--label">Select Charity to Offer Product</label>
                                                      <select name="title" v-model="prod.charity_id"    class="login__element--box--input">
                                                         <option value="select">Select .. </option>
                                                         <option v-for="item in charities"  v-bind:value="item.id">{{item.title}}</option>
                                                      </select>
                                                   </form>
                                                </b-modal>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                   </div>
                                 </ul>
                                 <div class="detail_icon">
                                    <button type="button" class="detail_slide-toggle"><i class="fa fa-user" aria-hidden="true"></i></button>
                                 </div>
                                 <div id="mobile_msg_detail" >
                                    <div class="mobile_message_outer clearfix ">
                                       <div class="mobile_message_outer--left_sec detail_box-inner">
                                          <div class="mobile_message_outer--left_sec--image_outer">
                                             <figure class="mobile_message_outer--left_sec--image_outer--image_box" v-if="item.avatar==null">
                                                <img :src="'/images/user/avatar.png'"   class="mobile_message_outer--left_sec--image_outer--image_box--image">
                                             </figure>
                                             <figure class="mobile_message_outer--left_sec--image_outer--image_box" v-if="item.avatar!='null'">
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
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="messages_outer--main">
                              <div class="messages_outer--right_sec">
                                 <div v-if="subject.length>=50">
                                    <h6 class="messages_outer--right_sec--heading"><span v-html="subject.substring(0,60)+'.......'"></span></h6>
                                 </div>
                                 <div v-else>
                                    <h6 class="messages_outer--right_sec--heading"><span v-html="subject"></span></h6>
                                 </div>
                                 <ul class="messages_outer--right_sec--box" v-chat-scroll>
                                    <div v-for="item in items" class="clearfix">
                                       <li v-if="item.sender_id!=user.id" v-for="items in info" class="messages_outer--right_sec--box--sent">
                                          <div class="messages_outer--right_sec--box--sent--avatar"><img v-if="items.avatar==null" class="messages_outer--right_sec--box--sent--image" :src="'/images/user/avatar.png'">
                                             <img v-if="items.avatar!=null" class="messages_outer--right_sec--box--sent--image" :src="'/images/user/'+items.avatar">
                                          </div>
                                          <div class="messages_outer--right_sec--box--chatbox">
                                             <div class="messages_outer--right_sec--box--sent--chat">
                                                <p >{{item.message}} </p>
                                                <span>{{items.created_at | moment("dddd,MMM-Do-YYYY")}}</span>
                                             </div>
                                             <p class="messages_outer--right_sec--box--sent--time">{{item.created_at |moment("h:mm A")}}</p>
                                          </div>
                                       </li>
                                       <li v-else class="messages_outer--right_sec--box--replies">
                                          <div class="messages_outer--right_sec--box--replies--avatar">
                                             <img class="messages_outer--right_sec--box--replies--image" :src="getAvatar">
                                          </div>
                                          <div class="messages_outer--right_sec--box--replies--chatbox">
                                             <div class="messages_outer--right_sec--box--replies--chat">
                                                <p class="">{{item.message}}</p>
                                                <span>{{items.created_at |moment("dddd, MMM-Do-YYYY")}}</span>
                                             </div>
                                             <p class="messages_outer--right_sec--box--sent--time">{{item.created_at |moment("h:mm A")}}</p>
                                          </div>
                                       </li>
                                    </div>
                                 </ul>
                                 <form  @submit.prevent="submit">
                                    <div class="right_user_chat--message_input">
                                       <div class="right_user_chat--message_input--wrap">
                                          <input type="text" placeholder="Write your message..." class="right_user_chat--message_input--wrap--text" v-model="savechat.message" />
                                          <button type="submit" class="submit right_user_chat--message_input--wrap--button"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                       </div>
                                    </div>
                                 </form>
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
   import toogle from '../../../../js/toogle.js'
   import helper from '../../../services/helper'
    
      export default {
      components: {
					AppSidebar 
				},
      data() {
              return {
						subject:{},
						product:{},
						charities:{},
						info:[],
						user:[],
						items:[],
				prod:{
     				  title: 'select',
     				  units: ''
     				},
			  savechat:{
						message:''  
					}    
   			}
          },
      props: ['userId'],
    created: function()
          {
   			this.fetchcredit();
			this.fetchstatus();
   		   this.fetchCharity();
   		   this.fetchMessage();
   		   this.senderinfo();
   		   this.fetchItem();
   		   this.click();
   		   this.fetch_subject();
          },
           mounted(){
         this.fetchItems();
         this.fetchproducts();
      },
   
     methods: {
	 //Ftech Products 
      onChange: function (){
             axios.get('/api/product_name/'+this.prod.id)
              .then(response=>{
     			this.prod=response.data;
     			}).catch(error=>{
     			toastr['error'](error.response.data.message);
     				  
                   });
     	 },
		
        clearName () {
     				this.name = ''
     			},
     click()
      {
			axios.post('/api/inboxstatus/'+this.$route.params.id).then(response =>  {
                        console.log("Id of"+this.$route.params.id);
      
      });
      },
	  //fetch USer Message
     fetchMessage(){
			axios.get('/api/user_id').then(response =>  {
				this.user_id=response.data.id;
      
     
			 Echo.channel('chat'+this.user_id)
					  .listen('MessageSent', (e) => {
			 if((this.user_id == e.user.reciever_id) && (this.$route.params.id == e.user.inbox_id))
			 {
						  this.items.push({
							  message: e.user.message,
							  sender_id: e.user.sender_id,
						  })
			  
			  }
				})
			 //console.log("user_detail"+this.user_id);
			 })
			 
			 },
	 //Ftech Message
	 
	 //Link Purchase Membership
	 link(){
				 this.$router.push('/membership');
			},
			
	handleOk (evt) {
			evt.preventDefault()
			if(this.prod.units > this.user.trial_pack ) {
				this.msg="Your Trial Pack  has remain only " + this.user.trial_pack + " units You Need To Purchase Membership";
			}
			if(this.credit.remaining_credit > 0 || this.user.trial_pack > 0 ) 
			{
				this.handleSubmit()
			}
    },
	 handleSubmit () {
    
       axios.post('/api/seller_make_offer/'+this.$route.params.id,this.prod).then(response => {
       toastr['success'](response.data.message);
		location.reload();
       })
     
      },
	//Event
	//Fetch Charity List
      fetchCharity()
     	{
			axios.get('/api/get_charity').then(response=>{
			this.charities=response.data;
     	})
     	},//Fetch Charity
     
     //Fetch User Products
     fetchproducts()
                 {
     			  axios.get('/api/product').then(response =>  {
     			       this.product = response.data;
     				});
                 },
     //fetchProdcts
     
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
	 //fetch Remaining credit
     fetchstatus(){
			axios.get('/api/get_status').then(response=>
		   {
					this.credit=response.data;
		   });
		   },
	fetchcredit()
   {
		axios.get('/api/get_credit').then(response=>
   {
   this.count=response.data;
  
   })
   },
		   //credit
     //fetch Subject
     fetch_subject()
		{
		   axios.get('/api/fetch_subject/'+this.$route.params.id).then(response => {
			this.subject=response.data;
		})
     },
	 //fetchSubject
      fetchItems()
              {
				axios.get('/api/user_detail/'+this.$route.params.id).then(response =>  {
                    this.items = response.data;
      
                });
              },
    
     //fetch User Detiak
      fetchItem()
             {
				axios.get('/api/user_id').then(response =>  {
                    this.user = response.data;
				this.user_id=response.data.id;
        //console.log("User_id ="+this.user.id);
        
                });
              },
			  //User
      getAuthUser(name) {
   						return this.$store.getters.getAuthUser(name);
   					},
     
      },
      computed: {
      getrole(){
   			return this.getAuthUser('role');
   		},
              getAvatar(){
                  return '/images/user/'+this.getAuthUser('avatar');
              }
     
          }
        
     
    }
      
</script>