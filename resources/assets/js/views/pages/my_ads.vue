<template>
   <div>
      <div id="main-wrapper">
         <section class=" my__account">
            <div class="row">
               <app-sidebar></app-sidebar>
               <div class="col-md-9 dashboard">
                  <div class="dashboard__content clearfix">
                     <div class="dashboard__content--head">
                        <h3 class="dashboard__content--head--heading">My Requests</h3>
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
                     <div class="dashboard__content--outer clearfix">
                        <div class="notification__element clearfix">
                           <div class="notification__element-bottom">
                              <div class="notification__element--mark">
                              </div>
                              <div class="notification__element--button clearfix">
                                 <!-- <button type="button" class="btn">Mark as Read</button> -->
                                 <b-button to= "/create_ads" type="button" class="btn">
                                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                       width="485.219px" height="485.22px" viewBox="0 0 485.219 485.22" style="enable-background:new 0 0 485.219 485.22;"
                                       xml:space="preserve">
                                       <g>
                                          <path d="M467.476,146.438l-21.445,21.455L317.35,39.23l21.445-21.457c23.689-23.692,62.104-23.692,85.795,0l42.886,42.897
                                             C491.133,84.349,491.133,122.748,467.476,146.438z M167.233,403.748c-5.922,5.922-5.922,15.513,0,21.436
                                             c5.925,5.955,15.521,5.955,21.443,0L424.59,189.335l-21.469-21.457L167.233,403.748z M60,296.54c-5.925,5.927-5.925,15.514,0,21.44
                                             c5.922,5.923,15.518,5.923,21.443,0L317.35,82.113L295.914,60.67L60,296.54z M338.767,103.54L102.881,339.421
                                             c-11.845,11.822-11.815,31.041,0,42.886c11.85,11.846,31.038,11.901,42.914-0.032l235.886-235.837L338.767,103.54z
                                             M145.734,446.572c-7.253-7.262-10.749-16.465-12.05-25.948c-3.083,0.476-6.188,0.919-9.36,0.919
                                             c-16.202,0-31.419-6.333-42.881-17.795c-11.462-11.491-17.77-26.687-17.77-42.887c0-2.954,0.443-5.833,0.859-8.703
                                             c-9.803-1.335-18.864-5.629-25.972-12.737c-0.682-0.677-0.917-1.596-1.538-2.338L0,485.216l147.748-36.986
                                             C147.097,447.637,146.36,447.193,145.734,446.572z"/>
                                       </g>
                                    </svg>
                                    Create Request
                                 </b-button>
                              </div>
                           </div>
                           <div v-for="item in items">
                              <div class="notification__element--view">
                                 <div class="notification__element--listing" v-for= "charity in item.charity_detail" >
                                    <figure class="notification__element--listing--figure">
                                       <img :src="'/images/charity/'+ charity.images" class="notification__element--listing--figure--image">
                                    </figure>
                                    <div class="notification__element--listing--content">
                                       <h4 class="charity__listing--content--box--heading">{{item.title}}</h4>
                                       <p>{{item.description}}</p>
									   <p v-for="charity in item.charity_detail"><b>Charity Name:</b> {{charity.title}}</p> 
                                    </div>
                                 </div>
                                 <div class="notification__element--view--button">
                                    <router-link :to="{name: 'edit_ads', params: { id: item.id }}" class="btn notification__element--view--button--content btn-border-orange">Edit</router-link>
                                    <button class="btn notification__element--view--button--content btn-border-orange"  v-on:click="deleteItem(item.id)">Delete</button>
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
   import AppNavbar from './users/navbar.vue' 
    import AppSidebar from './users/sidebar.vue'
    import Vue from 'vue'
       export default {
       components: {
               AppNavbar,  AppSidebar 
           },
   		data() {
               return {
   				 isCheckAll: false,
                    items: [],
   				 loaded: false,
               }
           },
           mounted(){
           },
   		 created: function()
           {
               this.fetchItems();
           },
   		 methods: {
   		  checkAll: function(){
   
         
         this.items = [];
         
         },
       
   		 deleteItem(id){
                   axios.delete('/api/charityads/'+id).then(response => {
                       toastr['success'](response.data.message);
   					this.fetchItems();
                       
                   }).catch(error => {
                       toastr['error'](error.response.data.message);
                   });
               },
                  fetchItems()
   		 {
                 axios.get('/api/charityads').then((response) => {
                    this.items=response.data;
   				 this.loaded = true;
   					
                 }) 
   			  
               },
   			
           }
   		}
</script>