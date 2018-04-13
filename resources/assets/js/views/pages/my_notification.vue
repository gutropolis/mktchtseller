<template>
   <div  id="main-wrapper">
      <section class=" my__account">
         <div class="row">
            <app-sidebar></app-sidebar>
            <div class="col-md-9 dashboard">
               <div class="dashboard__content clearfix">
                  <div class="dashboard__content--head">
                     <h3 class="dashboard__content--head--heading">Notification of Invited Charities By Sellers</h3>
                  </div>
                  <div class="donation_top_tab">
                  <b-tabs>
                     <b-tab title="Pending" active>
                        <div>
                           <div class="panel-body">
                              <div class="table-responsive">
                                  <div class="dashboard__content--outer clearfix">
                        <div class="notification__element clearfix">
                           
                            <div class="notification__element--view" v-for="item in items">
                               
                                <div v-for="product in item.product_detail" class="notification__element--listing" >
                                    <figure class="notification__element--listing--figure">
                                       <a v-bind:href="product.description_url"> <img  v-bind:src="product.images" class="notification__element--listing--figure--image"></a>
                                    </figure>
                                    <div v-for="product in item.product_detail" class="notification__element--listing--content">
                                      <h4><a v-bind:href="product.description_url">{{product.title}}</a></h4></a>
                                        
                                    <p> Donated By:- {{product.updated_by}} </p>
                                    </div>
                                </div>
                                <div class="notification__element--view--button">
                                    
									 <button class="btn notification__element--view--button--content text-White  green" v-on:click="update(item.id)">Accept</button>
									  <button class="btn notification__element--view--button--content  text-White red" v-on:click="reject(item.id)">Reject</button>
                                </div>
                            </div>
                          
                        </div>
                    </div>
								 
                              </div>
                           </div>
                        </div>
                     </b-tab>
                     <b-tab title="Accepted" >
                        <div>
                           <div class="panel-body">
                              <div class="table-responsive">
                                  <div class="dashboard__content--outer clearfix">
                        <div class="notification__element clearfix">
                           
                            <div class="notification__element--view" v-for="item in accept_items">
                               
                                <div v-for="product in item.product_detail" class="notification__element--listing" >
                                    <figure class="notification__element--listing--figure">
                                       <a v-bind:href="product.description_url"> <img  v-bind:src="product.images" class="notification__element--listing--figure--image"></a>
                                    </figure>
                                    <div v-for="product in item.product_detail" class="notification__element--listing--content">
                                      <h4><a v-bind:href="product.description_url">{{product.title}}</a></h4></a>
                                        
                                    <p> Donated By:- {{product.updated_by}} </p>
                                    </div>
                                </div>
                               
                            </div>
                          
                        </div>
                    </div>
								 
                              </div>
                           </div>
                        </div>
                     </b-tab>
                     <b-tab title="Declined">
                       <div>
                           <div class="panel-body">
                              <div class="table-responsive">
                                  <div class="dashboard__content--outer clearfix">
                        <div class="notification__element clearfix">
                           
                            <div class="notification__element--view" v-for="item in decline_items">
                               
                                <div v-for="product in item.product_detail" class="notification__element--listing" >
                                    <figure class="notification__element--listing--figure">
                                       <a v-bind:href="product.description_url"> <img  v-bind:src="product.images" class="notification__element--listing--figure--image"></a>
                                    </figure>
                                    <div v-for="product in item.product_detail" class="notification__element--listing--content">
                                      <h4><a v-bind:href="product.description_url">{{product.title}}</a></h4></a>
                                        
                                    <p> Donated By:- {{product.updated_by}} </p>
                                    </div>
                                </div>
                               
                            </div>
                          
                        </div>
                    </div>
								 
                              </div>
                           </div>
                        </div>
                     </b-tab>
					
					  </b-tab>
					 
                  </b-tabs>
               </div>
               </div>
            </div>
			
         </div>
      </section>
   </div>
</template>
<script>
 
 import AppSidebar from './users/sidebar.vue'
 import Vue from 'vue'
    export default {
    components: {
              AppSidebar 
        },
		data() {
            return {
			decline_items:[],
			accept_items:[],
				items:[],
                
            }
        },
        mounted(){
        },
		 created: function()
        {
            this.fetchItems();
        },
		 methods: {
		fetchItems()
		 {
             axios.get('/api/charity_notification').then((response) => {
                 this.items=response.data.data1;
				 this.accept_items=response.data.data2;
				 this.decline_items=response.data.data3;
					
              }) 
			  
            },

			update(id){
				axios.post('api/update_donation/'+id).then(response =>  {
                    toastr['success'](response.data.message);
                    
                })
			 
			
			
			},
			reject(id){
				axios.post('api/reject_donation/'+id).then(response =>  {
                    toastr['success'](response.data.message);
                    
                })
			 
			
			
			}
			
            },
			
        }
		
</script>