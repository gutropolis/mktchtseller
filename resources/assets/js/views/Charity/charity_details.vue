<template>
   <div>
      <section class="page__head">
         <div class="container">
            <div class="page__head--content">
               <h2 class="page__head--content--heading">Charity Details</h2>
            </div>
         </div>
      </section>
      <section class="equal charity__element">
         <div class="container">
            <div class="row">
               <div class="col-md-8">
                  <div v-if="request !=null">
                     <div class="charity_request_content" >
                        <h3>Charity Requests</h3>
                        <div class="charity_request_content--inner">
                           <h4>{{request.title}}</h4>
                           <p>{{request.description}}</p>
                           <p class="recent__post--tab--content--detail_box--block--pera_box"><strong>{{request.created_at |  moment("MMMM Do YYYY, h:mm A")}}</strong></p>
                        </div>
                     </div>
                  </div>
                  <div class="charity_inner">
                     <div class="row">
                        <div  class="col-md-4 no-gutters">
                           <figure class="charity_inner--figure"><img :src="'/images/charity/'+ create_message.images"></figure>
                        </div>
                        <div class="col-md-8">
                           <div class="charity_inner--content">
                              <h4 class="charity_inner--content--heading">{{create_message.title}}</h4>
                              <ul class="charity_inner--content--list">
                                 <li class="charity_inner--content--list--item">
                                    <span>Country:</span>{{create_message.country}} 
                                 </li>
                                 <li class="charity_inner--content--list--item">
                                    <span>Location:</span> {{create_message.city}} ,{{create_message.state}} 
                                 </li>
                                 <li class="charity_inner--content--list--item">
                                    <span>Contact:</span> {{create_message.area_code}} {{create_message.phone_number}} 
                                 </li>
                                 <li class="charity_inner--content--list--item">
                                    <span>Website :</span> {{create_message.website}}
                                 </li>
                              </ul>
                           </div>
                        </div>
                        <div class="col-12 no-gutters">
                           <div class="charity_profile--detail">
                              <h3 class="charity_profile--detail--heading">DETAIL:</h3>
                              <p class="charity_profile--detail-pera">
                                 {{create_message.description}} 
                              </p>
                              <h3 class="charity_profile--detail--heading">Mission:</h3>
                              <p class="charity_profile--detail-pera">
                                 {{create_message.mission_statement}} 
                              </p>
                              <h3 class="charity_profile--detail--heading">Vision:</h3>
                              <p class="charity_profile--detail-pera">
                                 {{create_message.vision_statement}} 
                              </p>
                              <div class="col-md-12">
                                 <b-list-group class="charity__social--list">
                                    <h4 class="charity__social--list--heading">Share this post:</h4>
                                    <b-list-group-item class="charity__social--list--item" href="#">
                                       <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                          viewBox="0 0 112.196 112.196" style="enable-background:new 0 0 112.196 112.196;" xml:space="preserve">
                                          <g>
                                             <circle style="fill:#3B5998;" cx="56.098" cy="56.098" r="56.098"/>
                                             <path style="fill:#FFFFFF;" d="M70.201,58.294h-10.01v36.672H45.025V58.294h-7.213V45.406h7.213v-8.34
                                                c0-5.964,2.833-15.303,15.301-15.303L71.56,21.81v12.51h-8.151c-1.337,0-3.217,0.668-3.217,3.513v7.585h11.334L70.201,58.294z"/>
                                          </g>
                                       </svg>
                                    </b-list-group-item>
                                    <b-list-group-item href="#" class="charity__social--list--item">
                                       <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                          viewBox="0 0 551.034 551.034" style="enable-background:new 0 0 551.034 551.034;" xml:space="preserve">
                                          <g>
                                             <linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="275.517" y1="4.57" x2="275.517" y2="549.72" gradientTransform="matrix(1 0 0 -1 0 554)">
                                                <stop  offset="0" style="stop-color:#E09B3D"/>
                                                <stop  offset="0.3" style="stop-color:#C74C4D"/>
                                                <stop  offset="0.6" style="stop-color:#C21975"/>
                                                <stop  offset="1" style="stop-color:#7024C4"/>
                                             </linearGradient>
                                             <path style="fill:url(#SVGID_1_);" d="M386.878,0H164.156C73.64,0,0,73.64,0,164.156v222.722
                                                c0,90.516,73.64,164.156,164.156,164.156h222.722c90.516,0,164.156-73.64,164.156-164.156V164.156
                                                C551.033,73.64,477.393,0,386.878,0z M495.6,386.878c0,60.045-48.677,108.722-108.722,108.722H164.156
                                                c-60.045,0-108.722-48.677-108.722-108.722V164.156c0-60.046,48.677-108.722,108.722-108.722h222.722
                                                c60.045,0,108.722,48.676,108.722,108.722L495.6,386.878L495.6,386.878z"/>
                                             <linearGradient id="SVGID_2_" gradientUnits="userSpaceOnUse" x1="275.517" y1="4.57" x2="275.517" y2="549.72" gradientTransform="matrix(1 0 0 -1 0 554)">
                                                <stop  offset="0" style="stop-color:#E09B3D"/>
                                                <stop  offset="0.3" style="stop-color:#C74C4D"/>
                                                <stop  offset="0.6" style="stop-color:#C21975"/>
                                                <stop  offset="1" style="stop-color:#7024C4"/>
                                             </linearGradient>
                                             <path style="fill:url(#SVGID_2_);" d="M275.517,133C196.933,133,133,196.933,133,275.516s63.933,142.517,142.517,142.517
                                                S418.034,354.1,418.034,275.516S354.101,133,275.517,133z M275.517,362.6c-48.095,0-87.083-38.988-87.083-87.083
                                                s38.989-87.083,87.083-87.083c48.095,0,87.083,38.988,87.083,87.083C362.6,323.611,323.611,362.6,275.517,362.6z"/>
                                             <linearGradient id="SVGID_3_" gradientUnits="userSpaceOnUse" x1="418.31" y1="4.57" x2="418.31" y2="549.72" gradientTransform="matrix(1 0 0 -1 0 554)">
                                                <stop  offset="0" style="stop-color:#E09B3D"/>
                                                <stop  offset="0.3" style="stop-color:#C74C4D"/>
                                                <stop  offset="0.6" style="stop-color:#C21975"/>
                                                <stop  offset="1" style="stop-color:#7024C4"/>
                                             </linearGradient>
                                             <circle style="fill:url(#SVGID_3_);" cx="418.31" cy="134.07" r="34.15"/>
                                          </g>
                                       </svg>
                                    </b-list-group-item>
                                    <b-list-group-item class="charity__social--list--item" href="#">
                                       <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                          viewBox="0 0 112.196 112.196" style="enable-background:new 0 0 112.196 112.196;" xml:space="preserve">
                                          <circle style="fill:#007AB9;" cx="56.098" cy="56.097" r="56.098"/>
                                          <g>
                                             <path style="fill:#F1F2F2;" d="M89.616,60.611v23.128H76.207V62.161c0-5.418-1.936-9.118-6.791-9.118
                                                c-3.705,0-5.906,2.491-6.878,4.903c-0.353,0.862-0.444,2.059-0.444,3.268v22.524H48.684c0,0,0.18-36.546,0-40.329h13.411v5.715
                                                c-0.027,0.045-0.065,0.089-0.089,0.132h0.089v-0.132c1.782-2.742,4.96-6.662,12.085-6.662
                                                C83.002,42.462,89.616,48.226,89.616,60.611L89.616,60.611z M34.656,23.969c-4.587,0-7.588,3.011-7.588,6.967
                                                c0,3.872,2.914,6.97,7.412,6.97h0.087c4.677,0,7.585-3.098,7.585-6.97C42.063,26.98,39.244,23.969,34.656,23.969L34.656,23.969z
                                                M27.865,83.739H41.27V43.409H27.865V83.739z"/>
                                          </g>
                                       </svg>
                                    </b-list-group-item>
                                 </b-list-group>
                              </div>
                             
                           </div>
                        </div>
                     </div>
                  </div>
                  <div v-if="similiar!=''">
                     <div class="similar-request">
                        <h2>Charity Requests</h2>
                     </div>
                     <div v-for="request in similiar"class="detail-description">
                        <figure><img :src="'/images/charity/'+ create_message.images"/></figure>
                        <div class="detail-description-content">
                           <h3>{{request.title}}</h3>
                           <p><strong>Description:</strong> {{request.description}}</p>
                           <p class="recent__post--tab--content--detail_box--block--pera_box"><strong>{{request.created_at |  moment("MMMM Do YYYY, h:mm a")}}</strong></p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="charity__element--block">
                     <h5 class="charity__element--block--heading">Ask This Charity A Question </h5>
					 <p><b>Must Be Signed in as a seller to ask this chairty a question </b></p>
                     <div class="charity__element--block--content">
                        <form id="create_message"  @submit.prevent="submit1">
                           <div class="form-group charity__element--block--content--box">
                              <label class="charity__element--block--content--box--label">Subject</label>
                              <input type="text" name="subject" v-model="create_message.subject"  placeholder="Subject"  class="login__element--box--input" />
                           </div>
                           <input type="hidden" name="user_id" v-model="create_message.user_id"   class="login__element--box--input" />
                           <input type="hidden" name="id" v-model="create_message.id"   class="login__element--box--input" />
                           <input type="hidden" name="post_type" v-model="create_message.post_type"   class="login__element--box--input" />
                           <input type="hidden" name="updated_by" v-model="create_message.updated_by"   class="login__element--box--input" />
                           <div class="form-group charity__element--block--content--box">
                              <label class="charity__element--block--content--box--label">Message</label>
                              <textarea placeholder="Type your message here"  v-model="create_message.message"  class="login__element--box--input" rows="5">
                              </textarea>
                           </div>
                           <div class="form-group text-center" v-if="getrole ==''" >
                              <router-link :to="{ path: '/login',query: {redurl:'/charity_details/'+this.$route.params.id}}" class="btn btn-bg-orange login__element--box--button">Send Message</router-link>
                           </div>
                           <div v-else >
                              <div v-if="getrole== 'charity'" class="form-group text-center">
                                 <button   :disabled="role" placeholder="" class="btn btn-bg-orange login__element--box--button">Send Message</button>
                              </div>
                              <div v-if="getrole== 'seller'" class="form-group text-center">
                                 <button   placeholder="" class="btn btn-bg-orange login__element--box--button">Send Message</button>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
                  <div class="helping__element">
                     
                     <div class="col-12">
                                 <div class="charity_donation">
                                    <div v-if="getrole ==='seller'" class="charity__request">
                                       <div v-if="getrole=='seller'">
                                          <div class="charity_donation--box">
                                             <b-btn v-b-modal.modalPrevent v-b-modal. variant="primary" class="charity__request--send btn-bg-orange btn orangebtn">Invite Charity To Your Donation</b-btn>
                                             <b-modal id="modalPrevent"
                                                ref="modal"
                                                title="Invite To Donate Charity"
                                                @ok="handleSubmit"
                                                @shown="clearName">
                                                <form  id="prod" @submit.stop.prevent="handleSubmit">
                                                   <div class="form-group">
                                                      <label class="login__element--box--label">Select Product</label>
                                                      <select name="title" v-model="prod.id" v-on:change="onChange"   class="login__element--box--input">
                                                         <option value="select">Select .. </option>
                                                         <option v-for="item in product"  v-bind:value="item.id">{{item.title}}</option>
                                                      </select>
                                                   </div>
                                                   <label class="charity__element--block--content--box--label">Units</label>
                                                   <input type="number" name="units"  v-model="prod.units" placeholder="Units"  class="login__element--box--input" />
                                                   <input type="hidden" name="product_name" v-model="prod.product_name" class="login__element--box--input" />
                                                </form>
                                             </b-modal>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div v-if="getrole =='' "class="charity__request">
                                    <router-link :to="{ path: '/login',query: {redurl:'/charity_details/'+this.$route.params.id}}" class="charity__request--send btn-bg-orange btn orangebtn">Invite Charity To Your Donation</router-link>
                                 </div>
                              </div>
                    
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section>
         <div class="container">
         </div>
      </section>
   </div>
