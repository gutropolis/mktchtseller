<template>
   <div>
      <section class="page__head">
         <div class="container">
            <div class="page__head--content">
               <h2 class="page__head--content--heading">Product Details</h2>
               <router-link to="/"><a href="#" class="page__head--content--menu">Home </a> ></router-link>
               <a href="#" class="page__head--content--menu">Sellerfba Post</a>
            </div>
         </div>
      </section>
      <section class="equal charity__element">
         <div class="container">
            <div class="row">
               <div class="col-md-8">
                  <div class="charity_inner row">
                     <div class="col-md-6 no-gutters">
                        <figure class="charity_inner--figure">	<img  class="charity__listing--figure--image" height="300" width="240" v-bind:src="create_message.images"></figure>
                     </div>
                     <div class="col-md-5">
                        <div class="charity_inner--content">
                           <h4 class="charity_inner--content--heading">{{create_message.title}}</h4>
                           <p class="charity_inner--content--pera">Contrary to popular belief,Lorem Ipsum.</p>
                           <ul class="charity_inner--content--list">
                              
                              <li class="charity_inner--content--list--item">
                                 <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 50.425 50.425" style="enable-background:new 0 0 50.425 50.425;" xml:space="preserve">
                                    <g>
                                       <path d="M43.96,28.768H30.384v6.465H20.04v-6.465H6.465c-2.485,0-4.747-0.947-6.465-2.49v14.773c0,3.556,2.909,6.465,6.465,6.465
                                          H43.96c3.556,0,6.465-2.909,6.465-6.465V26.277C48.707,27.821,46.445,28.768,43.96,28.768z"/>
                                    </g>
                                    <g>
                                       <path d="M34.263,11.313V9.374c0-3.556-2.909-6.465-6.465-6.465h-5.172c-3.556,0-6.465,2.909-6.465,6.465v1.939H0v7.758
                                          c0,3.556,2.909,6.465,6.465,6.465H43.96c3.556,0,6.465-2.909,6.465-6.465v-7.758H34.263z M29.737,11.313h-9.05V9.374
                                          c0-1.051,0.888-1.939,1.939-1.939h5.172c1.051,0,1.939,0.888,1.939,1.939V11.313z"/>
                                    </g>
                                 </svg>
                                 <span>ASIN:</span> {{create_message.asin_url}}
                              </li>
                              <li class="charity_inner--content--list--item">
                                 <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 469.333 469.333" style="enable-background:new 0 0 469.333 469.333;" xml:space="preserve">
                                    <g>
                                       <path d="M234.56,128c23.573,0,42.667-19.093,42.667-42.667c0-8-2.24-15.573-6.08-21.973L234.56,0l-36.587,63.36
                                          c-3.84,6.4-6.08,13.973-6.08,21.973C191.893,108.907,210.987,128,234.56,128z"/>
                                       <path d="M362.56,192L362.56,192H255.893v-42.667h-42.667V192H106.56c-35.307,0-64,28.693-64,64v32.853
                                          c0,23.04,18.773,41.813,41.813,41.813c11.2,0,21.653-4.373,29.547-12.267l45.653-45.547l45.547,45.44
                                          c15.787,15.787,43.307,15.787,59.093,0l45.653-45.44l45.547,45.44c7.893,7.893,18.347,12.267,29.547,12.267
                                          c23.04,0,41.813-18.773,41.813-41.813V256C426.56,220.693,397.867,192,362.56,192z"/>
                                       <path d="M332.587,341.013L332.587,341.013l-22.933-22.933l-23.04,22.933c-27.84,27.84-76.48,27.84-104.32,0L159.36,318.08
                                          l-23.04,22.933c-13.76,13.973-32.213,21.653-51.947,21.653c-15.467,0-29.867-4.907-41.813-13.12V448
                                          c0,11.733,9.6,21.333,21.333,21.333h341.333c11.733,0,21.333-9.6,21.333-21.333v-98.453c-11.947,8.213-26.24,13.12-41.813,13.12
                                          C365.013,362.667,346.56,354.987,332.587,341.013z"/>
                                    </g>
                                 </svg>
                                 <span>Unit:</span> {{create_message.units}}
                              </li>
                           </ul>
                        </div>
                     </div>
                     <div class="col-12 no-gutters">
                        <div class="charity_profile--detail">
                           <h3 class="charity_profile--detail--heading">DETAIL:</h3>
                           <p class="charity_profile--detail-pera">
                             <span v-html="create_message.description"></span> 
                           </p>
                           <div class="col-md-12">
                              <b-list-group class="charity__social--list">
                                 <h4 class="charity__social--list--heading">SHare this post:</h4>
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
                           <div class="col-12">
                              <div class="charity__request">
                                 <b-link class="charity__request--cancel btn">Cancel</b-link>
                                 <router-link to="/charity_detail1" class="charity__request--send btn-bg-orange btn">Send Request</router-link>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="charity__element--block">
                     <h5 class="charity__element--block--heading">Message Communicate</h5>
                     <div class="charity__element--block--content">
                        <form id="create_message" @submit.prevent="submit1">
                           <div class="form-group charity__element--block--content--box">
                              <label class="charity__element--block--content--box--label">Title</label>
                              <input type="text" name="msgtitle" v-model="create_message.msgtitle"  placeholder="Title"  class="login__element--box--input" />
                           </div>
                           <input type="hidden" name="user_id" v-model="create_message.user_id"   class="login__element--box--input" />
                           <input type="hidden" name="id" v-model="create_message.id"   class="login__element--box--input" />
                           <input type="hidden" name="post_type" v-model="create_message.post_type"   class="login__element--box--input" />
                           <input type="hidden" name="updated_by" v-model="create_message.updated_by"   class="login__element--box--input" />
                           <div class="form-group charity__element--block--content--box">
                              <label class="charity__element--block--content--box--label">Message</label>
                              <textarea placeholder="Type your message here" v-model="create_message.message"  class="login__element--box--input" rows="5">
                              </textarea>
                           </div>
                           <div class="form-group text-center">
                              <input type="Submit" placeholder="" value="Send Message" class="btn btn-bg-orange login__element--box--button">
                           </div>
                        </form>
                     </div>
                  </div>
                  <div class="helping__element">
                     <div class="helping__element--block">
                        <h5 class="helping__element--block--heading">Helping Center</h5>
                     </div>
                     <p class="helping__element--pera">All the Lorem Ipsum generat on the Internet tend to repeat predefined chunks as necesa.</p>
                     <h3 class="helping__element--heading">+90 777 333 11 22</h3>
                     <h5 class="helping__element--subhead">support@supportcenter.com</h5>
                     <p class="helping__element--btn"><a href="#" class="btn btn-bg-orange">Support Center</a> </p>
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
   import InfiniteLoading from 'vue-infinite-loading';
   export default {
   	 components: {
       InfiniteLoading,
     },
     
           data() {
   		
               return {
   		
   		   create_message:{},
                   
               }
           },
   		
   		created: function()
           {
               this.fetchItems();
   			this.fetchItem();
   			
           },
          
           
           mounted(){
           },
           methods: {
   			 submit1(e){
                   axios.post('/api/create_message', this.create_message).then(response =>  {
                       toastr['success'](response.data.message);
                       
                   }).catch(error => {
                       toastr['error'](error.response.data.message);
                   });
               },
   		
              
   			
   	fetchItem()
               {
   			
                axios.get('api/product_details/'+this.$route.params.id).then(response=>{
   			
   			this.create_message=response.data;
   			
   			
   			}).catch(error=>{
   			toastr['error'](error.response.data.message);
   				  
                 });
               },
   	
   			 fetchItems()
   			 {
                
                 axios.get('/api/sellersearch',this.sellersearch).then((response) => {
                    
   				 this.items=response.data;
                 });
               },
   			
   			}
   			}
</script>