</template>
<script>
   import helper from '../../services/helper'
    
   import Vue from 'vue'
   Vue.use(require('vue-moment'));
   export default {
   	 components: {},
     
           data() {
   		 
   		
               return {
      charity_request:[],
       myAttribute: 'null',
      images:'',
      similiar:[],
   		request:{},
   		  product_name:{},
   		  role:true,
   		 
   		  prod:{
   				  title: 'select',
   				  units: ''
   				},
   		product:[],
   		items:[],
   		create_message:{
		},
   		loginCheck: helper.checkLogin()
   		  }
   			 
           },
   		
   		created: function()
           {
               this.fetchItems();
   			
   			this.fetchproducts();
   	
           },
          
           
          mounted(){
		this.attribute = this.$route.query;
		this.fetchItem();
		console.log("Request id"+this.$route.query);
		console.log("id"+this.$route.params.id);
   
        },
           methods: {
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
      
    handleSubmit () {
       let data = this.prod;
     axios.post('/api/product/'+this.$route.params.id,this.prod).then(response => {
     toastr['success'](response.data.message);
     })
   
    },
   				
   			 submit1(e){
                   if(helper.checkLogin()){
   	   
   				axios.post('/api/create_message', this.create_message).then(response =>  {
                       toastr['success'](response.data.message);
                       
                   }).catch(error => {
                       toastr['error'](error.response.data.message);
                   });
               }
   		else{
   					toastr['success']("First You Login");
   				this.$router.push('/login');
   		}
            },  
   			
   	fetchItem()
               {
   	if(this.$route.query!='' && this.$route.query!='[object Object]')
   		{
   		 axios.get('/api/requests/'+this.$route.query).then(response=>{
   		
   		this.request=response.data.data1;
   		this.create_message=response.data.data2;
   		this.similiar=response.data.data3;
   			
   			}).catch(error=>{
   			toastr['error'](error.response.data.message);
   				  
                 });
   	
   	 }
   	else{
   	 axios.get('/api/charity_request_details/'+this.$route.params.id).then(response=>{
   		this.request=response.data.data1;
   		this.create_message=response.data.data2;
   		this.similiar=response.data.data3;
   		 console.log("Id"+item.id);
   		
   			
   			}).catch(error=>{
   			toastr['error'](error.response.data.message);
   				  
                 });
   	 
   	 
   	 }
               },
    
   			 fetchItems()
               {
   			
                 axios.get('/api/search').then(response =>  {
   					
                     this.items = response.data;
   				  
   				  
                 });
               },
      fetchproducts()
               {
   			
                 axios.get('/api/product').then(response =>  {
   					
                     this.product = response.data;
   				 
   				  
                 });
               },
      
       getAuthUserrole(){
               return this.$store.getters.getAuthUserrole;
           },
           getAuthUser(name){
               return this.$store.getters.getAuthUser(name);
           }
   			
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